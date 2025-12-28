<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;

#[Layout('layouts.app')]
class Cartic extends Component
{
    public $count = 0;

    protected $listeners = ['refreshCart' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $this->count = CartItem::where('user_id', Auth::id())->sum('quantity');
    }

    public function render()
    {
        // boleh tetap ada, tapi tidak wajib ketika pakai poll method
        $this->updateCount();
        return view('livewire.cartic');
    }
}