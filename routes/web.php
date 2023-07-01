<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KaryawanController;


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
    return view('master');
});

Route::get('/pegawai', [PegawaiController::class, 'index'] );
Route::post('/pegawai', [PegawaiController::class, 'store']);
Route::put('/pegawai/update', [PegawaiController::class, 'update']);
Route::delete('/pegawai/delete/{id}', [PegawaiController::class, 'destroy']);
