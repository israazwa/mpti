<?php
namespace App\routes\web;

use App\Http\Controllers\admin\produkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Dashboard;
use App\Livewire\Shop;
use App\Livewire\Cart;
use App\Http\Controllers\paymentController;
use App\Livewire\Admin\Component\DashAdmin;
use App\Livewire\Admin\Component\ProductCreate;
use App\Livewire\Admin\Component\Tambahkategori;
use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\produkcrud;
use App\Livewire\Admin\Adminfix;
use App\Livewire\Contact;
use App\Livewire\Admin\Component\Cekuser;
use App\Livewire\Admin\Component\Listpro;
use App\Livewire\Admin\Replies;
use App\Livewire\Component\AboutUs;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
})->name('index');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/shop', Shop::class)->name('shop');
    Route::get('/cart', Cart::class)->name('cart');
    Route::post('/payment/notification', [paymentController::class, 'notification']);
    Route::post('/payment/recurring', [PaymentController::class, 'recurring']);
    Route::post('/payment/account', [PaymentController::class, 'accountStatus']);
    Route::get('/payment/finish', [PaymentController::class, 'finish']);
    Route::get('/payment/unfinish', [PaymentController::class, 'unfinish']);
    Route::get('/payment/error', [PaymentController::class, 'error']);
    Route::get('/aboutus', AboutUs::class)->name('aboutus');
    Route::get('/contactus', Contact::class)->name('contactus');
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::post('/midtrans/notification', [PaymentController::class, 'notification'])->name('midtrans.notification');


});

// Group khusus admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/homeAd', DashAdmin::class)->name('homeAd');
    Route::get('/inproduct', ProductCreate::class)->name('inProduct');
    Route::get('/inuser', Cekuser::class)->name('inuser');
    Route::post('/admin/products', [produkController::class, 'store'])->name('products.store');
    Route::get('/kategoriad', Tambahkategori::class)->name('kategoryad');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/allpro', Listpro::class)->name('allpro');
    Route::post('/products', [produkcrud::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [produkcrud::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [produkcrud::class, 'destroy'])->name('products.destroy');
    Route::get('/sokasiklu', Replies::class)->name('adminreply');
    Route::get('/atmin', Adminfix::class)->name('rilladmin');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth scaffolding routes (login, register, dll)
require __DIR__ . '/auth.php';