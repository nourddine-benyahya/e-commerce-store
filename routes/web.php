<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Show the form to create a new product
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/index', [ProductController::class, 'index'])->name('products.index');

// Store a new product in the database
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Show the form to edit an existing product
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Update an existing product in the database
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

// Delete a product from the database
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

require __DIR__.'/auth.php';
