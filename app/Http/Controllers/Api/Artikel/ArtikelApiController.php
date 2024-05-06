<?php

namespace App\Http\Controllers\Api\Artikel;

use App\Models\Artikel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Artikel\ArtikelInterface;
use App\Http\Requests\Api\Artikel\AllArtikelRequest;

class ArtikelApiController extends Controller
{
    private $ArtikelInterface;
    public function __construct(ArtikelInterface $ArtikelInterface)
    {
        $this->ArtikelInterface = $ArtikelInterface;
    }

    public function all(AllArtikelRequest $request)
    {
        $paginate = $request->paginate ?? 10;
        $keyword = $request->keyword ?? null;
        $sortBest = $request->sortBest ?? false;
        $kategori = $request->kategori_id ?? null;
        $data = $this->ArtikelInterface->getAllArtikel(paginate: $paginate, keyword: $keyword, sortBest: $sortBest, kategori: $kategori);
        return $data;
    }
    public function show(Request $request)
    {
        $data = $this->ArtikelInterface->showArtikel($request->artikelSlug);
        return $data;
    }
    public function kategoriAll()
    {
        $data = $this->ArtikelInterface->getAllKategori();
        return $data;
    }
    public function addViewer(Request $request)
    {
        $data = $this->ArtikelInterface->addViewer($request->slug);
        return $data;
    }
}
