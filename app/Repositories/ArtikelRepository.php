<?php
namespace App\Repositories;

use Exception;
use App\Models\Artikel;
use App\Models\ArtikelRelasi;
use App\Models\ArtikelKategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\SaveImageRepository;
use App\Repositories\ResponseErrorRepository;
use App\Http\Resources\Artikel\ArtikelResource;
use App\Http\Resources\Artikel\KategoriResource;
use App\Repositories\Interfaces\ArtikelInterface;
use Illuminate\Http\Exceptions\HttpResponseException;

class ArtikelRepository implements ArtikelInterface
{

    private $artikelModel, $kategoriModel, $artikelRelasi;
    private $handleResponseError;
    private $saveImageRepo;


    public function __construct()
    {
        $this->artikelModel = new Artikel;
        $this->kategoriModel = new ArtikelKategori;
        $this->artikelRelasi = new ArtikelRelasi;
        $this->handleResponseError = new ResponseErrorRepository;
        $this->saveImageRepo = new SaveImageRepository;
    }


    /**
     * Semua data artikel dan relasi kategori nya
     * @param int|null $paginate untuk mempaginate data 
     * @param $keyword untuk mencari data
     * @param bool $sortBest jika true maka akan mensortir data berdasarkan views terbanyak
     * @param bool $useForApi untuk switch , apakah di gunakan untuk api apa tidak , 
     * jika trua maka akan di gunakan untuk apa dan return response, jika false maka tidak digunakan untuk api 
     * 
     * @return [JsonResource]
     */
    public function getAllArtikel(int $paginate = null, $keyword = null, bool $sortBest = false, bool $useForApi = true)
    {

        $data = $this->artikelModel->with('artikel_relasi.artikel_kategori');
        if ($keyword !== null) {
            $data->where('judul', 'like', '%' . $keyword . '%');
        }

        if ($sortBest) {
            $data->orderBy('views', 'desc');
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

        $resource = ArtikelResource::collection($datas);
        if ($useForApi) {
            return ($resource)->response()->setStatusCode(200);
        } else {
            return $resource;
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
        if ($data->has('bannerImage')) {
            $image = $this->saveImageRepo->saveImageSingle($data->bannerImage, 'uploads/artikelImage');
        } else {
            $image = null;
        }

        try {
            $upArtikel = null;
            DB::beginTransaction();
            $upArtikel = $this->artikelModel->create([
                'bannerImage' => $image,
                'judul' => $data->judul,
                'isi' => $data->isi,
                'user_created' => auth()->user()->user_id
            ]);
            $cekKategori = $this->kategoriModel->whereIn('artikel_kategori_id', $data->kategori)->count();
            if ($cekKategori <= 0) {
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException('Kategori tidak ditemukan', 400);
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
                $data = $upArtikel !== null ? $upArtikel->load('artikel_relasi.artikel_kategori') : null;
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
        if ($data->has('bannerImage')) {
            $image = $this->saveImageRepo->updateImageSingle($data->bannerImage, 'uploads/artikelImage', $oldData->bannerImage);
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
                    return $this->handleResponseError->ResponseException('Kategori tidak ditemukan', 400);
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
                    'user_updated' => auth()->user()->user_id,
                    'updated_at' => now()
                ];
            }, $data->kategori);
            $this->artikelRelasi->where('artikel_id', $oldData->artikel_id)->forceDelete();
            $this->artikelRelasi->insert($kategori);
            DB::commit();
            if (request()->wantsJson()) {
                $data = $upArtikel !== null ? $upArtikel->load('artikel_relasi.artikel_kategori') : null;
                return $upArtikel !== null
                    ? (ArtikelResource::make($data))->response()->setStatusCode(201)
                    : $this->handleResponseError->ResponseException('Gagal memperbarui artikel', 400);
            } else {
                return true;
            }

        } catch (Exception $e) {
            // Log::error($e);
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
            $this->saveImageRepo->deleteImageSingle('uploads/artikelImage', $data->bannerImage);
            $data->update([
                'user_deleted' => auth()->user()->user_id,
                'deleted_at' => now(),
                'deleted' => true
            ]);
            $updateRelasi = $this->artikelRelasi->where('artikel_id', $data->artikel_id)->update([
                'user_deleted' => auth()->user()->user_id,
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
     * @param bool $useForApi untuk switch , apakah di gunakan untuk api apa tidak , 
     * jika trua maka akan di gunakan untuk apa dan return response, jika false maka tidak digunakan untuk api 
     * 
     * @return [JsonResponse]
     */

    public function getAllKategori(int $paginate = null, bool $useForApi = true)
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
        if ($useForApi) {
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
                'kategori' => $data->kategori
            ]);

            if (request()->wantsJson()) {
                return (KategoriResource::make($create))->response()->setStatusCode(201);
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
                return (KategoriResource::make($oldData))->response()->setStatusCode(200);
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
            $this->artikelRelasi->where('artikel_kategori_id', $data->artikel_kategori_id)->delete();
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