<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\School;
use Illuminate\Support\Facades\Auth;

class SchoolSelect extends Component
{
    public $search = '';
    public $selectedSchool = null;
    public $schools = [];

    public function updatedSearch()
    {
        // Cari sekolah berdasarkan nama atau kriteria lain
        $this->schools = School::where('name', 'like', '%' . $this->search . '%')
            ->limit(10)
            ->get();
    }

    public function selectSchool($schoolId)
    {
        $this->selectedSchool = School::findOrFail($schoolId);
        
        $this->dispatch('school-selected', school: $this->selectedSchool->toArray());
        
        // Reset pencarian setelah memilih
        $this->search = '';
        $this->schools = [];
    }
    
    public function render()
    {
        return view('livewire.school-select', [
            'schools' => $this->schools
        ]);
    }
}
