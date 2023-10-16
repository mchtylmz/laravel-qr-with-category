<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\QrCode;
use App\Models\Category;

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {

    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('index');

    Route::get('/qr-codes', [\App\Http\Controllers\QrController::class, 'index'])->name('qr_codes');
    Route::get('/qr-codes/add', [\App\Http\Controllers\QrController::class, 'add'])->name('qr_codes.add');
    Route::get('/qr-codes/print/{qrcode:id}', [\App\Http\Controllers\QrController::class, 'print'])->name('qr_codes.print');
    Route::post('/qr-codes/store', [\App\Http\Controllers\QrController::class, 'store'])->name('qr_codes.store');
    Route::post('/qr-codes/delete/{qrcode:id}', [\App\Http\Controllers\QrController::class, 'delete'])->name('qr_codes.delete');

    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
    Route::post('/categories/store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
    Route::post('/categories/delete/{category:id}', [\App\Http\Controllers\CategoryController::class, 'delete'])->name('categories.delete');
});
