<?php

namespace App\Http\Controllers\Api\Majalah;

use App\Models\Majalah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\MajalahInterface;
use App\Http\Requests\Api\Majalah\MajalahAllRequest;

class MajalahApiController extends Controller
{
    private $MajalahInterface;
    public function __construct(MajalahInterface $MajalahInterface)
    {
        $this->MajalahInterface = $MajalahInterface;
    }

    public function all(MajalahAllRequest $request)
    {
        $paginate = $request->paginate ?? 10;
        $keyword = $request->keyword ?? null;
        $sortBest = $request->sortBest ?? false;
        $data = $this->MajalahInterface->getAll(paginate: $paginate, keyword: $keyword, sortBest: $sortBest);
        return $data;
    }
    public function show(Majalah $id){
        $data = $this->MajalahInterface->showMajalah($id);
        return $data;
    }
}
