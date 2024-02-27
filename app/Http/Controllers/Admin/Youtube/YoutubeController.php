<?php

namespace App\Http\Controllers\Admin\Youtube;

use Exception;
use Illuminate\Http\Request;
use App\Models\PlaylistVideo;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\YoutubeInterface;
use App\Http\Requests\Youtube\CreatePlaylistIdRequest;

class YoutubeController extends Controller
{
    private $YoutubeInterface;

    public function __construct(YoutubeInterface $YoutubeInterface)
    {
        $this->YoutubeInterface = $YoutubeInterface;
    }


    public function index()
    {
        $headerTitle = 'Video Kajian';
        $getPlaylist = $this->YoutubeInterface->getAllDataPlaylist('snippet,contentDetails')->getData();
        $playlist = $this->getManualPagination(8, $getPlaylist);
        
        if (request('ajaxPageToken')) {
            // remove cache di sini , agar data tidak dobel
            cache()->forget('allPlaylist');
        }
        $allPlaylist = cache()->remember('allPlaylist', now()->addHours(1), function () {
            // Jika tidak ada di cache, ambil data dari sumbernya (misal: YouTube API)
            return $this->YoutubeInterface->getAllPlaylistFrYoutube(20, true, 'snippet')->getData();
        });
        if (request('ajaxPageToken')) {
            cache()->forget('allPlaylist');
            return response()->json($allPlaylist);
        }

        return view('admin.video.index', compact('headerTitle', 'playlist', 'allPlaylist'));
    }

    public function getManualPagination($perPages, $data)
    {
        $currentPage = 1;
        $items = $data->data->items;
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

    public function createPlaylist()
    {
        $headerTitle = 'Tambah Playlist';
        $allPlaylist = $this->YoutubeInterface->getAllPlaylistFrYoutube(50)->getData();
        return view('admin.video.create.index', compact('headerTitle', 'allPlaylist'));
    }

    public function create(CreatePlaylistIdRequest $request)
    {
        $create = $this->YoutubeInterface->createPlaylistId($request);
        if ($create) {
            return redirect()->back()->with('toast_success', 'Berhasil menambah data playlist');
        }
        return redirect()->back()->with('toast_error', 'Tidak berhasil menambah data playlist');
    }

    public function delete(PlaylistVideo $id)
    {
        $delete = $this->YoutubeInterface->deletePlaylist($id);
        if ($delete) {
            return redirect()->back()->with('toast_success', 'Berhasil menghapus data playlist');
        }
        return redirect()->back()->with('toast_error', 'Tidak berhasil menghapus data playlist');

    }
}
