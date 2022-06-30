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
use App\Http\Controllers\StudioController;
use App\Http\Controllers\SewaPerangkatController;
use App\Http\Controllers\SewaStudioController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DendaPerangkatController;
use App\Http\Controllers\DendaStudioController;
use App\Http\Controllers\JadwalController;
use Illuminate\Support\Facades\Artisan;

//User
use App\Http\Controllers\User\OrderPerangkatController as UserOrderPerangkatController;
use App\Http\Controllers\User\OrderStudioController as UserOrderStudioController;
use App\Http\Controllers\User\PerangkatController as UserPerangkat;
use App\Http\Controllers\User\StudioController as UserStudio;
use App\Http\Controllers\User\DendaController as UserDenda;

//Guest
use App\Http\Controllers\Guest\ArtikelController as GuestArtikel;
use App\Http\Controllers\Guest\KontakController as GuestKontak;
use App\Http\Controllers\Guest\PerangkatController as GuestPerangkat;
use App\Http\Controllers\Guest\ResepsionisController as GuestResepsionis;
use App\Http\Controllers\Guest\StudioController as GuestStudio;
use App\Http\Controllers\Guest\TentangController as GuestTentang;
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
    Route::resource('studio', StudioController::class)->except('update');
    Route::put('studio-update/{id}', [StudioController::class, 'update']);

    //Sewa Perangkat
    Route::resource('sewa-perangkat', SewaPerangkatController::class)->except('update', 'notificationHandler');
    Route::post('notificationHandler', [SewaPerangkatController::class, 'notificationHandler']);
    Route::put('sewa-perangkat-update/{id}', [SewaPerangkatController::class, 'update']);

    //Sewa Studio
    Route::resource('sewa-studio', SewaStudioController::class)->except('update', 'create', 'cek_studio', 'approve', 'deny');
    Route::get('sewa-studio-create/{id}', [SewaStudioController::class, 'create'])->name('sewa-studio-create');
    Route::post('cek-studio', [SewaStudioController::class, 'cek_studio'])->name('cek-studio');
    Route::put('sewa-studio-update/{id}', [SewaStudioController::class, 'update']);
    Route::put('sewa-studio-approve/{id}', [SewaStudioController::class, 'approve'])->name('approve-studio');
    Route::put('sewa-studio-deny/{id}', [SewaStudioController::class, 'deny'])->name('deny-studio');


    //Testimonial
    Route::resource('testimonial', TestimonialController::class);
    Route::put('testimonial-update/{id}', [TestimonialController::class, 'update']);

    //Order/transaksi
    Route::resource('order-perangkat', OrderPerangkatController::class)->except('update', 'pengembalian');
    Route::get('pengembalian-perangkat', [OrderPerangkatController::class, 'pengembalian'])->name('pengembalian-perangkat');
    Route::put('order-perangkat-update/{id}', [OrderPerangkatController::class, 'update']);

    Route::resource('order-studio', OrderStudioController::class)->except('update', 'pengembalian');
    Route::get('pengembalian-studio', [OrderStudioController::class, 'pengembalian'])->name('pengembalian-studio');
    Route::put('order-studio-update/{id}', [OrderStudioController::class, 'update']);


    //Denda
    Route::resource('denda-perangkat', DendaPerangkatController::class);
    Route::resource('denda-studio', DendaStudioController::class);
    Route::resource('denda', DendaController::class)->except('update', 'store');
    Route::put('denda-update/{id}', [DendaController::class, 'update']);
    Route::get('storedenda', [DendaController::class, 'store']);

    //Profile
    Route::resource('profil', ProfileController::class);

    //Laporan
    Route::resource('laporan', LaporanController::class);
    Route::resource('user-perangkat', UserPerangkat::class);
    Route::resource('user-studio', UserStudio::class);


    //Cart
    Route::resource('cart', CartController::class);
    // Route::get('cart', [CartController::class, 'index']);
    // Route::post('cart/store', [CartController::class, 'store'] );
    // Route::put('update-cart', [CartController::class, 'update']);
    // Route::delete('remove-from-cart', [CartController::class, 'destroy']);

    //user-order
    Route::resource('user-transaksi-perangkat', UserOrderPerangkatController::class);
    Route::get('invoice-transaksi-perangkat/{id}', [UserOrderPerangkatController::class, 'invoice'])->name('invoice-transaksi-perangkat');
    Route::resource('user-transaksi-studio', UserOrderStudioController::class)->except('invoice');
    Route::get('invoice-transaksi-studio/{id}', [UserOrderStudioController::class, 'invoice'])->name('invoice-transaksi-studio');

    //user-denda
    Route::resource('user-denda', UserDenda::class);

});

//FrontEnd
Route::get('/', [BerandaController::class, 'index']);
Route::get('/guest-about', [BerandaController::class, 'about']);
Route::get('/guest-contact', [BerandaController::class, 'contact']);
Route::get('/guest-perangkat', [BerandaController::class, 'perangkat']);
Route::get('/guest-perangkat-detail/{id}', [BerandaController::class, 'detail_perangkat']);
Route::get('/guest-studio', [BerandaController::class, 'studio']);
Route::get('/guest-studio-detail/{id}', [BerandaController::class, 'detail_studio']);
Route::get('/guest-contact', [BerandaController::class, 'contact']);
Route::get('/guest-resepsionis', [BerandaController::class, 'resepsionis']);
Route::get('/guest-resepsionis-detail', [BerandaController::class, 'resepsionis_detail']);
Route::get('/guest-artikel', [BerandaController::class, 'artikel']);
Route::get('/guest-artikel-detail/{id}', [BerandaController::class, 'artikel_detail']);
Route::get('/guest-vr-room', [BerandaController::class, 'vr_room']);
Route::resource('guest-artikel', GuestArtikel::class);
Route::resource('guest-kontak', GuestKontak::class);
Route::resource('guest-perangkat', GuestPerangkat::class);
Route::resource('guest-resepsionis', GuestResepsionis::class);
Route::resource('guest-studio', GuestStudio::class);
Route::resource('guest-tentang', GuestTentang::class);
Route::get('/foo', function () {
    Artisan::call('storage:link');
    });

require __DIR__.'/auth.php';
