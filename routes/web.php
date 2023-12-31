<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LahanParkirController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\MaintenanceAlat;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
// Route::get('/homepage', function () {
//     return view('welcome');
// });
// Route::get('/dashboard', function () {
//     return view('admin/dashboard');
// });

Route::get('/', function () {
    return view('homepage');
});
Route::get('/coba', function () {
    return view('admin/parkir/coba');
});
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/masuk', [UserController::class, 'auth'])->name('masuk');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Route::middleware(['auth:api'])->group(function () {
    Route::get('/dashboard', [LahanParkirController::class, 'dashboard'])->name('dashboard');
    Route::get('/statistikUmum', [LahanParkirController::class, 'statistikUmum']);

    // Lahan Parkir
    Route::get('/lahan-parkir', [LahanParkirController::class, 'index']);
    Route::get('/tambah-lahan-parkir', [LahanParkirController::class, 'formTambah']);
    Route::post('/tambah-lahanParkir', [LahanParkirController::class, 'tambah']);
    Route::get('/edit-lahan/{id}', [LahanParkirController::class, 'formEdit'])->name('edit-lahan');
    Route::post('/update-lahan/{id}', [LahanParkirController::class, 'update'])->name('update-lahan');
    Route::post('/hapus-lahan/{id}', [LahanParkirController::class, 'destroy'])->name('hapus-lahan');
    Route::get('/log-parkir', [LahanParkirController::class, 'log']);

    // alat IoT
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
// });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
