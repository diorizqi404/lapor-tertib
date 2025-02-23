<?php

namespace App\Livewire\Admin;

use App\Exports\TeachersExport;
use App\Imports\TeachersImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Maatwebsite\Excel\Facades\Excel;

class Teacher extends Component
{
	use WithPagination, WithFileUploads, WithoutUrlPagination;

	public $name, $email, $password, $school_id, $phone, $gender, $photo, $teacher;
	public $isModalOpen = false;
	public $isModalImportOpen = false;
	public $isEdit = false;
	public $emailChange = false;
	public $existingPhoto;
	public $selected_id = [];
	public $keyword;
	public $excel;
	public $perPage = 10;

	public function updatedPerPage()
	{
		$this->resetPage();
	}

	public function render()
	{
		$query = User::where('role', 'teacher')
			->where('school_id', Auth::user()->school_id);

		if ($this->keyword) {
			$query->where(function ($q) {
				$q->where('name', 'like', '%' . $this->keyword . '%')
					->orWhere('email', 'like', '%' . $this->keyword . '%');
			});
		}

		$teachers = $query->orderBy('created_at', 'desc')->paginate($this->perPage);

		return view('livewire.admin.teacher-menu.page', [
			'teachers' => $teachers,
		]);
	}

	public function openModal()
	{
		$this->isModalOpen = true;
	}

	public function closeModal()
	{
		$this->resetInputFields();
		$this->isModalOpen = false;
	}

	private function resetInputFields()
	{
		$this->school_id = '';
		$this->name = '';
		$this->email = '';
		$this->password = '';
		$this->phone = '';
		$this->photo = null;
		$this->gender = '';
		$this->resetValidation();
	}

	public function rules()
	{
		return [
			'name' => 'required|string',
			'email' => [
				'required',
				'email',
				Rule::unique('users')->ignore($this->isEdit ? $this->teacher->id : null),
			],
			'password' => $this->isEdit ? 'nullable|string|min:8' : 'required|string|min:8',
			'phone' => 'required|string',
			'gender' => 'required|in:L,P',
			'photo' => 'nullable|image|max:4098',
		];
	}

	public function create()
	{
		$this->resetInputFields();
		$this->isEdit = false;
		$this->openModal();
	}

	public function store()
	{
		$this->validate();

		$profilePhotoPath = $this->photo ? $this->photo->store('profile_photos', 'public') : null;

		DB::beginTransaction();

		try {
			$school_id = Auth::user()->school_id;

			User::create([
				'school_id' => $school_id,
				'role' => 'teacher',
				'name' => $this->name,
				'email' => $this->email,
				'password' => bcrypt($this->password),
				'phone' => $this->phone,
				'gender' => $this->gender,
				'photo' => $profilePhotoPath,
				'email_verified_at' => now(),
			]);

			DB::commit();
			flash()->success('Teacher created successfully.');
		} catch (\Exception $e) {
			DB::rollBack();
			Log::error('Failed to create teacher: ' . $e->getMessage());
			flash()->error('Failed to create teacher. Please try again.');
		}

		$this->closeModal();
		$this->resetInputFields();
	}

	public function edit($id)
	{
		$teacher = User::findOrFail($id);

		if (!$teacher) {
			flash()->error('Teacher not found.');
		}

		$this->teacher = $teacher;
		$this->name = $teacher->name;
		$this->email = $teacher->email;
		$this->password = '';
		$this->phone = $teacher->phone;
		$this->gender = $teacher->gender;
		$this->existingPhoto = $teacher->photo;
		$this->photo = null;

		$this->isEdit = true;
		$this->openModal();
	}

	public function update()
	{
		try {
			// Validasi input sebelum transaksi
			$this->validate();

			// Simpan email lama & baru
			$emailBefore = $this->teacher->email;
			$emailAfter = $this->email;

			// Cek apakah email berubah
			$this->emailChange = $emailBefore !== $emailAfter;

			// Simpan foto profil baru jika ada, jika tidak pakai foto lama
			$profilePhotoPath = $this->photo
				? $this->photo->store('profile_photos', 'public')
				: $this->existingPhoto;

			// Cek apakah email sudah digunakan oleh user lain (hindari duplikasi)
			if ($this->emailChange) {
				$emailExists = DB::table('users')
					->where('email', $emailAfter)
					->where('id', '!=', $this->teacher->id)
					->exists();

				if ($emailExists) {
					flash()->error('Email already taken.');
					return;
				}
			}

			// Siapkan data update
			$updateData = [
				'name' => $this->name,
				'phone' => $this->phone,
				'gender' => $this->gender,
				'photo' => $profilePhotoPath,
			];

			// Tambahkan email hanya jika berubah
			if ($this->emailChange) {
				$updateData['email'] = $emailAfter;
			}

			// Tambahkan password jika diisi
			if (!empty($this->password)) {
				$updateData['password'] = bcrypt($this->password);
			}

			// Eksekusi transaksi database
			DB::beginTransaction();

			$this->teacher->update($updateData);

			DB::commit();

			// Reset & tutup modal setelah sukses
			$this->closeModal();
			$this->resetInputFields();

			flash()->success('Teacher updated successfully.');
		} catch (ValidationException $e) {
			// Handle validation error
			foreach ($e->errors() as $field => $messages) {
				foreach ($messages as $message) {
					$this->addError($field, $message);
				}
			}
			flash()->error('Validation error! Please check your input.');
		} catch (\Exception $e) {
			// Rollback transaksi jika terjadi kesalahan
			DB::rollBack();

			// Logging error
			Log::error('Failed to update teacher: ' . $e->getMessage());

			flash()->error('Failed to update teacher. Please try again.');
		}
	}

	public function deleteBulk()
	{
		User::whereIn('id', $this->selected_id)->delete();
		$this->selected_id = [];
		session()->flash('message', 'Selected users deleted successfully.');
	}

	public function delete($id)
	{
		$teacher = User::findOrFail($id);

		if (!$teacher) {
			flash()->error('Teacher not found.');
		}

		DB::transaction(function () use ($teacher) {
			$teacher->delete();
		});
		flash()->success('Teacher deleted successfully.');
	}



	// EXCEL
	public function import()
	{
		$this->isModalImportOpen = true;
	}

	public function closeModalImport()
	{
		$this->isModalImportOpen = false;
	}

	public function importExcel()
	{
		$this->validate([
			'excel' => 'required|file|mimes:xlsx,xls',
		]);

		$file = $this->excel->getRealPath();
		$extension = $this->excel->getClientOriginalExtension();

		Excel::import(new TeachersImport, $file, null, \Maatwebsite\Excel\Excel::XLSX);

		flash()->success('Teachers imported successfully.');
		$this->closeModalImport();
	}

	public function exportExcel()
	{
		return Excel::download(new TeachersExport(), 'Teacher.xlsx');
	}
}
