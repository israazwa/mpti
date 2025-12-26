<?php

namespace App\Livewire\Admin\Component;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

use Livewire\Attributes\Layout;
#[Layout('layouts.admin')]
class ProductCreate extends Component
{
    use WithFileUploads;

    public $category_id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $image;
    public $is_active = true;

    protected $rules = [
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable',
        'is_active' => 'boolean',
    ];

    public function save()
    {
        $this->validate();

        $path = $this->image ? $this->image->store('products', 'public') : null;

        $product = Product::create([
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $path,
            'is_active' => $this->is_active,
        ]);
        Log::info('Save method called', [
            'name' => $this->name,
            'price' => $this->price,
        ]);

        if ($product) {
            session()->flash('success', 'Produk berhasil ditambahkan!');
            $this->reset(['category_id', 'name', 'description', 'price', 'stock', 'image', 'is_active']);
        } else {
            session()->flash('error', 'Produk gagal ditambahkan!');
        }
    }

    public function render()
    {
        return view('livewire.admin.component.product-create', [
            'categories' => Category::all()
        ]);
    }
}
