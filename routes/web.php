<?php

use App\Http\Controllers\Admin\CotegoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard1', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

// Custom route
Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('/dashboard/tables', TableController::class);

    Route::resource('/dashboard/categories', CotegoryController::class)->names('categories');

    Route::resource('/dashboard/reservations', controller: ReservationController::class);
    Route::resource('/dashboard/menu', controller: MenuController::class);
    
}); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Custom route
Route::middleware(['admin', 'auth'])->group(function() {
    // Route::get("/dashboard")->name('admin.dashboard');
});

require __DIR__.'/auth.php';
