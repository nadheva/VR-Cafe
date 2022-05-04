<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\OrderPerangkatController;
use App\Http\Controllers\OrderStudioController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResepsionisController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\SewaPerangkatController;
use App\Http\Controllers\SewaRuangController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\OrderController as UserOrderController;
//User
use App\Http\Controllers\User\PerangkatController as UserPerangkat;
use App\Http\Controllers\User\RuangController as UserRuang;
use App\Http\Controllers\User\DendaController as UserDenda;
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



//Backend
Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard']);
    //Auth
    Route::get('login', [AuthenticatedSessionController::class, 'create'] );
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'] );
    //Wishlist
    Route::resource('wishlist', WishlistController::class);
    //Artikel
    Route::resource('artikel', ArtikelController::class)->except('update');
    Route::put('artikel-update/{id}', [ArtikelController::class, 'update']);

    //Perangkat
    Route::resource('perangkat', PerangkatController::class)->except('update');
    Route::put('perangkat-update/{id}', [PerangkatController::class, 'update']);

    //Resepsionis
    Route::resource('resepsionis', ResepsionisController::class)->except('update');
    Route::put('resepsionis-update/{id}', [ResepsionisController::class, 'update']);

    //Studio
    Route::resource('ruang', RuangController::class)->except('update');
    Route::put('ruang-update/{id}', [RuangController::class, 'update']);

    //Sewa Perangkat
    Route::resource('sewa-perangkat', SewaPerangkatController::class)->except('update', 'notificationHandler');
    Route::post('notificationHandler', [SewaPerangkatController::class, 'notificationHandler']);
    Route::put('sewa-perangkat-update/{id}', [SewaPerangkat::class, 'update']);

    //Sewa Studio
    Route::resource('sewa-ruang', SewaRuangController::class)->except('update', 'create');
    Route::get('sewa-ruang-create/{id}', [SewaRuangController::class, 'create'])->name('sewa-ruang-create');
    Route::put('sewa-ruang-update/{id}', [SewaRuangController::class, 'update']);

    //Testimonial
    Route::resource('testimonial', TestimonialController::class);
    Route::put('testimonial-update/{id}', [TestimonialController::class, 'update']);

    //Order/transaksi
    Route::resource('order-perangkat', OrderPerangkatController::class)->except('update');
    Route::put('order-perangkat-update/{id}', [OrderPerangkatController::class, 'update']);

    Route::resource('order-studio', OrderStudioController::class)->except('update');
    Route::put('order-studio-update/{id}', [OrderStudioController::class, 'update']);


    //Denda
    Route::resource('denda', DendaController::class)->except('update', 'store');
    Route::put('denda-update/{id}', [DendaController::class, 'update']);
    Route::get('storedenda', [DendaController::class, 'store']);

    //Profile
    Route::resource('profil', ProfileController::class);

    //Laporan
    Route::resource('laporan', LaporanController::class);
    Route::resource('user-perangkat', UserPerangkat::class);
    Route::resource('user-ruang', UserRuang::class);

    //Cart
    Route::resource('cart', CartController::class);
    // Route::get('cart', [CartController::class, 'index']);
    // Route::post('cart/store', [CartController::class, 'store'] );
    // Route::put('update-cart', [CartController::class, 'update']);
    // Route::delete('remove-from-cart', [CartController::class, 'destroy']);

    //user-order
    Route::resource('user-transaksi', UserOrderController::class);

    //user-denda
    Route::resource('user-denda', UserDenda::class);

});

//FrontEnd
Route::get('/', [BerandaController::class, 'index']);
Route::get('/guest-about', [BerandaController::class, 'about']);
Route::get('/guest-contact', [BerandaController::class, 'contact']);
Route::get('/guest-perangkat', [BerandaController::class, 'perangkat']);
Route::get('/guest-perangkat-detail/{id}', [BerandaController::class, 'detail_perangkat']);
Route::get('/guest-ruang', [BerandaController::class, 'ruang']);
Route::get('/guest-ruang-detail/{id}', [BerandaController::class, 'detail_ruang']);
Route::get('/guest-contact', [BerandaController::class, 'contact']);
Route::get('/guest-resepsionis', [BerandaController::class, 'resepsionis']);
Route::get('/guest-resepsionis-detail', [BerandaController::class, 'resepsionis_detail']);
Route::get('/guest-artikel', [BerandaController::class, 'artikel']);
Route::get('/guest-artikel-detail/{id}', [BerandaController::class, 'artikel_detail']);
Route::get('/guest-vr-room', [BerandaController::class, 'vr_room']);

require __DIR__.'/auth.php';
