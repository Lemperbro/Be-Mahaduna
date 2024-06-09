<?php
namespace App\Repositories\Youtube\CacheService;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    public function getAllDataPlaylistIsReady($newPlaylistIdData, $page, $part, $keyword, $paginate, $jsonYes): bool
    {
        // Buat key cache unik berdasarkan parameter yang diterima
        $cacheKey = "youtube_playlist_{$part}_{$keyword}_{$paginate}_{$page}_{$jsonYes}";
        // Key untuk menyimpan playlistIdData di cache
        $playlistIdCacheKey = "cached_playlist_ids";
        // Ambil playlistIdData yang sudah disimpan di cache
        $cachedPlaylistIdData = Cache::get($playlistIdCacheKey);

        if (json_encode($cachedPlaylistIdData) === json_encode($newPlaylistIdData)) {
            if (Cache::has($cacheKey)) {
                return true;
            }
        }
        return false;
    }

    public function getAllDataPlaylistNotReady($newPlaylistIdData, $page, $part, $keyword, $paginate, $data, $statusCode, $jsonYes)
    {
        // Buat key cache unik berdasarkan parameter yang diterima
        $cacheKey = "youtube_playlist_{$part}_{$keyword}_{$paginate}_{$page}_{$jsonYes}";
        // Key untuk menyimpan playlistIdData di cache
        $playlistIdCacheKey = "cached_playlist_ids";


        if ($statusCode === 200) {
            $currentKey = "youtube_playlist_{$part}_{$keyword}_{$paginate}_{$page}_{$jsonYes}";
            if (Cache::has($currentKey)) {
                $oldData = Cache::get($currentKey);
                $last_page = request()->wantsJson() ? $oldData->getData()->last_page : $oldData->lastPage();
                for ($i = 1; $i <= $last_page; $i++) {
                    $nextPageCacheKeyTrue = "youtube_playlist_{$part}_{$keyword}_{$paginate}_{$i}_1";
                    $nextPageCacheKeyFalse = "youtube_playlist_{$part}_{$keyword}_{$paginate}_{$i}_";
                    if (Cache::has($nextPageCacheKeyTrue)) {
                        Cache::forget($nextPageCacheKeyTrue);
                    }
                    if (Cache::has($nextPageCacheKeyFalse)) {
                        Cache::forget($nextPageCacheKeyFalse);
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
