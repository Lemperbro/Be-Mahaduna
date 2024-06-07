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
use App\Repositories\HandleError\ResponseErrorRepository;

class YoutubeApiController extends Controller
{
    //

    private $YoutubeInterface, $handelError;

    public function __construct(YoutubeInterface $YoutubeInterface)
    {
        $this->YoutubeInterface = $YoutubeInterface;
        $this->handelError = new ResponseErrorRepository;
    }

    public function getAllPlaylist(GetAllPlaylistRequest $request)
    {
        // Value part 'snippet,contentDetails,id,player,status,localizations'
        $part = $request->part ?? 'snippet'; // Default 'snippet'
        $keyword = $request->keyword ?? null; // Untuk mencari data, default null
        $paginate = $request->paginate ?? 10; // Default 10
        $page = $request->page ?? 1;

        $data = $this->YoutubeInterface->getAllDataPlaylist(part: $part, keyword: $keyword, paginate: $paginate, page: $page);
        return $data;
    }


    public function showPlaylistItems(showAllPlaylistItemsRequest $request)
    {
        $playlistId = $request->playlistId;
        // Value part 'snippet,contentDetails,id,status'
        $part = $request->part ?? 'snippet'; // Default 'snippet'
        $paginate = $request->paginate ?? 10; // Default 10
        $pageToken = $request->pageToken ?? null;


        $data = $this->YoutubeInterface->getPlaylistItems(
            part: $part,
            playlistId: $playlistId,
            paginate: $paginate,
            pageToken: $pageToken
        );
        return $data;

    }

    public function showAllVideo(ShowAllVideoRequest $request)
    {
        $evenType = $request->evenType ?? 'completed';
        $paginate = $request->paginate ?? 10;
        $pageToken = $request->pageToken ?? null;
        $keyword = $request->keyword ?? null;

        $data = $this->YoutubeInterface->getAllVideo(
            evenType: $evenType,
            paginate: $paginate,
            pageToken: $pageToken,
            keyword: $keyword
        );

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
