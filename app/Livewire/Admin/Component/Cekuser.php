<?php

namespace App\Livewire\Admin\Component;

use Livewire\Component;
use App\Models\Payment;

use Livewire\Attributes\Layout;
#[Layout('layouts.admin')]
class Cekuser extends Component
{
    public $payments;

    public function mount()
    {
        // Ambil semua payment dengan relasi order + user
        $this->payments = Payment::with('order.user')->latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.component.cekuser', [
            'payments' => $this->payments
        ]);
    }
}