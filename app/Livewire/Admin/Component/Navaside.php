<?php

namespace App\Livewire\Admin\Component;

use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('layouts.admin')]
class Navaside extends Component
{
    public function render()
    {
        return view('livewire.admin.component.navaside');
    }
}
