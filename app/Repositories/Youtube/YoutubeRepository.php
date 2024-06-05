<?php
namespace App\Repositories\Youtube;

use Exception;
use Carbon\Carbon;
use App\Models\PlaylistVideo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\Youtube\VideoResource;
use App\Repositories\Youtube\YoutubeInterface;
use App\Http\Resources\Youtube\PlaylistResource;
use App\Repositories\Youtube\YoutubeBaseRepository;
use App\Repositories\Youtube\CacheService\CacheService;
use App\Repositories\HandleError\ResponseErrorRepository;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class YoutubeRepository extends YoutubeBaseRepository implements YoutubeInterface
{

    private $channelId, $model, $urlPlaylist, $playlistItems, $videoItem, $urlSearch;
    private $responseError;
    protected $cacheService;
    private $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->apiKeys = [
            config('services.youtube.apiKey1'),
            config('services.youtube.apiKey2'),
            config('services.youtube.apiKey3'),
            config('services.youtube.apiKey4')
        ];
        $this->channelId = config('services.youtube.channelId');
        $this->urlPlaylist = config('services.youtube.urlPlaylist');
        $this->playlistItems = config('services.youtube.playlist_items');
        $this->videoItem = config('services.youtube.video_item');
        $this->urlSearch = config('services.youtube.url_search');
        $this->responseError = new ResponseErrorRepository;
        $this->model = new PlaylistVideo;
        $this->cacheService = new CacheService;
        $this->messaging = $messaging;
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
        do {
            $get = Http::get($this->urlPlaylist, [
                'key' => $this->apiKeys[$this->apiKeyIndex],
                'channelId' => $this->channelId,
                'type' => 'video',
                'part' => $part,
                'maxResults' => $maxResults,
                'pageToken' => request('ajaxPageToken') ?? null,
            ]);
            // Cek apakah terjadi quota limit
            if ($this->isQuotaLimitError($get)) {
                if ($this->rotateApiKey()) {
                    continue; // Melanjutkan loop jika rotasi gagal
                }
            }
            $statusCode = $this->cekStatusCodeApi($get);
            $responseData = $get->json();
            if ($filter === true) {
                $responseData = $this->filterDataYangSudahAda($get->json(), $this->getAllPlaylistId());
            }
            return (VideoResource::make($responseData))->response()->setStatusCode($statusCode);
        } while (true);
    }

    public function sendNotification($topic, $title, $body)
    {
        $firebase = $this->messaging;
        $message = CloudMessage::withTarget('topic', $topic)
            ->withNotification(Notification::create($title, $body));

        $firebase->send($message);
    }
    /**
     * Simpan playlist id ke database
     * @param mixed $data
     * 
     * @return [type]
     */
    public function createPlaylistId($data)
    {
        DB::beginTransaction();
        try {
            foreach ($data->playlistId as $playlistId) {
                $playlistData = [
                    'playlistId' => $playlistId,
                    'user_created' => auth()->user()->user_id,
                    'created_at' => now()
                ];
                PlaylistVideo::create($playlistData);
            }

            DB::commit();

            $createdPlaylists = PlaylistVideo::whereIn('playlistId', $data->playlistId)->get();
            $this->sendNotification('youtube', 'coba', 'halo semua');

            if (request()->wantsJson()) {
                return (PlaylistResource::collection($createdPlaylists))->response()->setStatusCode(201);
            } else {
                return true;
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::info('error', ['error' => $e->getMessage()]);
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
     * ambil semua data playlist dari api youtube, berdasarkan playlistId yang di simpan di db
     * @param int $maxResults
     * @param string $part ini bertipe string , contoh 'snippet,contentDetails,id,player,status,localizations'
     * @param mixed $keyword untuk mencari data
     * @param int $paginate untuk mempaginate data
     * 
     * @return [type]
     */

    public function getAllDataPlaylist($part = 'snippet', $keyword = null, $paginate = 10, $page = 1)
    {
        $statusCode = 200;
        try {
            $playlistIdData = request()->wantsJson() ? collect($this->getAllPlaylistId()->getData()->data) : $this->getAllPlaylistId();
            $cacheIsReady = $this->cacheService->getAllDataPlaylistIsReady($playlistIdData, $page, $part, $keyword, $paginate);

            if ($cacheIsReady) {
                return Cache::get("youtube_playlist_{$part}_{$keyword}_{$paginate}_{$page}");
            }

            do {
                $playlistImplode = implode(',', $playlistIdData->pluck('playlistId')->toArray());

                $get = Http::get($this->urlPlaylist, [
                    'key' => $this->apiKeys[$this->apiKeyIndex],
                    'id' => $playlistImplode,
                    'type' => 'video',
                    'part' => $part,
                ]);
                $statusCode = 500;

                if ($this->isQuotaLimitError($get)) {
                    if ($this->rotateApiKey()) {
                        continue;
                    }
                }
                $statusCode = $this->cekStatusCodeApi($get);
                $responseData = $this->sortVideoLatest($get->json(), 'snippet.publishedAt');
                if ($keyword !== null) {
                    $responseData = $this->cariPlaylist($get->json(), $keyword);
                }
                $responseWithPaginate = $this->getManualPagination($paginate, $responseData);

                if (request()->wantsJson()) {
                    $data = (VideoResource::make($responseWithPaginate))->response()->setStatusCode($statusCode);
                } else {
                    $data = $responseWithPaginate;
                }
                return $data;
            } while (true);

        } catch (Exception $e) {
            return $this->responseError->responseError($e);
        } finally {
            if (!$cacheIsReady) {
                $this->cacheService->getAllDataPlaylistNotReady($playlistIdData, $page, $part, $keyword, $paginate, $data, $statusCode);
            }
        }
    }

    /**
     * Menampilkan isi playlist
     * @param mixed $playlistId id playlist yang akan di ambil
     * @param int $paginate untuk mempaginate data
     * @param string $part ini bertipe string , contoh 'snippet,contentDetails,id,status'
     * @param mixed $pageToken ini untuk ketika ada nextPageToken atau paginate di api youtube
     * 
     * @return mixed
     */
    public function getPlaylistItems($part = 'snippet', $playlistId, $paginate = 10, $pageToken = null)
    {
        try {
            $cacheKey = "youtube_playlist_items_{$playlistId}_{$part}_{$paginate}_{$pageToken}";
            $cacheIsReady = $this->cacheService->getPlaylistItemsIsReady($cacheKey);
            if ($cacheIsReady) {
                return Cache::get($cacheKey);
            }
            do {
                $get = Http::get($this->playlistItems, [
                    'key' => $this->apiKeys[$this->apiKeyIndex],
                    'playlistId' => $playlistId,
                    'maxResults' => $paginate,
                    'type' => 'video',
                    'part' => $part,
                    'pageToken' => $pageToken
                ]);
                // Cek apakah terjadi quota limit
                if ($this->isQuotaLimitError($get)) {
                    if ($this->rotateApiKey()) {
                        continue;
                    }
                }

                $statusCode = $this->cekStatusCodeApi($get);
                $data = response()->json($get->json())->setStatusCode($statusCode);
                return $data;
            } while (true);
        } catch (Exception $e) {
            return $this->responseError->responseError($e);
        } finally {
            if (!$cacheIsReady && isset($data)) {
                $this->cacheService->getPlaylistItemsNotReady($cacheKey, $data);
            }
        }
    }
    /**
     * untuk menampilkan video dari semua playlist
     * @param string $evenType default 'completed', nilai yang tersedia 'completed', 'live'
     * @param int $paginate
     * 
     * @return [type]
     */
    public function getAllVideo($evenType = 'completed', $paginate = 10, $pageToken = null)
    {
        try {
            $cacheKey = "youtube_all_videos_{$evenType}_{$paginate}_{$pageToken}";
            $cacheIsReady = $this->cacheService->getAllVideoIsReady($cacheKey);
            if ($cacheIsReady) {
                return Cache::get($cacheKey);
            }
            do {
                $getData = Http::get($this->urlSearch, [
                    'key' => $this->apiKeys[$this->apiKeyIndex],
                    'part' => 'snippet',
                    'type' => 'video',
                    'channelId' => $this->channelId,
                    'order' => 'date',
                    'eventType' => $evenType,
                    'maxResults' => $paginate,
                    'pageToken' => $pageToken,
                    'publishedBefore' => Carbon::now()->toRfc3339String(),
                    'publishedAfter' => Carbon::now()->subYears(2)->toRfc3339String()
                ]);
                // Cek apakah terjadi quota limit
                if ($this->isQuotaLimitError($getData)) {
                    if ($this->rotateApiKey()) {
                        continue; // Melanjutkan loop jika rotasi gagal
                    }
                }
                $statusCode = $this->cekStatusCodeApi($getData);
                $data = response()->json($getData->json())->setStatusCode($statusCode);
                return $data;
            } while (true);
        } catch (Exception $e) {
            return $this->responseError->responseError($e);
        } finally {
            if (!$cacheIsReady) {
                $this->cacheService->getAllVideoNotReady($cacheKey, $data);
            }
        }
    }
    /**
     * Ambil detail data video dari id video
     * @param mixed $videoId id video yang akan di ambil datanya
     * @param string $part default 'player' , nilai yang tersedia 'player,snippet,contentDetails,statistics',
     * 
     * @return mixed
     */
    public function getVideoItem(string $videoId, string $part = 'player,snippet')
    {
        try {
            $cacheKey = "youtube_all_videos_{$part}_{$videoId}";
            $cacheIsReady = $this->cacheService->getVideoItemIsReady($cacheKey);
            if ($cacheIsReady) {
                return Cache::get($cacheKey);
            }
            do {
                $get = Http::get($this->videoItem, [
                    'key' => $this->apiKeys[$this->apiKeyIndex],
                    'id' => $videoId,
                    'type' => 'video',
                    'part' => $part
                ]);
                // Cek apakah terjadi quota limit
                if ($this->isQuotaLimitError($get)) {
                    if ($this->rotateApiKey()) {
                        continue; // Melanjutkan loop jika rotasi gagal
                    }
                }

                $statusCode = $this->cekStatusCodeApi($get);
                $data = response()->json($get->json())->setStatusCode($statusCode);
                return $data;
            } while (true);
        } catch (Exception $e) {
            return $this->responseError->responseError($e);

        } finally {
            if (!$cacheIsReady) {
                $this->cacheService->getVideoItemNotReady($cacheKey, $data);
            }
        }
    }


}