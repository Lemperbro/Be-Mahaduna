<?php
namespace App\Repositories;

use Exception;
use Carbon\Carbon;
use App\Models\Artikel;
use App\Models\ArtikelRelasi;
use App\Models\ArtikelKategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Repositories\SaveFileRepository;
use App\Repositories\ResponseErrorRepository;
use App\Http\Resources\Artikel\ArtikelResource;
use App\Http\Resources\Artikel\KategoriResource;
use App\Repositories\Interfaces\ArtikelInterface;

class ArtikelRepository implements ArtikelInterface
{

    private $artikelModel, $kategoriModel, $artikelRelasi;
    private $handleResponseError;
    private $saveFileRepo;


    public function __construct()
    {
        $this->artikelModel = new Artikel;
        $this->kategoriModel = new ArtikelKategori;
        $this->artikelRelasi = new ArtikelRelasi;
        $this->handleResponseError = new ResponseErrorRepository;
        $this->saveFileRepo = new SaveFileRepository;
    }


    /**
     * Semua data artikel dan relasi kategori nya
     * @param int|null $paginate untuk mempaginate data 
     * @param $keyword untuk mencari data
     * @param bool $sortBest jika true maka akan mensortir data berdasarkan views terbanyak
     * @param bool $useForApi untuk switch , apakah di gunakan untuk api apa tidak , 
     * jika trua maka akan di gunakan untuk apa dan return response, jika false maka tidak digunakan untuk api 
     * @param int|null $kategori untuk memfilter artikel berdasarkan kategori
     * 
     * @return [JsonResource]
     */

    public function getAllArtikel(int $paginate = null, $keyword = null, bool $sortBest = false, int $kategori = null)
    {
        $data = $this->artikelModel->with('artikel_relasi.artikel_kategori');
        if ($keyword !== null) {
            $data->where('judul', 'like', '%' . $keyword . '%');
        }

        if ($kategori !== null) {
            $data->whereHas('artikel_relasi', function ($item) use ($kategori) {
                $item->where('artikel_kategori_id', $kategori);
            });
        }
        if ($sortBest) {
            //date 1 minggu ke belakang dari sekarang
            $date1Minggu = Carbon::now()->subWeek()->format('Y-m-d');
            $data->where('created_at', '>=', $date1Minggu)->orderBy('views', 'desc');
        } else {
            $data->latest();
        }

        if ($paginate !== null) {
            if ($paginate <= 0) {
                $message = 'paginate minimal lebih dari 0';
                $this->handleResponseError->ResponseException($message, 400);
            }
            $datas = $data->paginate($paginate);
        } else {
            $datas = $data->get();
        }

        $resource = $datas;
        if (request()->wantsJson()) {
            return (ArtikelResource::collection($resource))->response()->setStatusCode(200);
        } else {
            return $resource;
        }
    }
    /**
     * untuk menapilkan detail artikel
     * @param mixed $artikelSlug slug artikel yang ingin ditampilkan
     * 
     * @return [type]
     */
    public function showArtikel($artikelSlug): mixed
    {
        $data = $this->artikelModel->where('slug', $artikelSlug)->firstOrFail();
        if($data !== null){
            $user_updated = $data->user_updated ?? null;
            $updated_at = $data->updated_at ?? null;
            $this->artikelModel->where('artikel_id', $data->artikel_id)->update([
                'views' => $data->views + 1,
                'user_updated' => $user_updated,
                'updated_at' => $updated_at
            ]);
        }
        if (request()->wantsJson()) {
            return (ArtikelResource::make($data))->response()->setStatusCode(200);
        } else {
            return $data;
        }
    }
    /**
     * Untuk menyimpan artikel ke dala database
     * @param mixed $data data request dari form
     * 
     * @return [type]
     */
    public function createArtikel($data)
    {

        try {
            if ($data->bannerImage !== null) {
                //validasi image ada ngak 
                $storage = public_path('uploads/artikelImage/' . basename($data->bannerImage));
                if (File::exists($storage)) {
                    $image = $data->bannerImage;
                } else {
                    if (request()->wantsJson()) {
                        return $this->handleResponseError->ResponseException('Gambar tidak ditemukan', 404);
                    } else {
                        return [
                            'error' => true,
                            'message' => 'Gambar tidak ditemukan'
                        ];
                    }
                }
            } else {
                $image = null;
            }
            $upArtikel = null;
            DB::beginTransaction();
            $upArtikel = $this->artikelModel->create([
                'bannerImage' => $image,
                'judul' => $data->judul,
                'isi' => $data->isi,
                'user_created' => auth()->user()->user_id,
                'updated_at' => null
            ]);
            $cekKategori = $this->kategoriModel->whereIn('artikel_kategori_id', $data->kategori)->count();
            if ($cekKategori <= 0) {
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException('Kategori tidak ditemukan', 404);
                } else {
                    return [
                        'error' => true,
                        'message' => 'Kategori tidak ditemukan'
                    ];
                }
            }
            $kategori = array_map(function ($kategoriId) use ($upArtikel) {
                return [
                    'artikel_id' => $upArtikel->artikel_id,
                    'artikel_kategori_id' => $kategoriId,
                    'user_created' => auth()->user()->user_id,
                    'created_at' => now()
                ];
            }, $data->kategori);
            $this->artikelRelasi->insert($kategori);
            DB::commit();


            if (request()->wantsJson()) {
                $data = $upArtikel !== null ? $upArtikel->fresh()->load('artikel_relasi.artikel_kategori') : null;
                return $upArtikel !== null
                    ? (ArtikelResource::make($data))->response()->setStatusCode(201)
                    : $this->handleResponseError->ResponseException('Gagal menyimpan artikel', 400);
            } else {
                return true;
            }

        } catch (Exception $e) {
            DB::rollBack();
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }

    /**
     * untuk update artikel
     * @param mixed $data data terbaru dari form
     * @param mixed $oldData data lama yang ada di database
     * 
     * @return [type]
     */
    public function updateArtikel($data, $oldData)
    {
        if ($data->bannerImage !== null && basename($data->bannerImage) !== basename($oldData->bannerImage)) {
            $storage = public_path('uploads/artikelImage/' . basename($data->bannerImage));
            $oldImageStorage = public_path('uploads/artikelImage/' . basename($oldData->bannerImage));
            if (File::exists($storage)) {
                if (File::exists($oldImageStorage)) {
                    File::delete($oldImageStorage);
                }
                $image = $data->bannerImage;
            } else {
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException('Gambar tidak ditemukan', 404);
                } else {
                    return [
                        'error' => true,
                        'message' => 'Gambar tidak ditemukan'
                    ];
                }
            }
        } else {
            $image = $oldData->bannerImage;
        }

        try {
            $upArtikel = null;
            DB::beginTransaction();
            $upArtikel = $oldData->update([
                'bannerImage' => $image,
                'judul' => $data->judul,
                'isi' => $data->isi,
                'user_updated' => auth()->user()->user_id
            ]);
            if ($upArtikel) {
                $oldData->generateSlugOnUpdate();
                $oldData->save();
            }
            $cekKategori = $this->kategoriModel->whereIn('artikel_kategori_id', $data->kategori)->count();
            if ($cekKategori <= 0) {
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException('Kategori tidak ditemukan', 404);
                } else {
                    return [
                        'error' => true,
                        'message' => 'Kategori tidak ditemukan'
                    ];
                }
            }
            $kategori = array_map(function ($kategoriId) use ($oldData) {
                return [
                    'artikel_id' => $oldData->artikel_id,
                    'artikel_kategori_id' => $kategoriId,
                    'user_created' => auth()->user()->user_id,
                    'created_at' => now()
                ];
            }, $data->kategori);
            $this->artikelRelasi->where('artikel_id', $oldData->artikel_id)->forceDelete();
            $this->artikelRelasi->insert($kategori);
            DB::commit();
            if (request()->wantsJson()) {
                $data = $upArtikel !== null ? $oldData->fresh()->load('artikel_relasi.artikel_kategori') : null;
                return $upArtikel !== null
                    ? (ArtikelResource::make($data))->response()->setStatusCode(201)
                    : $this->handleResponseError->ResponseException('Gagal memperbarui artikel', 400);
            } else {
                return true;
            }

        } catch (Exception $e) {
            DB::rollBack();
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }
    /**
     * untuk hapus artikel
     * @param mixed $data data artikel yang akan dihapus
     * 
     * @return [type]
     */
    public function deleteArtikel($data)
    {
        try {
            $delete = false;
            DB::beginTransaction();
            $delete = $data->update([
                'user_deleted' => auth()->user()->user_id,
                'deleted_at' => now(),
                'deleted' => true,
            ]);
            $data->updated_at = null;
            $data->save();

            $updateRelasi = $this->artikelRelasi->where('artikel_id', $data->artikel_id)->update([
                'user_deleted' => auth()->user()->user_id,
                'updated_at' => null,
                'deleted_at' => now(),
                'deleted' => true
            ]);
            if ($updateRelasi) {
                $delete = true;
            }
            DB::commit();

            if (request()->wantsJson()) {
                if ($delete) {
                    response()->json([
                        'success' => true,
                        'code' => 204,
                        'message' => 'Berhasil menghapus artikel'
                    ]);
                } else {
                    $this->handleResponseError->ResponseException('Gagal menghapus artikel', 400);
                }
            } else {
                return true;
            }
        } catch (Exception $e) {
            DB::rollBack();
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }

    /**
     * Ambil semua data kategori artikel 
     * @param int|null $paginate untuk mempaginate data 
     * 
     * @return [JsonResponse]
     */

    public function getAllKategori(int $paginate = null)
    {
        $data = $this->kategoriModel->latest();
        if ($paginate !== null) {
            if ($paginate <= 0) {
                if (request()->wantsJson()) {
                    $message = 'paginate minimal lebih dari 0';
                    $this->handleResponseError->ResponseException($message, 400);
                } else {
                    return [
                        'error' => true,
                        'message' => 'paginate minimal lebih dari 0'
                    ];
                }
            }
            $datas = $data->paginate($paginate);
        } else {
            $datas = $data->get();
        }

        $resource = KategoriResource::collection($datas);
        if (request()->wantsJson()) {
            return ($resource)->response()->setStatusCode(200);
        } else {
            return $resource;
        }
    }
    /**
     * untuk menambah kategori
     * @param mixed $data data inputan
     * 
     * @return [type]
     */
    public function createKategori($data)
    {
        try {
            $cekKategori = $this->kategoriModel->where('kategori', $data->kategori)->exists();
            if ($cekKategori) {
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException('Kategori sudah ada', 400);
                } else {
                    return [
                        'error' => true,
                        'message' => 'Kategori sudah ada'
                    ];
                }
            }
            $create = $this->kategoriModel->create([
                'kategori' => $data->kategori,
                'updated_at' => null,
                'user_created' => auth()->user()->user_id
            ]);

            if (request()->wantsJson()) {
                return (KategoriResource::make($create->fresh()))->response()->setStatusCode(201);
            } else {
                return true;
            }
        } catch (Exception $e) {
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }
    /**
     * update kategori
     * @param mixed $data data baru 
     * @param mixed $oldData data lama
     * 
     * @return [type]
     */
    public function updateKategori($data, $oldData)
    {
        try {
            $cekKategori = $this->kategoriModel->where('kategori', $data->kategori)->whereNotIn('artikel_kategori_id', [$oldData->artikel_kategori_id])->exists();
            if ($cekKategori) {
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException('Kategori sudah ada', 400);
                } else {
                    return [
                        'error' => true,
                        'message' => 'Kategori suda ada'
                    ];
                }
            }
            $oldData->update([
                'kategori' => $data->kategori,
                'user_updated' => auth()->user()->user_id
            ]);

            if (request()->wantsJson()) {
                return (KategoriResource::make($oldData->fresh()))->response()->setStatusCode(200);
            } else {
                return true;
            }
        } catch (Exception $e) {
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }

    }
    /**
     * untuk menghapus data kategori
     * @param mixed $data data kategori yang akan di hapus
     * 
     * @return [type]
     */
    public function deleteKategori($data)
    {
        try {
            $delete = null;
            DB::beginTransaction();
            $delete = $data->update([
                'deleted' => true,
                'deleted_at' => now(),
                'user_deleted' => auth()->user()->user_id
            ]);
            $data->updated_at = null;
            $data->save();
            $this->artikelRelasi->where('artikel_kategori_id', $data->artikel_kategori_id)->update([
                'user_deleted' => auth()->user()->user_id,
                'deleted_at' => now(),
                'updated_at' => null,
                'deleted' => true
            ]);
            DB::commit();
            if (request()->wantsJson()) {
                if ($delete) {
                    return response()->json([
                        'success' => true,
                        'code' => 204,
                        'message' => 'Berhasil menghapus kategori'
                    ]);
                } else {
                    return $this->handleResponseError->ResponseException('Gagal menghapus kategori', 400);
                }
            } else {
                return true;
            }
        } catch (Exception $e) {
            DB::rollback();
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }



}