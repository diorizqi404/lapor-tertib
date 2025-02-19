<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Student;
use App\Models\Violation;
use App\Models\Punishment;
use Livewire\Attributes\Layout;

class StudentInfo extends Component
{
    #[Layout('layouts.dashboard-student')]
    public $student;
    public $classes;
    public $violations;
    public $point;
    public $punishment;

    public function mount(Student $student)
    {
        $this->student = $student;

        $this->point = Violation::where('student_id', $this->student->id)
            ->sum('point');

        $min_point = Punishment::where('school_id', $this->student->school_id)
            ->where('min_point', '<=', $this->point)
            ->orderBy('min_point', 'desc')
            ->first();

        $this->punishment = $min_point ? $min_point->name : 'Tidak mendapat hukuman';

        $this->violations = Violation::where('student_id', $this->student->id)
            ->with('violationCategory', 'teacher')
            ->orderBy('datetime', 'desc')
            ->get();
    }

    public function backToSearch()
    {
        return redirect()->route('student.search');
    }

    public function render()
    {
        return view('livewire.student.student-info', [
            'student' => $this->student
        ]);
    }
}
