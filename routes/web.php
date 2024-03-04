<?php


use DateInterval;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FroalaController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Store\StoreController;
use App\Http\Controllers\FilePond\FilePondController;
use App\Http\Controllers\Admin\Jadwal\JadwalController;
use App\Http\Controllers\Admin\Artikel\ArtikelController;
use App\Http\Controllers\Admin\Majalah\MajalahController;
use App\Http\Controllers\Admin\Youtube\YoutubeController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     // Ambil data video dari API YouTube
//     $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
//         'part' => 'snippet',
//         'key' => 'AIzaSyCYZGwR37dmy1R0b-G8--cDyeMmNCTZ4ZM',
//         'channelId' => 'UC4ZuPUdoM7abr1THeLE-Lag',
//         'type' => 'video',
//         'videoDuration' => 'short',
//         'maxResults' => 50
//     ]);

//     function convertDurationToSeconds($duration)
//     {
//         $interval = new DateInterval($duration);
//         return $interval->s + ($interval->i * 60) + ($interval->h * 3600);
//     }
//     // Decode response JSON
//     $data = $response->json();
//     dd($data);

//     // Filter video yang durasinya kurang dari atau sama dengan 60 detik
//     $filteredVideos = collect($data['items'])->filter(function ($video) {
//         $duration = $video['contentDetails']['duration'];
//         return convertDurationToSeconds($duration) <= 60;
//     });

//     // Tampilkan hasil filter
//     dd($filteredVideos);

//     // Fungsi untuk mengonversi durasi format ISO8601 menjadi detik
// });




Route::get('/', function () {
    return redirect(route('dashboard'));
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'loginProses'])->name('auth.login.proses');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/froala-upload-image', [FroalaController::class, 'uploadImageFroala'])->name('froala.upload.image');
    Route::post('/froala-delete-image', [FroalaController::class, 'deleteImage'])->name('froala.delete.image');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // video kajian
    Route::get('/video-kajian', [YoutubeController::class, 'index'])->name('playlist.index');
    Route::get('/video-kajian/create', [YoutubeController::class, 'createPlaylist'])->name('playlist.create');
    Route::post('/video-kajian/create', [YoutubeController::class, 'create'])->name('playlist.create.post');
    Route::post('/video-kajian/delete/{id:playlistId}', [YoutubeController::class, 'delete'])->name('playlist.delete');

    // artikel
    Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('/artikel/create', [ArtikelController::class, 'artikelCreateIndex'])->name('artikel.create.index');
    Route::post('/artikel/create', [ArtikelController::class, 'artikelCreate'])->name('artikel.create');
    Route::get('/artikel/edit/{id:slug}', [ArtikelController::class, 'artikelEdit'])->name('artikel.edit');
    Route::post('/artikel/edit/{id:slug}', [ArtikelController::class, 'artikelUpdate'])->name('artikel.update');
    Route::post('/artikel/delete/{id:slug}', [ArtikelController::class, 'deleteArtikel'])->name('artikle.delete');
    Route::get('/kategori', [ArtikelController::class, 'kategoriIndex'])->name('artikel.kategori.index');
    Route::post('/kategori/add', [ArtikelController::class, 'kategoriCreate'])->name('artikel.kategori.create');
    Route::post('/kategori/edit/{id}', [ArtikelController::class, 'kategoriUpdate'])->name('artikel.kategori.update');
    Route::post('/kategori/delete/{id}', [ArtikelController::class, 'deleteKategori'])->name('artikel.kategori.delete');

    // majalah
    Route::get('/kelola-majalah', [MajalahController::class, 'index'])->name('majalah.index');
    Route::get('/kelola-majalah/create', [MajalahController::class, 'create'])->name('majalah.create');
    Route::post('/kelola-majalah/create', [MajalahController::class, 'store'])->name('majalah.store');
    Route::get('/kelola-majalah/edit/{id:slug}', [MajalahController::class, 'edit'])->name('majalah.edit');
    Route::post('/kelola-majalah/update/{id:slug}', [MajalahController::class, 'update'])->name('majalah.update');
    Route::post('/kelola-majalah/delete/{id:slug}', [MajalahController::class, 'delete'])->name('majalah.delete');

    //store
    Route::get('/store', [StoreController::class, 'index'])->name('store.index');
    Route::get('/store/create', [StoreController::class, 'create'])->name('store.create');
    Route::post('/store/create', [StoreController::class, 'store'])->name('store.create.store');
    Route::get('/store/edit/{id:slug}', [StoreController::class, 'edit'])->name('store.edit');
    Route::post('/store/edit/{id:slug}', [StoreController::class, 'update'])->name('store.update');
    Route::post('/store/delete/{id:slug}', [StoreController::class, 'delete'])->name('store.delete');
    Route::post('/store/image/delete/filepond/{folder}', [StoreController::class, 'filePondImageDelete'])->name('store.image.delete.filepond');

    //jadwal santri
    Route::get('/jadwal-santri', [JadwalController::class, 'index'])->name('jadwal.index');

    //filepond
    Route::post('/filePond/post/{folder}', [FilePondController::class, 'postImage'])->name('filePond.post');
    Route::post('/filePond/delete/{folder}', [FilePondController::class, 'deleteImage'])->name('filePond.delete');
});
