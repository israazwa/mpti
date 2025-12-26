<?php

namespace App\Livewire\Admin\Component;

use Livewire\Component;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;


use Livewire\Attributes\Layout;
#[Layout('layouts.admin')]
class DashAdmin extends Component
{
    public $totalOrders;
    public $totalRevenue;
    public $pendingOrders;
    public $totalUsers;
    public $activeProducts;
    public $emptyCategories;

    public function mount()
    {
        // Total Orders hanya sukses
        $this->totalOrders = Order::whereIn('status', ['paid', 'completed'])->count();

        // Revenue hanya sukses
        $this->totalRevenue = Order::whereIn('status', ['paid', 'completed'])
            ->sum('grand_total');

        // Pending Orders
        $this->pendingOrders = Order::where('status', 'pending')->count();

        // Users
        $this->totalUsers = User::count();

        // Produk aktif
        $this->activeProducts = Product::where('is_active', true)->count();

        // Kategori kosong (tidak punya produk aktif)
        $this->emptyCategories = Category::whereDoesntHave('products', function ($q) {
            $q->where('is_active', true);
        })->count();
    }


    public function render()
    {

        return view('livewire.admin.component.dash-admin');
    }
}
