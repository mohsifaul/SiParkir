<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LahanParkirController;
use App\Http\Controllers\AlatController;
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
    return view('homepage');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/homepage', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('admin/dashboard');
});
// Lahan Parkir
Route::get('/lahan-parkir', [LahanParkirController::class, 'index']);
Route::get('/tambah-lahan-parkir', [LahanParkirController::class, 'formTambah']);
Route::post('/tambah-lahanParkir', [LahanParkirController::class, 'tambah']);
Route::get('/edit-lahan/{id}', [LahanParkirController::class, 'formEdit'])->name('edit-lahan');
Route::get('/logParkir', function () {
    return view('admin/Lahan/logParkir');
});

// alat IoT
Route::get('/maintenancealat', function () {
    return view('admin/Perangkat/maintenanceAlat');
});
Route::get('/alat-iot', [AlatController::class, 'index']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
