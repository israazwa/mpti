<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('layouts.admin')]
class HomeAd extends Component
{
    public $openProduk = false;

    public function toggleProduk()
    {
        $this->openProduk = !$this->openProduk;
    }


    public function render()
    {
        return view('livewire.admin.home-ad');
    }
}
