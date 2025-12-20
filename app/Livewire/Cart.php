<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]

class Cart extends Component
{
    public $cart = [];
    public $count = 0;

    protected $listeners = ['addToCart' => 'addToCart', 'refreshCart' => 'updateCount'];

    public function mount()
    {
        $this->loadCart();
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

    public function updateCount()
    {
        $this->count = CartItem::where('user_id', Auth::id())->sum('quantity');
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

        $this->loadCart();
        $this->dispatch('refreshCart');
        $this->dispatch('cart-added', [
            'message' => 'Produk berhasil ditambahkan ke cart!'
        ]);
    }

    public function removeFromCart($productId)
    {
        CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        $this->loadCart();
        $this->dispatch('refreshCart');
    }
    public function increaseQuantity($productId)
    {
        $item = CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($item) {
            $item->increment('quantity');
        }

        $this->loadCart();
        $this->dispatch('refreshCart');
    }

    public function decreaseQuantity($productId)
    {
        $item = CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($item && $item->quantity > 1) {
            $item->decrement('quantity');
        }

        $this->loadCart();
        $this->dispatch('refreshCart');
    }

    public function updateQuantity($productId, $quantity)
    {
        $item = CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($item) {
            $item->update(['quantity' => max(1, $quantity)]);
        }

        $this->loadCart();
        $this->dispatch('refreshCart');
    }

    public function clearCart()
    {
        CartItem::where('user_id', Auth::id())->delete();
        $this->cart = [];
        $this->dispatch('refreshCart');
    }

    public function checkout()
    {
        $subtotal = CartItem::where('user_id', Auth::id())
            ->sum(DB::raw('price * quantity'));

        if ($subtotal <= 0) {
            $this->dispatch('notify', ['message' => 'Cart kosong, tidak bisa checkout!']);
            return;
        }

        $snapToken = $this->createSnapToken($subtotal);

        // Debug log
        logger()->info('SnapToken dibuat', ['token' => $snapToken]);

        $this->dispatch('open-payment', ['snapToken' => $snapToken]);
    }

    public function createSnapToken($amount)
    {
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name ?? 'Guest',
                'email' => Auth::user()->email ?? 'guest@example.com',
            ],
        ];

        try {
            return Snap::getSnapToken($params);
        } catch (\Exception $e) {
            logger()->error('Midtrans error: ' . $e->getMessage());
            return null;
        }
    }

    public function getTotalProperty()
    {
        return CartItem::where('user_id', Auth::id())
            ->sum(DB::raw('price * quantity'));
    }

    public function render()
    {
        return view('livewire.cart', [
            'cart' => $this->cart,
            'total' => $this->total,
        ]);
    }
}