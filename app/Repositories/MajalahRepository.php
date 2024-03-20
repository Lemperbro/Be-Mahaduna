<?php
namespace App\Repositories;

use Exception;
use App\Models\Majalah;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Repositories\SaveFileRepository;
use App\Repositories\ResponseErrorRepository;
use App\Http\Resources\Majalah\MajalahResource;
use App\Repositories\Interfaces\MajalahInterface;

class MajalahRepository implements MajalahInterface
{
    private $majalahModel, $handleResponseError, $saveFile;
    private $folderMajalah, $folderBannerImage;

    public function __construct()
    {
        $this->majalahModel = new Majalah;
        $this->handleResponseError = new ResponseErrorRepository;
        $this->saveFile = new SaveFileRepository;
        $this->folderMajalah = 'uploads/majalahFile';
        $this->folderBannerImage = 'uploads/majalahImage';
    }
    /**
     * untuk mengambil semua data majalah
     * @param int $paginate untuk mempaginate data 
     * @param $keyword untuk mencari data
     * @param bool $sortBest untuk mensortir data berdasarkan yang banyak di lihat 
     * 
     * @return [mixed]
     */
    public function getAll(int $paginate = 20, $keyword = null, bool $sortBest = false)
    {
        try {
            $data = $this->majalahModel;
            if ($keyword !== null) {
                $data = $data->where('judul', 'like', '%' . $keyword . '%');
            }
            if ($sortBest) {
                $response = $data->orderBy('views', 'desc')->paginate($paginate);
            } else {
                $response = $data->latest()->paginate($paginate);
            }
            if (request()->wantsJson()) {
                return (MajalahResource::collection($response))->response()->setStatusCode(200);
            } else {
                return $response;
            }
        } catch (Exception $e) {
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            }
        }
    }
    /**
     * untuk menapilkan detail majalah
     * @param mixed $data data majalah dari db
     * 
     * @return [type]
     */
    public function showMajalah($data): mixed
    {
        if ($data !== null) {
            $user_updated = $data->user_updated ?? null;
            $updated_at = $data->updated_at ?? null;
            $this->majalahModel->where('majalah_id', $data->majalah_id)->update([
                'views' => $data->views + 1,
                'user_updated' => $user_updated,
                'updated_at' => $updated_at
            ]);
        }
        if (request()->wantsJson()) {
            return (MajalahResource::make($data))->response()->setStatusCode(200);
        } else {
            return $data;
        }
    }

    /**
     * untuk menambah majalah
     * @param mixed $data data majalah yang akan di simpan di dalam database
     * 
     * @return mixed
     */
    public function createMajalah($data)
    {
        try {
            if ($data->bannerImage !== null) {
                //validasi image ada ngak 
                $storage = public_path('uploads/majalahImage/' . basename($data->bannerImage));
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

            if ($data->has('majalahFile')) {
                $majalahFile = $this->saveFile->saveFileSingle($data->majalahFile, $this->folderMajalah);
            } else {
                $majalahFile = null;
            }

            $create = $this->majalahModel->create([
                'judul' => $data->judul,
                'bannerImage' => $image,
                'source' => $majalahFile,
                'user_created' => auth()->user()->user_id,
                'updated_at' => null
            ]);

            if ($create) {
                if (request()->wantsJson()) {
                    return (MajalahResource::make($create->fresh()))->response()->setStatusCode(201);
                } else {
                    return true;
                }
            } else {
                return $this->handleResponseError->ResponseException('Tidak berhasil menambah majalah', 400);
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
     * untuk mengubah majalah 
     * @param mixed $data data terbaru dari form 
     * @param mixed $oldData data yang akan di update
     * 
     * @return [type]
     */
    public function updateMajalah($data, $oldData)
    {
        try {
            if ($data->bannerImage !== null && basename($data->bannerImage) !== basename($oldData->bannerImage)) {
                $storage = public_path('uploads/majalahImage/' . basename($data->bannerImage));
                $oldImageStorage = public_path('uploads/majalahImage/' . basename($oldData->bannerImage));
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

            if ($data->has('majalahFile')) {
                $majalahFile = $this->saveFile->updateFileSingle($data->majalahFile, $this->folderMajalah, $oldData->source);
            } else {
                $majalahFile = $oldData->source;
            }

            $update = $oldData->update([
                'judul' => $data->judul,
                'bannerImage' => $image,
                'source' => $majalahFile,
                'user_updated' => auth()->user()->user_id,
                'updated_at' => now()
            ]);
            if ($update) {
                $oldData->generateSlugOnUpdate();
                $oldData->save();
                if (request()->wantsJson()) {
                    return (MajalahResource::make($oldData->fresh()))->response()->setStatusCode(201);
                } else {
                    return true;
                }
            } else {
                return $this->handleResponseError->ResponseException('Tidak berhasil memperbarui majalah', 400);
            }
        } catch (Exception $e) {
            Log::error($e);

            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }

    }
    /**
     * untuk mendelete majalah
     * @param mixed $data data yang akan dihapus
     * 
     * @return [type]
     */
    public function deleteMajalah($data)
    {
        try {
            // $this->saveFile->deleteImageSingle('uploads/majalahImage', $data->bannerImage);
            // $this->saveFile->deleteImageSingle('uploads/majalahFile', $data->source);
            $delete = $data->update([
                'user_deleted' => auth()->user()->user_id,
                'deleted_at' => now(),
                'deleted' => true
            ]);
            $data->updated_at = null;
            $data->save();
            if ($delete) {
                if (request()->wantsJson()) {
                    return response()->json([
                        'success' => true,
                        'code' => 204,
                        'message' => 'Berhasil menghapus majalah'
                    ]);
                } else {
                    return true;
                }
            }
        } catch (Exception $e) {
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }

    }
}