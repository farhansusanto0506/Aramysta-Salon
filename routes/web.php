<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\PageContentController;

// Halaman Publik
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');

// Halaman Admin (Edit Konten Halaman)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/content/edit', [PageContentController::class, 'edit'])->name('content.edit');
    Route::put('/content/update', [PageContentController::class, 'update'])->name('content.update');
});