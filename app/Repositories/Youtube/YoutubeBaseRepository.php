<?php
namespace App\Repositories\Youtube;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class YoutubeBaseRepository
{
    protected $apiKeyIndex = 0;

    protected $apiKeys = [

    ];
    public function responseSukses($data)
    {
        return response()->json($data);
    }
    public function cekStatusCodeApi($data)
    {
        return isset($data->json()['error']) && isset($data->json()['error']['code']) ? $data->json()['error']['code'] : 200;
    }
    /**
     * ini akan memfilter data playlist , yang akan muncul hanya data yang belum tersimpan di db
     * @param mixed $data data all playlist dari api youtube
     * @param mixed $playlistFromDb data playlist yang tersimpan di db
     * 
     * @return [type]
     */
    public function filterDataYangSudahAda($data, $playlistFromDb)
    {

        $response = $data;
        $playlistCollect = collect($response['items']);
        $filter = $playlistCollect->filter(function ($playlist) use ($playlistFromDb) {
            return !in_array($playlist['id'], $playlistFromDb->pluck('playlistId')->toArray());
        })->values()->all();
        $response['items'] = $filter;
        return $response;
    }

     /**
     * sorting vide terbaru
     * @param mixed $data
     * 
     * @return [type]
     */
    public function sortVideoLatest($data, $sortLokasi)
    {
        $response = json_decode(json_encode($data));
        $videoCollect = collect($response->items);
        $sortVideo = $videoCollect->sortByDesc($sortLokasi)->values()->all();
        $response->items = $sortVideo;
        return $response;
    }
    /**
     * untuk cek apakah ada limit, jika iyh maka akan me return true
     * @param mixed $response
     * 
     * @return [type]
     */
    public function isQuotaLimitError($response)
    {
        if ($response->status() == 403) {
            $error = $response->json();
            return isset($error['error']['errors'][0]['reason']) && $error['error']['errors'][0]['reason'] === 'quotaExceeded';
        }

        return false;
    }

    /**
     * untuk merubah api keys
     * @return [type]
     */
    protected function rotateApiKey()
    {
        $this->apiKeyIndex = ($this->apiKeyIndex + 1) % count($this->apiKeys);
        Log::info('API key rotated', ['apiKey' => $this->apiKeys[$this->apiKeyIndex]]);

        // Cek apakah sudah menggunakan semua API key
        if ($this->apiKeyIndex === 0) {
            Log::info('All API keys have been used, stopping the loop');
            return false; // Mengembalikan false untuk menghentikan loop
        }

        return true; // Mengembalikan true untuk melanjutkan loop
    }
    public function cariPlaylist($data, $keyword)
    {
        $response = json_decode(json_encode($data));
        $videoCollect = collect($response->items);
        $filter = $videoCollect->filter(function ($video) use ($keyword) {
            return stripos($video->snippet->title, $keyword) !== false;
        })->values()->all();
        $response->items = $filter;
        return $response;
    }

    public function getManualPagination($perPages, $data)
    {
        $data = json_decode(json_encode($data));
        $currentPage = 1;
        $items = $data->items;
        $perPage = $perPages; // Jumlah item per halaman
        $currentPage = request()->get('page', $currentPage); // Nomor halaman saat ini

        $slicedData = (new Collection($items))->forPage($currentPage, $perPage)->values();
        $total = count($items);

        $dataSemuafix = new LengthAwarePaginator(
            $slicedData,
            $total,
            $perPage,
            $currentPage,
            ['path' => url()->current(), 'query' => ['page' => $currentPage]]
        );

        return $dataSemuafix;
    }
}