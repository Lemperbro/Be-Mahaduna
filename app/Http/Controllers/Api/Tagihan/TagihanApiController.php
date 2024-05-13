<?php

namespace App\Http\Controllers\Api\Tagihan;

use App\Http\Controllers\Controller;
use App\Repositories\Tagihan\TagihanInterface;
use Illuminate\Http\Request;

class TagihanApiController extends Controller
{
    private $tagihanInterface;
    public function __construct(TagihanInterface $tagihanInterface){
        $this->tagihanInterface = $tagihanInterface;
    }

    public function getTagihanFromSantri(Request $request){
        $santri_id = $request->santri_id ?? null;
        $data = $this->tagihanInterface->getTagihanFromSantri($santri_id);
        return $data;
    }
}
