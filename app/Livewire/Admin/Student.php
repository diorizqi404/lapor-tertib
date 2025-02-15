<?php

namespace App\Livewire\Admin;

use App\Models\Classes;
use App\Models\Student as ModelsStudent;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class Student extends Component
{
	use WithPagination, WithFileUploads;

	public $student, $school_id, $class_id, $nis, $name, $gender, $photo, $parent_phone;
	public $isModalOpen = false;
	public $isModalImportOpen = false;
	public $isEdit = false;
	public $existingPhoto;
	public $selected_id = [];
	public $keyword;
	public $excel;
	public $perPage = 10;

	public function render()
	{
		$query = ModelsStudent::where('school_id', Auth::user()->school_id)
			->with('class.grade', 'class.department');

		if ($this->keyword) {
			$query->where(function ($q) {
				$q->where('nis', 'like', '%' . $this->keyword . '%')
					->orWhere('name', 'like', '%' . $this->keyword . '%');
			});
		}

		$students = $query->orderBy('nis', 'asc')->paginate($this->perPage);

		$classes = DB::table('classes')
			->join('grades', 'grades.id', '=', 'classes.grade_id')
			->leftjoin('departments', 'departments.id', '=', 'classes.department_id')
			->where('classes.school_id', Auth::user()->school_id)
			->select(
				'classes.id',
				DB::raw("CONCAT(grades.name, ' ', COALESCE(departments.initial, ''), ' ', classes.name) as full_name")
			)
			->pluck('full_name', 'classes.id');

		return view('livewire.admin.student-menu.student', [
			'students' => $students,
			'classes' => $classes
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
		$this->class_id = '';
		$this->nis = '';
		$this->name = '';
		$this->gender = '';
		$this->photo = '';
		$this->parent_phone = '';
		$this->resetValidation();
	}

	public function rules()
	{
		return [
			'class_id' => 'required',
			'nis' => 'required|numeric|unique:students,nis,' . ($this->student->id ?? 'NULL') . ',id,school_id,' . Auth::user()->school_id,
			'name' => 'required|string',
			'gender' => 'required|in:L,P',
			'photo' => 'nullable|image|max:4096',
			'parent_phone' => 'required',
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

		$profilePhotoPath = $this->photo ? $this->photo->store('student_photos', 'public') : null;

		DB::transaction(function () use ($profilePhotoPath) {
			ModelsStudent::create([
				'school_id' => Auth::user()->school_id,
				'class_id' => $this->class_id,
				'nis' => $this->nis,
				'name' => $this->name,
				'gender' => $this->gender,
				'photo' => $profilePhotoPath,
				'parent_phone' => $this->parent_phone
			]);
			flash()->success('Student created successfully');
		});

		$this->closeModal();
		$this->resetInputFields();
	}

	public function edit($id)
	{
		$this->isEdit = true;
		$this->openModal();

		$student = ModelsStudent::find($id);
		$this->student = $student;
		$this->school_id = $student->school_id;
		$this->class_id = $student->class_id;
		$this->nis = $student->nis;
		$this->name = $student->name;
		$this->gender = $student->gender;
		$this->existingPhoto = $student->photo;
		$this->photo = null;
		$this->parent_phone = $student->parent_phone;
	}

	public function update()
	{
		$this->validate();

		$profilePhotoPath = $this->photo ? $this->photo->store('student_photos', 'public') : $this->existingPhoto;

		DB::transaction(function () use ($profilePhotoPath) {
			ModelsStudent::find($this->student->id)->update([
				'class_id' => $this->class_id,
				'nis' => $this->nis,
				'name' => $this->name,
				'gender' => $this->gender,
				'photo' => $profilePhotoPath,
				'parent_phone' => $this->parent_phone
			]);
			flash()->success('Student updated successfully');
		});

		$this->closeModal();
		$this->resetInputFields();
	}

	public function delete()
	{
		if(count($this->selected_id) == 0) {
			flash()->error('Please select at least one student');
			return;
		}

		DB::transaction(function () {
			ModelsStudent::whereIn('id', $this->selected_id)->delete();
			flash()->success('Student deleted successfully');
		});
		$this->selected_id = [];
	}
}
