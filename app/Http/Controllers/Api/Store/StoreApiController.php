<?php

namespace App\Http\Controllers\Api\Store;

use App\Http\Controllers\Controller;
use App\Repositories\Store\StoreInterface;
use Illuminate\Http\Request;

class StoreApiController extends Controller
{
    private $StoreInterface;
    public function __construct(StoreInterface $storeInterface)
    {
        $this->StoreInterface = $storeInterface;
    }

    public function all(Request $request)
    {
        $paginate = $request->paginate ?? 20;
        $keyword = $request->keyword ?? null;
        $data = $this->StoreInterface->getAllProduk(paginate: $paginate, keyword: $keyword);
        return $data;
    }
    public function detail(Request $request)
    {
        $slug = $request->slug;
        $data = $this->StoreInterface->detail($slug);
        return $data;
    }
}
