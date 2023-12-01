<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LahanParkirController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\MaintenanceAlat;
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
// Route::get('/dashboard', function () {
//     return view('admin/dashboard');
// });
Route::get('/dashboard', [LahanParkirController::class, 'dashboard']);
// Lahan Parkir
Route::get('/lahan-parkir', [LahanParkirController::class, 'index']);
Route::get('/tambah-lahan-parkir', [LahanParkirController::class, 'formTambah']);
Route::post('/tambah-lahanParkir', [LahanParkirController::class, 'tambah']);
Route::get('/edit-lahan/{id}', [LahanParkirController::class, 'formEdit'])->name('edit-lahan');
Route::post('/update-lahan/{id}', [LahanParkirController::class, 'update'])->name('update-lahan');
Route::post('/hapus-lahan/{id}', [LahanParkirController::class, 'destroy'])->name('hapus-lahan');
Route::get('/logParkir', function () {
    return view('admin/Lahan/logParkir');
});

// alat IoT
// Route::get('/maintenancealat', function () {
//     return view('admin/Perangkat/maintenanceAlat');
// });
Route::get('/maintenance-alat', [MaintenanceAlat::class, 'index']);
Route::get('/tambah-maintenance-alat', [MaintenanceAlat::class, 'formTambah']);
Route::post('/simpan-maintenance-alat', [MaintenanceAlat::class, 'tambah'])->name('simpan-maintenance');
Route::post('/hapus-maintenance/{id}', [MaintenanceAlat::class, 'delete'])->name('hapus-maintenance');

Route::get('/alat-iot', [AlatController::class, 'index']);
Route::get('/tambah-alat-iot', [AlatController::class, 'formTambah'])->name('tambah-alat');
Route::post('/tambah-alat', [AlatController::class, 'tambah'])->name('tambah-iot');
Route::get('/edit-alat/{id}', [AlatController::class, 'formEdit'])->name('edit-alat');
Route::post('/update-alat/{id}', [AlatController::class, 'update'])->name('update-alat');
Route::post('/hapus-alat/{id}', [AlatController::class, 'destroy'])->name('hapus-alat');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
