<?php

namespace App\Livewire\Superadmin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\School;
use App\Models\Student;
use App\Models\ViolationCategory;
use App\Models\Violation;

class Dashboard extends Component
{
    public function render()
    {


        return view('livewire.superadmin.dashboard', [
            'totalSchools' => School::count(),
            'totalStudents' => Student::count(),
            'totalTeachers' => User::where('role', 'teacher')->count(),
            'totalViolations' => Violation::count(),
        ]);
    }
}
