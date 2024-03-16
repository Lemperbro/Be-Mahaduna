<?php

use App\Http\Controllers\Api\Artikel\ArtikelApiController;
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
    Route::get('items/{playlistId}', [YoutubeApiController::class, 'showPlaylistItems'])->name('playlist.show.items');
});
Route::prefix('artikel')->group(function () {
    Route::get('all', [ArtikelApiController::class, 'all'])->name('artikel.all');
    Route::get('show/{id:slug}',[ArtikelApiController::class, 'show'])->name('artikel.show');
    Route::get('kategori/all', [ArtikelApiController::class, 'kategoriAll'])->name('artikel.kategori.all');
});


Route::post('/tagihan/callback/xendit', [TransaksiApiController::class, 'webhooksXendit'])->name('tagihan.xendit.webhooks');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tagihan/create-billing/{id}', [TransaksiApiController::class, 'createTransaksiByXendit'])->name('tagihan.xendit.create');
});
