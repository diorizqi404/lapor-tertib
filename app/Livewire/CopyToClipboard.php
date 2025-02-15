<?php

namespace App\Livewire;

use Livewire\Component;

class CopyToClipboard extends Component
{
    public string $text;
    public bool $copied = false;

    public function render()
    {
        return view('livewire.copy-to-clipboard');
    }
}
