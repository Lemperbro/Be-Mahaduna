<?php
namespace App\Repositories\Store;

use Exception;
use App\Models\Store;
use App\Models\StoreImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Repositories\Store\StoreInterface;
use App\Http\Resources\Store\StoreResource;
use App\Repositories\HandleError\ResponseErrorRepository;

class StoreRepository implements StoreInterface
{
    private $StoreModel, $StoreImageModel;
    private $handleResponseError;

    public function __construct()
    {
        $this->StoreModel = new Store;
        $this->StoreImageModel = new StoreImage;
        $this->handleResponseError = new ResponseErrorRepository;
    }


    /**
     * untuk mendapatkan semua data produk
     * @param int $paginate untuk mempaginate data , default 20
     * @param  $keyword untuk mencari data
     * @param string|null $stock untuk memfilter data, menampilkan stock terbanyak atau sedikit, nilai terbanyak atau sedikit
     * 
     * @return [type]
     */
    public function getAllProduk(int $paginate = 20, $keyword = null, string $stock = null)
    {
        try {

            $data = $this->StoreModel->with('store_image');
            if ($keyword !== null) {
                $data->where('label', 'like', '%' . $keyword . '%');
            }
            if ($stock !== null) {
                $stock = strtolower($stock);
                if ($stock !== 'terbanyak' && $stock !== 'sedikit') {
                    if (request()->wantsJson()) {
                        return $this->handleResponseError->ResponseException($stock . ' Tidak ditemukan, pilih Terbanyak Atau Sedikit', 404);
                    } else {
                        return [
                            'error' => true,
                            'message' => $stock . ' Tidak ditemukan, pilih Terbanyak Atau Sedikit'
                        ];
                    }
                }
                if ($stock === 'terbanyak') {
                    $response = $data->orderBy('stock', 'desc')->paginate($paginate);
                } else {
                    $response = $data->orderBy('stock', 'asc')->paginate($paginate);
                }
            } else {
                $response = $data->latest()->paginate($paginate);
            }

            if (request()->wantsJson()) {
                return(StoreResource::collection($response))->response()->setStatusCode(200);
            } else {
                return $response;
            }
        } catch (Exception $e) {
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {

            }
        }
    }
    /**
     * untuk menambah produk atau data ke db store
     * @param mixed $data data yang akan disimpan
     * 
     * @return [type]
     */
    public function create($data)
    {
        try {
            DB::beginTransaction();
            $create = $this->StoreModel->create([
                'label' => $data->label,
                'price' => $data->price,
                'stock' => $data->stock,
                'deskripsi' => $data->deskripsi,
                'user_created' => auth()->user()->user_id,
                'updated_at' => null
            ]);

            if ($data->image !== null) {
                $imageArray = explode(',', $data->image);
                if (count($imageArray) > 0) {
                    foreach ($imageArray as $imageItem) {
                        //validasi image ada ngak 
                        $storage = public_path('uploads/storeImage/' . basename($imageItem));
                        if (File::exists($storage)) {
                            $this->StoreImageModel->create([
                                'store_id' => $create->fresh()->store_id,
                                'image' => $imageItem,
                                'user_created' => auth()->user()->user_id,
                                'updated_at' => null
                            ]);
                        } else {
                            if (request()->wantsJson()) {
                                return $this->handleResponseError->ResponseException('Gambar tidak ditemukan', 404);
                            } else {
                                return [
                                    'error' => true,
                                    'message' => 'Gambar tidak berhasil tersimpan, mohon ulangi'
                                ];
                            }
                        }
                    }
                } else {
                    if (request()->wantsJson()) {
                        return $this->handleResponseError->ResponseException('Gambar tidak berhasil tersimpan', 400);
                    } else {
                        return [
                            'error' => true,
                            'message' => 'Gambar tidak berhasil tersimpan, mohon ulangi'
                        ];
                    }
                }
            } else {
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException('Gambar harus dimasukan', 400);
                } else {
                    return [
                        'error' => true,
                        'message' => 'Gambar harus dimasukan'
                    ];
                }
            }

            DB::commit();

            if (request()->wantsJson()) {
                return(StoreResource::make($create->fresh()))->response()->setStatusCode(201);
            } else {
                return true;
            }
        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }
    /**
     * untuk memperbarui data store
     * @param mixed $data data dari form yang akan disimpan ke db
     * @param mixed $oldData data dari db yang akan di perbarui
     * 
     * @return [type]
     */
    public function update($data, $oldData)
    {
        try {
            DB::beginTransaction();
            $update = $oldData->update([
                'label' => $data->label,
                'price' => $data->price,
                'stock' => $data->stock,
                'deskripsi' => $data->deskripsi,
                'user_updated' => auth()->user()->user_id,
            ]);
            if ($update) {
                $oldData->generateSlugOnUpdate();
                $oldData->save();
            }
            if ($data->image !== null) {
                $imageArray = explode(',', $data->image);
                if (count($imageArray) > 0) {
                    foreach ($imageArray as $imageItem) {
                        //validasi image ada ngak 
                        $storage = public_path('uploads/storeImage/' . basename($imageItem));
                        if (File::exists($storage)) {
                            $this->StoreImageModel->create([
                                'store_id' => $oldData->fresh()->store_id,
                                'image' => $imageItem,
                                'user_created' => auth()->user()->user_id,
                                'updated_at' => null
                            ]);
                        } else {
                            if (request()->wantsJson()) {
                                return $this->handleResponseError->ResponseException('Gambar tidak ditemukan', 404);
                            } else {
                                return [
                                    'error' => true,
                                    'message' => 'Gambar tidak berhasil tersimpan, mohon ulangi'
                                ];
                            }
                        }
                    }
                } else {
                    if (request()->wantsJson()) {
                        return $this->handleResponseError->ResponseException('Gambar tidak berhasil tersimpan', 400);
                    } else {
                        return [
                            'error' => true,
                            'message' => 'Gambar tidak berhasil tersimpan, mohon ulangi'
                        ];
                    }
                }
            }
            DB::commit();
            if (request()->wantsJson()) {
                return(StoreResource::make($oldData->fresh()))->response()->setStatusCode(201);
            } else {
                return true;
            }
        } catch (Exception $e) {
            DB::rollback();
            // Log::error($e);
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }

    /**
     * untuk menghapus produk
     * @param mixed $data data yang akan di hapus
     * 
     * @return [type]
     */
    public function delete($data)
    {
        try {
            DB::beginTransaction();
            $deleteProduk = $data->update([
                'deleted_at' => now(),
                'user_deleted' => auth()->user()->user_id,
                'deleted' => true
            ]);
            if ($deleteProduk) {
                $data->updated_at = null;
                $data->save();
            }

            $this->StoreImageModel->where('store_id', $data->store_id)->update([
                'deleted_at' => now(),
                'user_deleted' => auth()->user()->user_id,
                'deleted' => true,
                'updated_at' => null
            ]);

            DB::commit();
            if (request()->wantsJson()) {
                response()->json([
                    'success' => true,
                    'code' => 204,
                    'message' => 'Berhasil menghapus produk'
                ]);
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