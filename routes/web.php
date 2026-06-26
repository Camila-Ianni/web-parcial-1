<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostManagementController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/productos', [ProductController::class, 'index'])->name('products.index');
Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::prefix('carrito')->name('cart.')->group(function (): void {
	Route::get('/resumen', [CartController::class, 'summary'])->name('summary');
	Route::post('/agregar', [CartController::class, 'add'])->name('add');
	Route::post('/quitar', [CartController::class, 'remove'])->name('remove');
	Route::post('/vaciar', [CartController::class, 'clear'])->name('clear');
});

Route::middleware('guest')->group(function (): void {
	Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
	Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
	Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
	Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function (): void {
	Route::get('/', DashboardController::class)->name('dashboard');

	Route::resource('posts', PostManagementController::class)->except(['show']);
	Route::resource('products', ProductManagementController::class)->except(['show']);
	Route::get('users', [UserManagementController::class, 'index'])->name('users.index');
	Route::get('users/{user}', [UserManagementController::class, 'show'])->name('users.show');
});
