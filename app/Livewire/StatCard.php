<?php

namespace App\Livewire;

use Livewire\Component;

class StatCard extends Component
{
    public $hint;
    public $icon;
    public $title;
    public $value;

    // public function mount($icon, $title, $hint, $value)
    // {
    //     $this->icon = $icon;
    //     $this->title = $title;
    //     $this->hint = $hint;
    //     $this->value = $value;
    // }

    public function render()
    {
        return view('livewire.stat-card');
    }
}
