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
Route::get('/login', [AuthenticatedSessionController::class, 'create'] );
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'] );
Route::resource('artikel', ArtikelController::class);
Route::resource('denda', DendaController::class);
Route::resource('perangkat', PerangkatController::class)->except('update');
Route::put('perangkat-update/{id}', [PerangkatController::class, 'update']);
Route::resource('resepsionis', ResepsionisController::class)->except('update');
Route::put('resepsionis-update/{id}', [ResepsionisController::class, 'update']);
Route::resource('ruang', RuangController::class)->except('update');
Route::put('ruang-update/{id}', [RuangController::class, 'update']);
Route::resource('testimonial', TestimonialController::class);
Route::put('testimonial-update/{id}', [TestimonialController::class, 'update']);
Route::resource('wishlist', WishlistController::class);

//Guest
Route::get('/guest-about', [HomeController::class, 'about']);
Route::get('/guest-perangkat', [HomeController::class, 'perangkat']);
Route::get('/guest-perangkat-detail/{id}', [HomeController::class, 'detail_perangkat']);
Route::get('/guest-ruang', [HomeController::class, 'ruang']);
Route::get('/guest-ruang-detail/{id}', [HomeController::class, 'detail_ruang']);
Route::get('/guest-contact', [HomeController::class, 'contact']);
Route::get('/guest-resepsionis', [HomeController::class, 'resepsionis']);
Route::get('/guest-resepsionis-detail', [HomeController::class, 'resepsionis_detail']);
Route::get('/guest-vr-room', [HomeController::class, 'vr_room']);

require __DIR__.'/auth.php';
