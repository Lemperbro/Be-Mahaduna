<?php

// use DateInterval;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

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







Route::get('/Dashboard', [DashboardController::class, 'index'])->name('Dashboard');
