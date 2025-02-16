<?php

namespace App\Livewire\Admin;

use App\Models\Classes;
use App\Models\AcademicYear;
use App\Models\Grade;
use App\Models\Student as ModelsStudent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class Student extends Component
{
	use WithPagination, WithFileUploads;

	public $student, $school_id, $class_id, $academic_year_id, $nis, $name, $gender, $photo, $parent_phone;
	public $isModalOpen = false;
	public $isModalImportOpen = false;
	public $isEdit = false;
	public $existingPhoto;
	public $selected_id = [];
	public $keyword;
	public $excel;
	public $perPage = 10;

	public $is_sync = false;

	public function render()
	{
		$queryActive = ModelsStudent::where('school_id', Auth::user()->school_id)
			->whereHas('academicYear', function ($q) {
				$q->where('status', 'active');
			})
			->with(['class.grade', 'class.department', 'academicYear' => function ($q) {
				$q->select('id', DB::raw("CONCAT(YEAR(start_date), '/', YEAR(end_date)) as full_name"));
			}]);

		$queryInactive = ModelsStudent::where('school_id', Auth::user()->school_id)
			->whereHas('academicYear', function ($q) {
				$q->where('status', 'inactive');
			})
			->with(['class.grade', 'class.department', 'academicYear' => function ($q) {
				$q->select('id', DB::raw("CONCAT(YEAR(start_date), '/', YEAR(end_date)) as full_name"));
			}]);

		if ($this->keyword) {
			$queryActive->where(function ($q) {
				$q->where('nis', 'like', '%' . $this->keyword . '%')
					->orWhere('name', 'like', '%' . $this->keyword . '%');
			});

			$queryInactive->where(function ($q) {
				$q->where('nis', 'like', '%' . $this->keyword . '%')
					->orWhere('name', 'like', '%' . $this->keyword . '%');
			});
		}


		$activeStudents = $queryActive->orderBy('nis', 'asc')->paginate($this->perPage);
		$inactiveStudents = $queryInactive->orderBy('nis', 'asc')->paginate($this->perPage);

		$classes = DB::table('classes')
			->join('grades', 'grades.id', '=', 'classes.grade_id')
			->leftjoin('departments', 'departments.id', '=', 'classes.department_id')
			->where('classes.school_id', Auth::user()->school_id)
			->select(
				'classes.id',
				DB::raw("CONCAT(grades.name, ' ', COALESCE(departments.initial, ''), ' ', classes.name) as full_name")
			)
			->pluck('full_name', 'classes.id');

		$academic_years = AcademicYear::where('school_id', Auth::user()->school_id)
			->where('status', 'active')
			->select('id', DB::raw("CONCAT(YEAR(start_date), '/', YEAR(end_date)) as full_name"))
			->pluck('full_name', 'id');

		$inactive_count = ModelsStudent::where('school_id', Auth::user()->school_id)
			->whereHas('academicYear', function ($q) {
				$q->where('status', 'inactive');
			})
			->count();

		return view('livewire.admin.student-menu.student', [
			'activeStudents' => $activeStudents,
			'inactiveStudents' => $inactiveStudents,
			'classes' => $classes,
			'academic_years' => $academic_years,
			'inactive_count' => $inactive_count
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
		$this->academic_year_id = '';
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
			'academic_year_id' => 'required',
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
				'academic_year_id' => $this->academic_year_id,
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
		$this->academic_year_id = $student->academic_year_id;
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
				'academic_year_id' => $this->academic_year_id,
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
		if (count($this->selected_id) == 0) {
			flash()->error('Please select at least one student');
			return;
		}

		DB::transaction(function () {
			ModelsStudent::whereIn('id', $this->selected_id)->delete();
			flash()->success('Student deleted successfully');
		});
		$this->selected_id = [];
	}

	public function syncYear()
	{
		$today = now();
		$currentAcademicYear = AcademicYear::where('school_id', Auth::user()->school_id)
			->where('status', 'active')
			->first();

		// cek apakah sudah tahun ajaran baru
		if ($today->format('Y-m-d') > $currentAcademicYear->end_date) {
			// jika ya, maka buat tahun ajar baru
			$newAcademicYear = AcademicYear::create([
				'school_id' => Auth::user()->school_id,
				'start_date' => Carbon::createFromDate(Carbon::parse($currentAcademicYear->end_date)->year, Carbon::parse($currentAcademicYear->start_date)->month, Carbon::parse($currentAcademicYear->start_date)->day)->format('Y-m-d'),
				'end_date' => Carbon::createFromDate(Carbon::parse($currentAcademicYear->end_date)->year + 1, Carbon::parse($currentAcademicYear->end_date)->month, Carbon::parse($currentAcademicYear->end_date)->day)->format('Y-m-d'),
			]);

			// matikan tahun ajaran sebelumnya
			$currentAcademicYear->update(['status' => 'inactive']);

			// proses pindah tahun ajaran ke siswa dan naik kelas
			$students = ModelsStudent::where('school_id', Auth::user()->school_id)
				->with('class.grade')
				->get();

			foreach ($students as $student) {
				$nextGrade = Grade::where('school_id', Auth::user()->school_id)
					->where('name', '>', $student->class->grade->name)
					->first();

				if ($nextGrade) {
					$nextClass = Classes::where('school_id', Auth::user()->school_id)
						->where('grade_id', $nextGrade->id)
						->where('name', $student->class->name)
						->first();

					if ($nextClass) {
						$student->update(['academic_year_id' => $newAcademicYear->id, 'class_id' => $nextClass->id]);
					}

					// flash()->success('Academic year updated successfully');
					$this->is_sync = true;
					$this->dispatch('sync', $this->is_sync);
				}
			}
		} else {
			$this->dispatch('sync', $this->is_sync);
		}
	}

	public function deleteAllInactive()
	{
		DB::transaction(function () {
			$inactiveAcademicYears = AcademicYear::where('school_id', Auth::user()->school_id)
				->where('status', 'inactive')
				->pluck('id');

			if ($inactiveAcademicYears->isNotEmpty()) {
				ModelsStudent::where('school_id', Auth::user()->school_id)
					->whereIn('academic_year_id', $inactiveAcademicYears)
					->lockForUpdate()
					->delete();
			}
		});
		flash()->success('All students deleted successfully');
	}
}
