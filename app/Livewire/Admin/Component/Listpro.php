<?php

namespace App\Livewire\Admin\Component;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

use Livewire\Attributes\Layout;
#[Layout('layouts.admin')]
class Listpro extends Component
{
    use WithPagination;

    public $search = '';
    public $category_id = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::all();

        $products = Product::with('category')
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->category_id, fn($q) => $q->where('category_id', $this->category_id))
            ->paginate(10);


        $data = [
            'products' => $products,
            'categories' => $categories,
        ];
        return view('livewire.admin.component.listpro', $data);
    }
}
