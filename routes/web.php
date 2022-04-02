<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OrderController;
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

//dashboard
Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [HomeController::class, 'dashboard']);

    //Auth
    Route::get('login', [AuthenticatedSessionController::class, 'create'] );
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'] );

    //Artikel
    Route::resource('artikel', ArtikelController::class);

    //Perangkat
    Route::resource('perangkat', PerangkatController::class)->except('update');
    Route::put('perangkat-update/{id}', [PerangkatController::class, 'update']);

    //Resepsionis
    Route::resource('resepsionis', ResepsionisController::class)->except('update');
    Route::put('resepsionis-update/{id}', [ResepsionisController::class, 'update']);

    //Studio
    Route::resource('ruang', RuangController::class)->except('update');
    Route::put('ruang-update/{id}', [RuangController::class, 'update']);

    //Testimonial
    Route::resource('testimonial', TestimonialController::class);
    Route::put('testimonial-update/{id}', [TestimonialController::class, 'update']);

    //Wishlist
    Route::resource('wishlist', WishlistController::class);

    //Sewa Perangkat
    Route::resource('sewa-perangkat', SewaPerangkatController::class)->except('update');
    Route::put('sewa-perangkat-update/{id}', [SewaPerangkat::class, 'update']);

    //Sewa Studio
    Route::resource('sewa-ruang', SewaRuangController::class)->except('update');
    Route::put('sewa-ruang-update/{id}', [SewaRuangController::class, 'update']);

    //Order
    Route::resource('order', OrderController::class)->except('update');
    Route::put('order-update/{id}', [OrderController::class, 'update']);

    //Denda
    Route::resource('denda', DendaController::class)->except('update');
    Route::put('denda-update/{id}', [DendaController::class, 'update']);

    //Profile
    Route::resource('profile', ProfileController::class)->except('update');
    Route::put('profile-update/{id}', [ProfileController::class, 'update']);

    //Laporan
    Route::resource('laporan', LaporanController::class);
});

//Guest
Route::get('/', [HomeController::class, 'index']);
Route::get('/guest-about', [HomeController::class, 'about']);
Route::get('/guest-contact', [HomeController::class, 'contact']);
Route::get('/guest-perangkat', [HomeController::class, 'perangkat']);
Route::get('/guest-perangkat-detail/{id}', [HomeController::class, 'detail_perangkat']);
Route::get('/guest-ruang', [HomeController::class, 'ruang']);
Route::get('/guest-ruang-detail/{id}', [HomeController::class, 'detail_ruang']);
Route::get('/guest-contact', [HomeController::class, 'contact']);
Route::get('/guest-resepsionis', [HomeController::class, 'resepsionis']);
Route::get('/guest-resepsionis-detail', [HomeController::class, 'resepsionis_detail']);
Route::get('/guest-vr-room', [HomeController::class, 'vr_room']);

require __DIR__.'/auth.php';
