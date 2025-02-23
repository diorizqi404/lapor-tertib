<?php

namespace App\Livewire;

use Livewire\Component;

class DateSelector extends Component
{
    public $dateType = 'date'; // Default: Harian
    public $value;

    public function updated($property)
    {
        $this->dispatch('filterUpdated', $this->dateType, $this->value);
    }

    public function render()
    {
        return view('livewire.date-selector');
    }
}
