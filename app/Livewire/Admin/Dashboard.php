<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\ViolationCategory;
use App\Models\Violation;

class Dashboard extends Component
{
    public function render()
    {
        $school_id = Auth::user()->school_id;

        $totalTeachers = User::where('school_id', $school_id)->where('role', 'teacher')->count();
        $totalStudents = Student::where('school_id', $school_id)->count();
        $totalCategories = ViolationCategory::where('school_id', $school_id)->count();
        $totalViolations = Violation::where('school_id', $school_id)->count();

        return view('livewire.admin.dashboard', [
            'totalTeachers' => $totalTeachers,
            'totalStudents' => $totalStudents,
            'totalCategories' => $totalCategories,
            'totalViolations' => $totalViolations,
        ]);
    }
}
