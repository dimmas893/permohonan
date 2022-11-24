<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/persyaratan', [App\Http\Controllers\PersyaratanController::class, 'index'])->name('persyaratan');
Route::post('/persyaratan/store', [App\Http\Controllers\PersyaratanController::class, 'store'])->name('persyaratan-store');
Route::get('/persyaratan/all', [App\Http\Controllers\PersyaratanController::class, 'all'])->name('persyaratan-all');
Route::get('/persyaratan/edit', [App\Http\Controllers\PersyaratanController::class, 'edit'])->name('persyaratan-edit');
Route::post('/persyaratan/update', [App\Http\Controllers\PersyaratanController::class, 'update'])->name('persyaratan-update');
Route::delete('/persyaratan/delete', [App\Http\Controllers\PersyaratanController::class, 'delete'])->name('persyaratan-delete');


Route::get('/layanan', [App\Http\Controllers\LayananController::class, 'index'])->name('layanan');
Route::post('/layanan/store', [App\Http\Controllers\LayananController::class, 'store'])->name('layanan-store');
Route::get('/layanan/all', [App\Http\Controllers\LayananController::class, 'all'])->name('layanan-all');
Route::get('/layanan/edit', [App\Http\Controllers\LayananController::class, 'edit'])->name('layanan-edit');
Route::post('/layanan/update', [App\Http\Controllers\LayananController::class, 'update'])->name('layanan-update');
Route::delete('/layanan/delete', [App\Http\Controllers\LayananController::class, 'delete'])->name('layanan-delete');

Route::get('/rincian_layanan', [App\Http\Controllers\RincianLayananController::class, 'index'])->name('rincian_layanan');
Route::post('/rincian_layanan/store', [App\Http\Controllers\RincianLayananController::class, 'store'])->name('rincian_layanan-store');
Route::get('/rincian_layanan/all', [App\Http\Controllers\RincianLayananController::class, 'all'])->name('rincian_layanan-all');
Route::get('/rincian_layanan/edit', [App\Http\Controllers\RincianLayananController::class, 'edit'])->name('rincian_layanan-edit');
Route::post('/rincian_layanan/update', [App\Http\Controllers\RincianLayananController::class, 'update'])->name('rincian_layanan-update');
Route::delete('/rincian_layanan/delete', [App\Http\Controllers\RincianLayananController::class, 'delete'])->name('rincian_layanan-delete');


Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user-store');
Route::get('/user/all', [App\Http\Controllers\UserController::class, 'all'])->name('user-all');
Route::get('/user/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user-edit');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user-update');
Route::delete('/user/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user-delete');


Route::get('/pemohon', [App\Http\Controllers\PemohonController::class, 'index'])->name('pemohon');
Route::post('/pemohon/store', [App\Http\Controllers\PemohonController::class, 'store'])->name('pemohon-store');
Route::get('/pemohon/all', [App\Http\Controllers\PemohonController::class, 'all'])->name('pemohon-all');
Route::get('/pemohon/edit', [App\Http\Controllers\PemohonController::class, 'edit'])->name('pemohon-edit');
Route::post('/pemohon/update', [App\Http\Controllers\PemohonController::class, 'update'])->name('pemohon-update');
Route::delete('/pemohon/delete', [App\Http\Controllers\PemohonController::class, 'delete'])->name('pemohon-delete');

Route::get('/pemohonan', [App\Http\Controllers\PemohonanController::class, 'index'])->name('pemohonan');
Route::post('/pemohonan/store', [App\Http\Controllers\PemohonanController::class, 'store'])->name('pemohonan-store');
Route::get('/pemohonan/all', [App\Http\Controllers\PemohonanController::class, 'all'])->name('pemohonan-all');
Route::get('/pemohonan/edit', [App\Http\Controllers\PemohonanController::class, 'edit'])->name('pemohonan-edit');
Route::post('/pemohonan/update', [App\Http\Controllers\PemohonanController::class, 'update'])->name('pemohonan-update');
Route::delete('/pemohonan/delete', [App\Http\Controllers\PemohonanController::class, 'delete'])->name('pemohonan-delete');

require __DIR__.'/auth.php';
