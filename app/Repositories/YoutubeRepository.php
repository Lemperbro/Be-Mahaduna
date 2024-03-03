<?php
namespace App\Repositories;

use Exception;
use App\Models\PlaylistVideo;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\Youtube\VideoResource;
use App\Repositories\ResponseErrorRepository;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\Youtube\PlaylistResource;
use App\Repositories\Interfaces\YoutubeInterface;

class YoutubeRepository implements YoutubeInterface
{

    private $apiKey, $channelId, $model, $urlPlaylist, $playlistItems, $videoItem;
    private $responseError;

    public function __construct()
    {
        $this->apiKey = config('services.youtube.apiKey');
        $this->channelId = config('services.youtube.channelId');
        $this->urlPlaylist = config('services.youtube.urlPlaylist');
        $this->playlistItems = config('services.youtube.playlist_items');
        $this->videoItem = config('services.youtube.video_item');
        $this->responseError = new ResponseErrorRepository;
        $this->model = new PlaylistVideo;
    }

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
     * Ambil semua data playlist dari channel youtube
     * @param int $maxResults
     * @param bool $filter jika true maka hanya akan menampilkan playlist yang belum tersimpan di db
     * @param string $part ini bertipe string , contoh 'snippet,contentDetails,id,player,status,localizations'
     * 
     * @return [type]
     */
    public function getAllPlaylistFrYoutube($maxResults = 50, $filter = false, $part = 'snippet')
    {
        $get = Http::get($this->urlPlaylist, [
            'key' => $this->apiKey,
            'channelId' => $this->channelId,
            'type' => 'video',
            'part' => $part,
            'maxResults' => $maxResults,
            'pageToken' => request('ajaxPageToken') ?? null,
        ]);

        $statusCode = $this->cekStatusCodeApi($get);
        $responseData = $get->json();
        if ($filter === true) {
            $responseData = $this->filterDataYangSudahAda($get->json(), $this->getAllPlaylistId());
        }
        return (VideoResource::make($responseData))->response()->setStatusCode($statusCode);
    }

    /**
     * Simpan playlist id ke database
     * @param mixed $data
     * 
     * @return [type]
     */
    public function createPlaylistId($data)
    {

        $playlistData = array_map(function ($playlistId) {
            return [
                'playlistId' => $playlistId,
                'user_created' => auth()->user()->user_id,
                'created_at' => now()
            ];
        }, $data->playlistId);

        $create = $this->model->insert($playlistData);
        if ($create) {
            $createdPlaylists = $this->model->whereIn('playlistId', $data->playlistId)->get();
            if (request()->wantsJson()) {
                return (PlaylistResource::collection($createdPlaylists))->response()->setStatusCode(201);
            } else {
                return true;
            }
        } else {
            return false;
        }

    }

    /**
     * Update playlist id yang ada di dalam database
     * @param mixed $newData
     * @param mixed $oldData
     * 
     * @return [type]
     */
    public function updatePlaylist($newData, $oldData)
    {
        try {
            $cekUnique = $this->model->where('playlistId', $newData->playlistId)->whereNotIn('playlist_video_id', [$oldData->playlist_video_id])->count();
            if ($cekUnique > 0) {
                $message = 'Playlist Id sudah ada';
                $this->responseError->ResponseException($message, 400);
            }
            $oldData->update([
                'playlistId' => $newData->playlistId
            ]);
            return $this->responseSukses($oldData);
        } catch (Exception $e) {
            return $this->responseError->responseError($e);
        }
    }

    /**
     * Hapus PlaylistId yang tersimpan di database
     * @param mixed $data
     * 
     * @return [type]
     */
    public function deletePlaylist($data)
    {
        $delete = $data->update([
            'deleted' => true,
            'user_deleted' => auth()->user()->user_id,
            'deleted_at' => now()
        ]);
        $data->updated_at = null;
        $data->save();
        if (!$delete) {
            return false;
        }
        return $delete;

    }
    /**
     * Ambil semua data playlistId dari yang tersimpan di database
     * @return [type]
     */
    public function getAllPlaylistId($paginate = null)
    {
        $data = $this->model->get();
        $response = PlaylistResource::collection($data);
        if (request()->wantsJson()) {
            return ($response)->response()->setStatusCode(200);
        } else {
            return $response;
        }
    }


    /**
     * sorting vide terbaru
     * @param mixed $data
     * 
     * @return [type]
     */
    public function sortVideoLatest($data)
    {
        $response = $data;
        $videoCollect = collect($response['items']);
        $sortVideo = $videoCollect->sortByDesc('snippet.publishedAt')->values()->all();
        $response['items'] = $sortVideo;
        return $response;
    }

    public function cariPlaylist($data, $keyword)
    {
        $response = $data;
        $videoCollect = collect($response['items']);
        $filter = $videoCollect->filter(function ($video) use ($keyword) {
            return stripos($video['snippet']['title'], $keyword) !== false;
        })->values()->all();
        $response['items'] = $filter;
        return $response;
    }


    /**
     * ambil semua data playlist dari api youtube, berdasarkan playlistId yang di simpan di db
     * @param int $maxResults
     * @param string $part ini bertipe string , contoh 'snippet,contentDetails,id,player,status,localizations'
     * 
     * @return [type]
     */

    public function getAllDataPlaylist($part = 'snippet')
    {
        if (request()->wantsJson()) {
            $playlistIdData = $this->getAllPlaylistId()->getData()->data;
            $playlistId = collect($playlistIdData);
            $playlistImplode = implode(',', $playlistId->pluck('playlistId')->toArray());
        } else {
            $playlistId = $this->getAllPlaylistId();
            $playlistImplode = implode(',', $playlistId->pluck('playlistId')->toArray());
        }
        if (request()->wantsJson()) {
            if (count($playlistId) <= 0) {
                $message = 'playlist tidak tersedia';
                return $this->responseError->ResponseException($message, 404);
            }
        }
        $get = Http::get($this->urlPlaylist, [
            'key' => $this->apiKey,
            'id' => $playlistImplode,
            'type' => 'video',
            'part' => $part,
            'pageToken' => request('pageToken') ?? null
        ]);


        $statusCode = $this->cekStatusCodeApi($get);
        $responseData = $this->sortVideoLatest($get->json());
        if (request('search') !== null) {
            $responseData = $this->cariPlaylist($get->json(), request('search'));
        }
        return (VideoResource::make($responseData))->response()->setStatusCode($statusCode);
    }

    /**
     * Menampilkan isi playlist
     * @param mixed $playlistId id playlist yang akan di ambil
     * @param int $maxResults
     * 
     * @return mixed
     */
    public function getPlaylistItems($playlistId, $maxResults = 50)
    {
        $get = Http::get($this->playlistItems, [
            'key' => $this->apiKey,
            'playlistId' => $playlistId,
            'maxResults' => $maxResults,
            'type' => 'video',
            'part' => 'snippet',
        ]);

        $statusCode = $this->cekStatusCodeApi($get);
        return response()->json($get->json())->setStatusCode($statusCode);
    }

    /**
     * Ambil detail data video dari id video
     * @param mixed $videoId id video yang akan di ambil datanya
     * @param int $maxResults
     * 
     * @return mixed
     */
    public function getVideoItem($videoId, $maxResults = 50)
    {
        $get = Http::get($this->videoItem, [
            'key' => $this->apiKey,
            'id' => $videoId,
            'type' => 'video',
            'part' => 'player,snippet,contentDetails,statistics',
        ]);

        $statusCode = $this->cekStatusCodeApi($get);
        return response()->json($get->json())->setStatusCode($statusCode);
    }

}