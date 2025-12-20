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
        // hitung jumlah quantity langsung dari DB
        $this->count = CartItem::where('user_id', Auth::id())->sum('quantity');
    }

    public function render()
    {
        return view('livewire.cartic', [
            'count' => CartItem::where('user_id', Auth::id())->sum('quantity')
        ]);
    }
}