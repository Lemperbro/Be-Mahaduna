<?php

namespace App\Http\Controllers\Api\Youtube;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function getAllPlaylist(GetAllPlaylistRequest $request)
    {
        // value part 'snippet,contentDetails,id,player,status,localizations'
        $part = $request->part ?? 'snippet'; //default 'snippet'
        $keyword = $request->keyword ?? null; //untuk mencari data, default null
        $paginate = $request->paginate ?? 10; //default 10
        $data = $this->YoutubeInterface->getAllDataPlaylist(part: $part, keyword: $keyword, paginate: $paginate);
        return $data;
    }
    public function showPlaylistItems(showAllPlaylistItemsRequest $request)
    {
        $playlistId = $request->playlistId;
        // value part 'snippet,contentDetails,id,status'
        $part = $request->part ?? 'snippet'; //default 'snippet'
        $paginate = $request->paginate ?? 10; //default 10
        $pageToken = $request->pageToken ?? null;
        $data = $this->YoutubeInterface->getPlaylistItems(part: $part, playlistId: $playlistId, paginate: $paginate, pageToken: $pageToken);
        return $data;
    }
    public function showAllVideo(ShowAllVideoRequest $request)
    {
        $evenType = $request->evenType ?? 'completed';
        $paginate = $request->paginate ?? 10;
        $pageToken = $request->pageToken ?? null;
        $data = $this->YoutubeInterface->getAllVideo(evenType: $evenType, paginate: $paginate, pageToken: $pageToken);
        return $data;
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
