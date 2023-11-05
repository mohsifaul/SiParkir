<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LahanParkirController;
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
Route::get('/lahan-parkir', [LahanParkirController::class, 'index']);
Route::get('/tambahlahanParkir', function () {
    return view('admin/Lahan/tambahLahan');
});
Route::get('/editlahanParkir', function () {
    return view('admin/Lahan/editLahan');
});
Route::get('/logParkir', function () {
    return view('admin/Lahan/logParkir');
});
Route::get('/maintenancealat', function () {
    return view('admin/Perangkat/maintenanceAlat');
});
Route::post('/tambah', [lahanController::class, 'store']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
