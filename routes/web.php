<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\PortfolioItemController;

// Halaman Pengunjung (Publik)
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');

// Login & Logout Admin
Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Halaman Admin (Terkunci dengan middleware 'auth')
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Upload langsung foto Hero
    Route::post('/hero-image', [PageContentController::class, 'updateHeroImage'])->name('hero.image');

    // Kelola Karya Portofolio
    Route::get('/portfolios', [PortfolioItemController::class, 'index'])->name('portfolios.index');
    Route::post('/portfolios', [PortfolioItemController::class, 'store'])->name('portfolios.store');
    Route::get('/portfolios/{portfolio}/edit', [PortfolioItemController::class, 'edit'])->name('portfolios.edit');
    Route::put('/portfolios/{portfolio}', [PortfolioItemController::class, 'update'])->name('portfolios.update');
    Route::delete('/portfolios/{portfolio}', [PortfolioItemController::class, 'destroy'])->name('portfolios.destroy');
});