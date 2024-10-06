<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentCarController;
use App\Http\Controllers\ReturnCarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register');
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
    Route::post('/admin/cars', [CarController::class, 'search'])->name('admin.cars.search');
    Route::get('/admin/cars/add', [CarController::class, 'add'])->name('admin.cars.add');
    Route::post('/admin/cars/save', [CarController::class, 'save'])->name('admin.cars.save');
    Route::get('/admin/cars/edit/{id}', [CarController::class, 'edit'])->name('admin.cars.edit');
    Route::put('/admin/cars/edit/{id}', [CarController::class, 'update'])->name('admin.cars.update');
    Route::get('/admin/cars/delete/{id}', [CarController::class, 'delete'])->name('admin.cars.delete');

    Route::get('/admin/rents', [RentCarController::class, 'index'])->name('admin.rents');
    Route::get('/admin/returns', [ReturnCarController::class, 'index'])->name('admin.returns');

    Route::get('/customer/cars', [CarController::class, 'custIndex'])->name('customer.cars');
    Route::get('/customer/cars/rent/{id}', [CarController::class, 'rentCar'])->name('customer.cars.rent');
    
    Route::get('/customer/rents', [RentCarController::class, 'custIndex'])->name('customer.rents');
    Route::post('/customer/rents/save', [RentCarController::class, 'save'])->name('customer.rents.save');
    
    Route::get('/customer/returns', [ReturnCarController::class, 'custIndex'])->name('customer.returns');
    Route::get('/customer/cars/returns/', [ReturnCarController::class, 'carReturn'])->name('customer.cars.return');
    Route::post('/customer/cars/returns/', [RentCarController::class, 'findByPlate'])->name('customer.cars.find');
    Route::post('/customer/returns/save', [ReturnCarController::class, 'save'])->name('customer.returns.save');
});

require __DIR__.'/auth.php';
