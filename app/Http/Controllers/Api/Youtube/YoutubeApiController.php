<?php

namespace App\Http\Controllers\Api\Youtube;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Youtube\GetAllPlaylistRequest;
use App\Http\Requests\Api\Youtube\showAllPlaylistItemsRequest;
use App\Repositories\Interfaces\YoutubeInterface;

class YoutubeApiController extends Controller
{
    //

    private $YoutubeInterface;

    public function __construct(YoutubeInterface $YoutubeInterface)
    {
        $this->YoutubeInterface = $YoutubeInterface;
    }

    public function getAllPlaylist(GetAllPlaylistRequest $request)
    {
        // value part 'snippet,contentDetails,id,player,status,localizations'
        $part = $request->part ?? 'snippet'; //default 'snippet'
        $keyword = $request->keyword ?? null; //untuk mencari data, default null
        $paginate = $request->paginate ?? 10; //default 10
        $data = $this->YoutubeInterface->getAllDataPlaylist(part: $part, keyword: $keyword, paginate: $paginate);
        return $data;
    }
    public function showPlaylistItems(showAllPlaylistItemsRequest $request,$playlistId)
    {
        // value part 'snippet,contentDetails,id,status'
        $part = $request->part ?? 'snippet'; //default 'snippet'
        $paginate = $request->paginate ?? 50; //default 50
        $data = $this->YoutubeInterface->getPlaylistItems(part: $part, playlistId: $playlistId, paginate: $paginate);
        return $data;
    }
}
