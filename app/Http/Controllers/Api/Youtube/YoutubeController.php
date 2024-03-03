<?php

namespace App\Http\Controllers\Api\Youtube;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\YoutubeInterface;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    //

    private $YoutubeInterface;

    public function __construct(YoutubeInterface $YoutubeInterface){
        $this->YoutubeInterface = $YoutubeInterface;
    }

    public function getAllPlaylist(){
        $data = $this->YoutubeInterface->getAllDataPlaylist();
        return $data;
    }
}
