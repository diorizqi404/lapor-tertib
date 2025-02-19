<?php

namespace App\Livewire\Student;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Student as ModelsStudent;
use Illuminate\Support\Facades\Session;
use App\Models\Violation;
use Illuminate\Support\Facades\URL;

class SearchStudent extends Component
{
    #[Layout('layouts.dashboard-student')]

    public $selectedSchool;
    public $violations;
    public $nis;
    public $notelp;

    public function render()
    {
        $student = ModelsStudent::find(Session::get('student_id'));

        return view(
            'livewire.student.search-student',
            [
                'violations' => $this->violations
            ]
        );
    }

    protected $listeners = ['school-selected' => 'onStudentSelected'];

    public function onStudentSelected($school)
    {
        $this->selectedSchool = $school;
    }

    public function rules()
    {
        return [
            'selectedSchool.id' => 'required',
            'notelp' => 'required|numeric',
            'nis' => 'required|numeric'
        ];
    }

    public function searchStudent()
    {
        $this->validate();

        $student = ModelsStudent::where('school_id', $this->selectedSchool['id'])
            ->where('nis', $this->nis)
            ->where('parent_phone', $this->notelp)
            ->with('class.grade', 'class.department', 'academicYear')
            ->first();


        if (!$student) {
            flash()->error('Data siswa tidak ditemukan');
            return;
        }

        $url = URL::temporarySignedRoute('student.info', now()->addMinutes(30), [
            'student' => $student->id,
            'token' => bin2hex(random_bytes(10))
        ]);

        return redirect()->to($url);
    }
}
