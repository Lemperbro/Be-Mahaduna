<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Transaksi\TransaksiController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });







Route::post('/tagihan/callback/xendit', [TransaksiController::class, 'webhooksXendit']);
Route::post('/tagihan/create-billing/{id}', [TransaksiController::class, 'createTransaksiByXendit'])->name('tagihan.create.billing');
