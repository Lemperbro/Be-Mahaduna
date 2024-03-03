<?php

use Illuminate\Http\Request;
use App\Models\PlaylistVideo;
use Illuminate\Support\Facades\Route;
use App\Repositories\Interfaces\ArtikelInterface;
use App\Repositories\Interfaces\YoutubeInterface;
use App\Http\Requests\Youtube\UpdatePlaylistIdRequest;
use App\Http\Controllers\Api\Youtube\YoutubeController;
use App\Http\Controllers\Admin\Artikel\ArtikelController;
use App\Http\Controllers\Admin\Majalah\MajalahController;

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


Route::get('/coba', function(YoutubeInterface $YoutubeInterface){
    $data = $YoutubeInterface;
    return $data->getAllDataPlaylist();
});

// Route::post('/cok', function(Request $request){
//     return response()->json(request()->wantsJson());
// });




Route::get('/youtube/playlist/all', [YoutubeController::class, 'getAllPlaylist'])->name('youtube.playlist.getAll');
