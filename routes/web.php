<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResepsionisController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\SewaPerangkatController;
use App\Http\Controllers\SewaRuangController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WishlistController;

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

// Route::get('/', function () {
//     return view('guest.index');
// });
Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'] );

require __DIR__.'/auth.php';
