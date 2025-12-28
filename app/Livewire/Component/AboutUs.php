<?php

namespace App\Livewire\Component;

use Livewire\Component;

use Livewire\Attributes\Layout;
#[Layout('layouts.app')]
class AboutUs extends Component
{
    public function render()
    {
        return view('livewire.component.about-us');
    }
}
