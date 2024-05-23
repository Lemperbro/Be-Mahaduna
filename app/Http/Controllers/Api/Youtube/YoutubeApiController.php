<?php

namespace App\Http\Controllers\Api\Youtube;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Youtube\YoutubeInterface;
use App\Http\Requests\Api\Youtube\ShowVideoRequest;
use App\Http\Requests\Api\Youtube\ShowAllVideoRequest;
use App\Http\Requests\Api\Youtube\GetAllPlaylistRequest;
use App\Http\Requests\Api\Youtube\showAllPlaylistItemsRequest;

class YoutubeApiController extends Controller
{
    //

    private $YoutubeInterface;

    public function __construct(YoutubeInterface $YoutubeInterface)
    {
        $this->YoutubeInterface = $YoutubeInterface;
    }


    //caching satu jam
    public function getAllPlaylist(GetAllPlaylistRequest $request)
    {
        // Value part 'snippet,contentDetails,id,player,status,localizations'
        $part = $request->part ?? 'snippet'; // Default 'snippet'
        $keyword = $request->keyword ?? null; // Untuk mencari data, default null
        $paginate = $request->paginate ?? 10; // Default 10
        $page = $request->page ?? 1;

        // Buat key cache unik berdasarkan parameter yang diterima
        $cacheKey = "youtube_playlist_{$part}_{$keyword}_{$paginate}_{$page}";

        // Key untuk menyimpan playlistIdData di cache
        $playlistIdCacheKey = 'cached_playlist_ids';

        // Ambil playlistIdData yang sudah disimpan di cache
        $cachedPlaylistIdData = Cache::get($playlistIdCacheKey);
        $newPlaylistIdData = $this->YoutubeInterface->getAllPlaylistId()->getData()->data;

        // Logging untuk debug
        Log::info('playlistId cache', ['data' => $cachedPlaylistIdData]);
        Log::info('playlistId baru', ['data' => $newPlaylistIdData]);

        // Cek apakah playlistIdData di cache sama dengan data baru
        if (json_encode($cachedPlaylistIdData) === json_encode($newPlaylistIdData)) {
            Log::info('dari cache');
            // Jika playlistId sama, cek apakah data playlist ada di cache
            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }
        }

        // Jika playlistId tidak sama atau data playlist tidak ada di cache, ambil data baru dari API
        $data = $this->YoutubeInterface->getAllDataPlaylist(part: $part, keyword: $keyword, paginate: $paginate);

        // Simpan hasil dalam cache selama 1 jam
        Cache::put($cacheKey, $data, now()->addHour());
        // Simpan playlistIdData yang baru ke dalam cache
        Cache::put($playlistIdCacheKey, $newPlaylistIdData, now()->addHour());

        return $data;
    }




    public function showPlaylistItems(showAllPlaylistItemsRequest $request)
    {
        $playlistId = $request->playlistId;
        // Value part 'snippet,contentDetails,id,status'
        $part = $request->part ?? 'snippet'; // Default 'snippet'
        $paginate = $request->paginate ?? 10; // Default 10
        $pageToken = $request->pageToken ?? null;

        // Buat key cache unik berdasarkan parameter yang diterima
        $cacheKey = "youtube_playlist_items_{$playlistId}_{$part}_{$paginate}_{$pageToken}";

        // Cek apakah data sudah ada dalam cache
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        } else {
            // Ambil data dari YoutubeInterface jika data tidak ada dalam cache
            $data = $this->YoutubeInterface->getPlaylistItems(
                part: $part,
                playlistId: $playlistId,
                paginate: $paginate,
                pageToken: $pageToken
            );

            // Simpan hasil dalam cache selama 1 jam
            Cache::put($cacheKey, $data, now()->addHour());

            return $data;
        }
    }

    public function showAllVideo(ShowAllVideoRequest $request)
    {
        $evenType = $request->evenType ?? 'completed';
        $paginate = $request->paginate ?? 10;
        $pageToken = $request->pageToken ?? null;

        // Buat key cache unik berdasarkan parameter yang diterima
        $cacheKey = "youtube_all_videos_{$evenType}_{$paginate}_{$pageToken}";

        // Cek apakah data sudah ada dalam cache
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        } else {
            // Ambil data dari YoutubeInterface jika data tidak ada dalam cache
            $data = $this->YoutubeInterface->getAllVideo(
                evenType: $evenType,
                paginate: $paginate,
                pageToken: $pageToken
            );

            // Simpan hasil dalam cache selama 1 jam
            Cache::put($cacheKey, $data, now()->addHour());

            return $data;
        }
    }

    public function showVideo(ShowVideoRequest $request)
    {
        //default 'player' , nilai yang tersedia 'player,snippet,contentDetails,statistics',
        $part = $request->part ?? 'player,snippet';
        $videoId = $request->videoId;
        $data = $this->YoutubeInterface->getVideoItem(videoId: $videoId, part: $part);
        return $data;
    }
}
