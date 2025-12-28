<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Livewire\Attributes\Layout;



#[Layout('layouts.app')]
class Cart extends Component
{
    // Field alamat
    public $nama_penerima;
    public $telepon;
    public $alamat_lengkap;
    public $kota;
    public $provinsi;
    public $kode_pos;
    public $catatan;

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

    // ... metode addToCart, removeFromCart, increaseQuantity, decreaseQuantity, updateQuantity, clearCart tetap sama ...

    public function checkout()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Simpan order ke DB
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . uniqid(),
            'subtotal' => 100000,   // tambahkan ini
            'grand_total' => 100000,
            'status' => 'pending',
        ]);

        // Data transaksi
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $order->grand_total,
            ],
            'customer_details' => [
                'first_name' => auth()->name ?? 'HAy',
                'email' => auth()->email ?? 'Hay@example.com',
                'phone' => auth()->phone ?? '08123456789',
            ],
        ];

        // Buat Snap Token
        $snapToken = Snap::getSnapToken($params);
        $this->dispatch('open-payment', ['snapToken' => $snapToken]);
        logger()->info('SnapToken', ['token' => $snapToken]);
        return response()->json(['snapToken' => $snapToken]);
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


    // Tambah produk ke cart
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

    // Hapus produk dari cart
    public function removeFromCart($productId)
    {
        CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        $this->loadCart();
        $this->dispatch('refreshCart');
    }

    // Tambah quantity
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

    // Kurangi quantity
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

    // Update quantity langsung
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

    // Kosongkan cart
    public function clearCart()
    {
        CartItem::where('user_id', Auth::id())->delete();
        $this->cart = [];
        $this->dispatch('refreshCart');
    }
}