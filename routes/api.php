<?php

use App\Http\Controllers\Api\Artikel\ArtikelApiController;
use App\Http\Controllers\Api\Majalah\MajalahApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Transaksi\TransaksiApiController;
use App\Http\Controllers\Api\Youtube\YoutubeApiController;

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
    Route::get('show',[ArtikelApiController::class, 'show'])->name('artikel.show');
    Route::get('kategori/all', [ArtikelApiController::class, 'kategoriAll'])->name('artikel.kategori.all');
});

//majalah
Route::prefix('majalah')->group(function(){
    Route::get('all', [MajalahApiController::class, 'all'])->name('majalah.all');
    Route::get('show/{id}', [MajalahApiController::class, 'show'])->name('majalah.show');
});


Route::post('/tagihan/callback/xendit', [TransaksiApiController::class, 'webhooksXendit'])->name('tagihan.xendit.webhooks');
Route::post('/tagihan/create-billing/{id}', [TransaksiApiController::class, 'createTransaksiByXendit'])->name('tagihan.xendit.create');
Route::middleware('auth:sanctum')->group(function () {
});
