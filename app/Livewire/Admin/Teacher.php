<?php

namespace App\Livewire\Admin;

use App\Exports\TeachersExport;
use App\Imports\TeachersImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
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

		DB::transaction(function () use ($profilePhotoPath) {
			$school_id = Auth::user()->school_id;

			User::lockForUpdate()->create([
				'school_id' => $school_id,
				'role' => 'teacher',
				'name' => $this->name,
				'email' => $this->email,
				'password' => bcrypt($this->password),
				'phone' => $this->phone,
				'gender' => $this->gender,
				'photo' => $profilePhotoPath,
			]);
			flash()->success('Teacher created successfully.');
		});

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
		$teacher2 = $this->teacher;
		try {
			$this->validate();
			$emailBefore = $this->teacher->email;
			$emailAfter = $this->email;

			$this->emailChange = $emailBefore !== $emailAfter;

			$profilePhotoPath = $this->photo
				? $this->photo->store('profile_photos', 'public')
				: $this->existingPhoto;


			$dataWithEmail = [
				'name' => $this->name,
				'email' => $this->email,
				'password' => bcrypt($this->password),
				'phone' => $this->phone,
				'gender' => $this->gender,
				'photo' => $profilePhotoPath,
			];

			$dataWithoutEmail = [
				'name' => $this->name,
				'password' => bcrypt($this->password),
				'phone' => $this->phone,
				'gender' => $this->gender,
				'photo' => $profilePhotoPath,
			];

			DB::transaction(function () use ($teacher2, $dataWithoutEmail, $dataWithEmail) {
				DB::table('users')
					->where('email', $this->email)
					->where('id', '!=', $teacher2->id)
					->lockForUpdate()
					->exists();

				if ($this->emailChange) {
					$teacher2->update($dataWithEmail);
				} else {
					$teacher2->update($dataWithoutEmail);
				}
			});
			$this->closeModal();
			$this->resetInputFields();

			flash()->success('Teacher updated successfully.');
		} catch (\Illuminate\Validation\ValidationException $e) {
			$errorMessages = '';
			foreach ($e->errors() as $field => $messages) {
				foreach ($messages as $message) {
					$errorMessages .= $message . ' ';
					$this->addError($field, $message);
				}
			}
			flash()->error('Validation error! ' . trim($errorMessages));
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



	//          EXCEL
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
