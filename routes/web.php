<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'rolemanager:admin'])->name('admin');

Route::get('/customer/dashboard', function () {
    return view('customer.dashboard');
})->middleware(['auth', 'verified', 'rolemanager:customer'])->name('customer');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/cars', [CarController::class, 'index'])->name('admin.cars');
    Route::get('/admin/cars/add', [CarController::class, 'add'])->name('admin.cars.add');
    Route::post('/admin/cars/save', [CarController::class, 'save'])->name('admin.cars.save');
    Route::get('/admin/cars/edit/{id}', [CarController::class, 'edit'])->name('admin.cars.edit');
    Route::put('/admin/cars/edit/{id}', [CarController::class, 'update'])->name('admin.cars.update');
    Route::get('/admin/cars/delete/{id}', [CarController::class, 'delete'])->name('admin.cars.delete');
});

require __DIR__.'/auth.php';
