<?php
namespace App\Repositories\Youtube\CacheService;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    public function getAllDataPlaylistIsReady($newPlaylistIdData, $page, $part, $keyword, $paginate): bool
    {
        // Buat key cache unik berdasarkan parameter yang diterima
        $cacheKey = "youtube_playlist_{$part}_{$keyword}_{$paginate}_{$page}";
        // Key untuk menyimpan playlistIdData di cache
        $playlistIdCacheKey = 'cached_playlist_ids';
        // Ambil playlistIdData yang sudah disimpan di cache
        $cachedPlaylistIdData = Cache::get($playlistIdCacheKey);

        if (json_encode($cachedPlaylistIdData) === json_encode($newPlaylistIdData)) {
            if (Cache::has($cacheKey)) {
                $cachedData = Cache::get($cacheKey);
                Log::info('Data dari cache', ['data' => $cachedData]);
                return true;
            }
        }
        return false;
    }

    public function getAllDataPlaylistNotReady($newPlaylistIdData, $page, $part, $keyword, $paginate, $data)
    {
        // Buat key cache unik berdasarkan parameter yang diterima
        $cacheKey = "youtube_playlist_{$part}_{$keyword}_{$paginate}_{$page}";
        // Key untuk menyimpan playlistIdData di cache
        $playlistIdCacheKey = 'cached_playlist_ids';

        if ($data->getStatusCode() !== 500) {
            $currentKey = "youtube_playlist_{$part}_{$keyword}_{$paginate}_1";

            if (Cache::has($currentKey)) {
                $oldData = Cache::get($currentKey);

                for ($i = 1; $i <= $oldData->getData()->last_page; $i++) {
                    $nextPageCacheKey = "youtube_playlist_{$part}_{$keyword}_{$paginate}_{$i}";
                    if (Cache::has($nextPageCacheKey)) {
                        Cache::forget($nextPageCacheKey);
                    }
                }
            }

            // Simpan hasil dalam cache selama 2 jam
            Cache::put($cacheKey, $data, now()->addHours(2));
            // Simpan playlistIdData yang baru ke dalam cache
            Cache::put($playlistIdCacheKey, $newPlaylistIdData, now()->addHours(2));
        } else {
            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }
        }
    }

    public function getPlaylistItemsIsReady($cacheKey): bool
    {
        if (Cache::has($cacheKey)) {
            return true;
        } else {
            return false;
        }
    }

    public function getPlaylistItemsNotReady($cacheKey, $data)
    {

        if ($data->getStatusCode() !== 500) {
            // Cache::flush();
            Cache::put($cacheKey, $data, now()->addHours(2));
        } else {
            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }
        }
    }


    public function getAllVideoIsReady($cacheKey): bool
    {
        if (Cache::has($cacheKey)) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllVideoNotReady($cacheKey, $data)
    {

        if ($data->getStatusCode() !== 500) {
            // Cache::flush();
            Cache::put($cacheKey, $data, now()->addHours(2));
        } else {
            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }
        }
    }


    public function getVideoItemIsReady($cacheKey): bool
    {
        if (Cache::has($cacheKey)) {
            return true;
        } else {
            return false;
        }
    }

    public function getVideoItemNotReady($cacheKey, $data)
    {

        if ($data->getStatusCode() !== 500) {
            // Cache::flush();
            Cache::put($cacheKey, $data, now()->addHours(2));
        } else {
            if (Cache::has($cacheKey)) {
                return Cache::get($cacheKey);
            }
        }
    }


}
