<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileEditController;
use App\Http\Controllers\RoomsController;
// use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[WelcomeController::class, 'depan']);
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';



Route::prefix('/dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('dashboard.app');
    })->name('dashboard');
    

    Route::get('profile', [ProfileEditController::class, 'profile'])->name('profile.edit');
    Route::put('profile', [ProfileEditController::class, 'profileUpdate'])->name('profile.update');

    Route::prefix('admin')->group(function () {
        // CRUD ROOMS
        Route::get('rooms', [RoomsController::class, 'index'])->name('rooms.index');
        Route::get('rooms-create', [RoomsController::class, 'create'])->name('rooms.create');
        Route::post('rooms-store', [RoomsController::class, 'store'])->name('rooms.store');
        Route::get('rooms-detail/{id}', [RoomsController::class, 'show'])->name('rooms.show');
        Route::get('rooms-edit/{id}', [RoomsController::class, 'edit'])->name('rooms.edit');
        Route::put('rooms-update/{id}', [RoomsController::class, 'update'])->name('rooms.update');
        Route::delete('rooms-delete/{id}', [RoomsController::class, 'destroy'])->name('rooms.destroy');

        // CRUD USER/ADMIN
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users-create', [UserController::class, 'create'])->name('users.create');
        Route::post('users-store', [UserController::class, 'store'])->name('users.store');
        Route::get('users-detail/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('users-edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users-update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users-delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');


        // CRUD BOOKINGS
        Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
        Route::get('bookings/create/{id}', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('bookings-store', [BookingController::class, 'store'])->name('bookings.store');
        Route::get('bookings-detail/{id}', [BookingController::class, 'show'])->name('bookings.show');
        Route::get('bookings-edit/{id}', [BookingController::class, 'edit'])->name('bookings.edit');
        Route::put('bookings-update/{id}', [BookingController::class, 'update'])->name('bookings.update');
        Route::delete('bookings-delete/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
        
        Route::get('bookings/confirm/{id}', [BookingController::class, 'confirm'])->name('bookings.confirm');
   
    });
});
