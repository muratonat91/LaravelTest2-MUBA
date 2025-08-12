<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {


    // Ürünler için route'lar
    Route::resource('products', ProductController::class);
    // Ürün resimlerini güncelleme ve silme işlemleri için özel route'lar
    Route::post('products/{product}/images', [ProductController::class, 'editsayfasindaresimekleme'])->name('editsayfasindaresimekleme');
    Route::put('products/{product}/images/{image}', [ProductController::class, 'tekresimguncelle'])->name('tekresimguncelle');
    Route::delete('images/{image}', [ProductController::class, 'tekresimsil'])->name('tekresimsil');


    Route::resource('category', CategoryController::class);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





require __DIR__ . '/auth.php';
