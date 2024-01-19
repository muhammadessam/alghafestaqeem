<?php

namespace App\Livewire\Contracts;

use Livewire\Component;
use Illuminate\Contracts\View\View;


class Index extends Component
{
    public function render(): View
    {
        return view('livewire.contracts.index');
    }
}
