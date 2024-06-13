<?php

use App\Http\Controllers\Api\Admin\AdminApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Wali\WaliApiController;
use App\Http\Controllers\Api\Artikel\ArtikelApiController;
use App\Http\Controllers\Api\Fcm\FcmApiController;
use App\Http\Controllers\Api\Jadwal\JadwalApiController;
use App\Http\Controllers\Api\Majalah\MajalahApiController;
use App\Http\Controllers\Api\Monitoring\MonitoringApiController;
use App\Http\Controllers\Api\Notification\NotificationController;
use App\Http\Controllers\Api\Store\StoreApiController;
use App\Http\Controllers\Api\Tagihan\TagihanApiController;
use App\Http\Controllers\Api\Youtube\YoutubeApiController;
use App\Http\Controllers\Api\Transaksi\TransaksiApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//fcm token save
Route::post('/fcm/save', [FcmApiController::class, 'saveToken'])->name('fcm.save');

//playlist
Route::prefix('playlist')->group(function () {
    Route::get('all', [YoutubeApiController::class, 'getAllPlaylist'])->name('playlist.all');
    Route::get('items', [YoutubeApiController::class, 'showPlaylistItems'])->name('playlist.show.items');
    Route::get('videos/all', [YoutubeApiController::class, 'showAllVideo'])->name('playlist.video.all');
    Route::get('show/video', [YoutubeApiController::class, 'showVideo'])->name('playlist.show.video');
});

//artikel
Route::prefix('artikel')->group(function () {
    Route::get('all', [ArtikelApiController::class, 'all'])->name('artikel.all');
    Route::get('show', [ArtikelApiController::class, 'show'])->name('artikel.show');
    Route::get('kategori/all', [ArtikelApiController::class, 'kategoriAll'])->name('artikel.kategori.all');
    Route::get('addViewer', [ArtikelApiController::class, 'addViewer'])->name('artikel.addViewer');
});

//majalah
Route::prefix('majalah')->group(function () {
    Route::get('all', [MajalahApiController::class, 'all'])->name('majalah.all');
    Route::get('show/{id}', [MajalahApiController::class, 'show'])->name('majalah.show');
});

//find nomber admin
Route::get('admin/number', [AdminApiController::class, 'findNumber'])->name('admin.number');

//store
Route::prefix('store')->group(function () {
    Route::get('all', [StoreApiController::class, 'all'])->name('store.all');
    // Route::get('detail', [StoreApiController::class, 'all'])->name('store.detail');
});

//jadwal
Route::get('/jadwal/santri', [JadwalApiController::class, 'all'])->name('jadwal.all');

//wali
Route::post('/wali/login', [WaliApiController::class, 'login'])->name('wali.login');
Route::post('/tagihan/callback/xendit', [TransaksiApiController::class, 'webhooksXendit'])->name('tagihan.xendit.webhooks');


//notifikasi without auth login
Route::get('notifikasi/all', [NotificationController::class, 'allNotifikasi'])->name('notifikasi.all');
Route::middleware('auth:sanctum')->group(function () {

    //wali in auth
    Route::prefix('wali')->group(function () {
        Route::post('/logout', [WaliApiController::class, 'logout'])->name('wali.logout');
        Route::get('/findWali', [WaliApiController::class, 'findWali'])->name('wali.find');
    });

    //santri in auth
    // Route::prefix('santri')->group(function(){

    // });

    //monitoring
    Route::prefix('monitoring')->group(function () {
        Route::get('mingguan', [MonitoringApiController::class, 'monitoring'])->name('monitoring.mingguan');
        Route::get('hafalan', [MonitoringApiController::class, 'hafalan'])->name('monitoring.hafalan');
    });
    //tagihan
    Route::prefix('tagihan')->group(function () {
        Route::get('/fromSantri', [TagihanApiController::class, 'getTagihanFromSantri'])->name('tagihan.fromSantri');
        Route::post('/create-billing/{id}', [TransaksiApiController::class, 'createTransaksiByXendit'])->name('tagihan.xendit.create');
    });

    //notifikasi with auth login
    Route::get('notifikasi/wali', [NotificationController::class, 'allNotifikasiWali'])->name('notifikasi.wali');
});
