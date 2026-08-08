<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// Front-end
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/galerie', [GalleryController::class, 'index'])->name('gallery');
Route::get('/reservation', [ReservationController::class, 'create'])->name('reservation');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/reservation/{reservation}/confirmation', [ReservationController::class, 'confirmation'])->name('reservation.confirmation');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [Admin\AuthController::class, 'login']);
    Route::post('logout', [Admin\AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

        // Reservations
        Route::get('reservations', [Admin\ReservationController::class, 'index'])->name('reservations.index');
        Route::patch('reservations/{reservation}/status', [Admin\ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');
        Route::delete('reservations/{reservation}', [Admin\ReservationController::class, 'destroy'])->name('reservations.destroy');

        // Services
        Route::resource('services', Admin\ServiceController::class)->except(['show']);

        // Categories
        Route::resource('categories', Admin\CategoryController::class)->except(['show']);

        // Staff
        Route::resource('staff', Admin\StaffController::class)->except(['show']);

        // Gallery
        Route::get('gallery', [Admin\GalleryController::class, 'index'])->name('gallery.index');
        Route::post('gallery', [Admin\GalleryController::class, 'store'])->name('gallery.store');
        Route::patch('gallery/{gallery}', [Admin\GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('gallery/{gallery}', [Admin\GalleryController::class, 'destroy'])->name('gallery.destroy');

        // Business Hours
        Route::get('hours', [Admin\BusinessHourController::class, 'index'])->name('hours.index');
        Route::put('hours', [Admin\BusinessHourController::class, 'update'])->name('hours.update');

        // Settings
        Route::get('settings', [Admin\SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [Admin\SettingController::class, 'update'])->name('settings.update');
    });
});
