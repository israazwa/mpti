<?php

namespace App\Livewire\Admin\Component;

use Livewire\Component;
use App\Models\Category;


use Livewire\Attributes\Layout;
#[Layout('layouts.admin')]
class Tambahkategori extends Component
{
    public $categories;

    public function mount()
    {
        // Ambil semua kategori dengan jumlah produk
        $this->categories = Category::withCount('products')->get();
    }

    public function render()
    {
        return view('livewire.admin.component.tambahkategori');
    }
}
