<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('customer/register', [CustomerController::class, 'index'])->name('customer.register');
Route::post('customer/store', [CustomerController::class, 'store'])->name('customer.store');

Route::get('verify/{id}', [CustomerController::class, 'verification'])->name('verification');

Route::get('admin/register', [AdminController::class, 'index'])->name('admin.register');
Route::post('admin/store', [AdminController::class, 'store'])->name('admin.store');

Route::get('custom/login', [LoginController::class, 'index'])->name('custom.login');
Route::post('custom/login', [LoginController::class, 'Authentication'])->name('customs.login');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
