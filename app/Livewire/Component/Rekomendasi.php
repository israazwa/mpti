<?php

namespace App\Livewire\Component;

use Livewire\Component;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Rekomendasi extends Component
{
    public $cart = [];
    public $count = 0;
    public function updateCount()
    {
        $this->count = CartItem::where('user_id', Auth::id())->sum('quantity');
    }
    public function loadCart()
    {
        $this->cart = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get()
            ->map(fn($item) => [
                'id' => $item->product_id,
                'name' => $item->product->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'image' => $item->product->image ?? null,
            ])->toArray();

        $this->updateCount();
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
        session()->flash('success', 'Produk berhasil ditambahkan ke cart!');
        $this->loadCart();
        $this->dispatch('refreshCart');
        $this->dispatch('cart-added', [
            'message' => 'Produk berhasil ditambahkan ke cart!'
        ]);

    }

    public function render()
    {
        $products = Product::with('category')->paginate(10);
        $data = [
            'massage' => session('message'),
            'products' => $products,
        ];
        return view('livewire.component.rekomendasi', $data);
    }
}
