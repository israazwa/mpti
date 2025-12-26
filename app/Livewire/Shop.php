<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Category;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

#[Layout('layouts.app')]
class Shop extends Component
{
    use WithPagination;

    public $category = null;
    public $categories = [];

    protected $listeners = ['addToCart' => 'addToCart'];

    public function mount()
    {
        // ambil semua kategori dari DB
        $this->categories = Category::all();
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);

        $item = CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        // update badge cart
        $this->dispatch('refreshCart');

        // notifikasi sukses
        $this->dispatch('notify', [
            'message' => 'Produk berhasil ditambahkan ke cart!'
        ]);

        // flash message (opsional)
        session()->flash('success', 'Produk berhasil ditambahkan ke cart!');
    }

    // Reset halaman ketika kategori berubah
    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query();

        if (!empty($this->category)) {
            $query->where('category_id', $this->category);
        }

        return view('livewire.shop', [
            'products' => $query->paginate(10),
            'categories' => $this->categories,
        ]);
    }
}