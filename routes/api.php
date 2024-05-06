<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Wali\WaliApiController;
use App\Http\Controllers\Api\Artikel\ArtikelApiController;
use App\Http\Controllers\Api\Majalah\MajalahApiController;
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

//wali
Route::post('/wali/login', [WaliApiController::class, 'login'])->name('wali.login');
Route::post('/tagihan/callback/xendit', [TransaksiApiController::class, 'webhooksXendit'])->name('tagihan.xendit.webhooks');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tagihan/create-billing/{id}', [TransaksiApiController::class, 'createTransaksiByXendit'])->name('tagihan.xendit.create');

    //wali in auth
    Route::post('/wali/logout', [WaliApiController::class, 'logout'])->name('wali.logout');
});
