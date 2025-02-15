<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentSelect extends Component
{
    public $search = '';
    public $selectedStudent = null;
    public $students = [];

    public function updatedSearch()
    {
        // Cari siswa berdasarkan nama atau kriteria lain dengan eager loading relasi
        $this->students = Student::where('school_id', Auth::user()->school_id)
            ->with('class.grade', 'class.department')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('nis', 'like', '%' . $this->search . '%')
            ->limit(10)
            ->get();
    }

    public function selectStudent($studentId)
    {
        $this->selectedStudent = Student::with(['class.grade', 'class.department'])
            ->findOrFail($studentId);
        
        $this->dispatch('student-selected', student: $this->selectedStudent->toArray());
        
        // Reset pencarian setelah memilih
        $this->search = '';
        $this->students = [];
    }

    public function render()
    {
        return view('livewire.student-select', [
            'students' => $this->students
        ]);
    }
}