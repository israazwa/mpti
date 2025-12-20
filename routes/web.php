<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ControllerAdmin;
use App\Http\Controllers\Controller;
use App\Http\Middleware\RoleMiddleware;

use App\Livewire\Dashboard;
use App\Livewire\Shop;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Cart;
use App\Http\Controllers\paymentController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});
// Route::get('/cart', Cart::class)->name('cart');

// Group untuk user & admin
Route::middleware(['auth', 'role:user,admin'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/shop', Shop::class)->name('shop');
    Route::get('/cart', Cart::class)->name('cart');
    // routes/web.php
    Route::post('/payment/notification', [paymentController::class, 'notification']);
    Route::post('/payment/recurring', [PaymentController::class, 'recurring']);
    Route::post('/payment/account', [PaymentController::class, 'accountStatus']);
    Route::get('/payment/finish', [PaymentController::class, 'finish']);
    Route::get('/payment/unfinish', [PaymentController::class, 'unfinish']);
    Route::get('/payment/error', [PaymentController::class, 'error']);
});

// Group khusus admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', AdminDashboard::class)->name('admin.dashboard');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth scaffolding routes (login, register, dll)
require __DIR__ . '/auth.php';