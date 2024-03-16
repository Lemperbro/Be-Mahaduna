<?php

namespace App\Http\Controllers\Api\Artikel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Artikel\AllArtikelRequest;
use App\Models\Artikel;
use App\Repositories\Interfaces\ArtikelInterface;
use Illuminate\Http\Request;

class ArtikelApiController extends Controller
{
    private $ArtikelInterface;
    public function __construct(ArtikelInterface $ArtikelInterface)
    {
        $this->ArtikelInterface = $ArtikelInterface;
    }

    public function all(AllArtikelRequest $request)
    {
        $paginate = $request->paginate ?? 15;
        $keyword = $request->keyword ?? null;
        $sortBest = $request->sortBest ?? false;
        $kategori = $request->kategori_id ?? null;
        $data = $this->ArtikelInterface->getAllArtikel(paginate: $paginate, keyword: $keyword, sortBest: $sortBest, kategori: $kategori);
        return $data;
    }
    public function show(Artikel $id){
        $data = $this->ArtikelInterface->showArtikel($id);
        return $data;
    }
    public function kategoriAll(){
        $data = $this->ArtikelInterface->getAllKategori();
        return $data;
    }
}
