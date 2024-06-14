<?php
namespace App\Repositories\Wali;

use Exception;
use App\Models\Wali;
use App\Models\WaliRelasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Wali\WaliInterface;
use App\Http\Resources\Wali\WaliLoginResource;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\Wali\SantriOnWaliResource;
use App\Http\Resources\Wali\WaliResource;
use App\Repositories\HandleError\ResponseErrorRepository;

class WaliRepository implements WaliInterface
{
    private $waliModel, $waliRelasi;
    private $handleResponseError;
    private $defaultPassword = 'mahaduna12345';
    public function __construct()
    {
        $this->waliModel = new Wali;
        $this->waliRelasi = new WaliRelasi;
        $this->handleResponseError = new ResponseErrorRepository;
    }
    /**
     * untuk login wali santri
     * @param mixed $data
     * 
     * @return [type]
     */
    public function login($data)
    {
        try {
            $user = $this->waliModel->where('email', $data->emailOrTelp)->orWhere('telp', $data->emailOrTelp)->first();
            if (!$user || !Hash::check($data->password, $user->password)) {
                throw ValidationException::withMessages([
                    'message' => 'Kombinasi kredensial yang diberikan tidak benar.',
                ]);
            }

            // Login berhasil, buat token dan kirim respons
            $token = $user->createToken('userLogin')->plainTextToken;
            return (WaliLoginResource::make($token))->response()->setStatusCode(200);
        } catch (ValidationException $e) {
            // Tangkap pengecualian validasi dan kirim pesan kesalahan
            return response()->json([
                'error' => [
                    'message' => $e->getMessage(),
                ],
            ], 422);
        } catch (Exception $e) {
            // Log::error($e->getMessage());
            // Tangkap pengecualian lainnya dan kirim pesan kesalahan umum
            return response()->json([
                'error' => [
                    'message' => 'Terjadi kesalahan saat memproses permintaan Anda.',
                ],
            ], 500);
        }
    }
    /**
     * untuk logout
     * @param mixed $user
     * 
     * @return [type]
     */
    public function logout($user)
    {
        try {
            $user->user()->currentAccessToken()->delete();
            return response()->json([
                'code' => 200,
                'status' => true,
                'message' => 'logout successful'
            ])->setStatusCode(200);
        } catch (Exception $e) {
            return response()->json([
                'code' => 400,
                'status' => false,
                'message' => 'logout error'
            ], 400);
        }
    }
    /**
     * 
     * @param bool $withSantri
     * 
     * @return [type]
     */
    public function findWali($withSantri = false)
    {
        try {
            $user_id = auth()->user()->wali_id;
            if ($withSantri) {
                return $this->showSantri(wali_id: $user_id);
            } else {
                $user = $this->waliModel->where('wali_id', $user_id)->first();
                return (WaliResource::make($user))->response()->setStatusCode(200);
            }
        } catch (Exception) {
            return response()->json([
                'code' => 500,
                'status' => false,
                'message' => 'error'
            ], 500);
        }
    }
    /**
     * untuk mengambil semua data wali
     * @param int|null $paginate
     * @param string|null $keyword
     * 
     * @return [type]
     */
    public function getAll(int $paginate = null, string $keyword = null)
    {
        $data = $this->waliModel->withCount('waliRelasi')->latest();
        if ($keyword !== null) {
            $data->whereAny(['nama', 'alamat', 'telp', 'email'], 'LIKE', "%$keyword%");
        }
        if ($paginate !== null) {
            $response = $data->paginate($paginate);
        } else {
            $response = $data->get();
        }
        return $response;
    }
    /**
     * untuk menampilkan santri dari wali
     * @param mixed $wali_id
     * 
     * @return [type]
     */
    public function showSantri($wali_id, $getId = false)
    {
        $data = $this->waliModel->with([
            'waliRelasi.santri.jenjang' => function ($query) {
                $query->withTrashed();
            }
        ])->where('wali_id', $wali_id)->firstOrFail();
        if ($getId) {
            $data = $data->waliRelasi;
            return $data->pluck('santri_id')->toArray();
        } else {
            if (request()->wantsJson()) {
                return (SantriOnWaliResource::make($data))->response()->setStatusCode(200);
            } else {
                return $data;
            }
        }
    }
    /**
     * untuk ubah password wali
     * @param mixed $wali_id
     * @param mixed $password
     * 
     * @return [type]
     */
    public function changePassword($wali_id, $password)
    {
        try {
            $findWali = $this->waliModel->where('wali_id', $wali_id)->first();
            if ($findWali == null) {
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException(message: 'Data tidak ditemukan', statusCode: 404);
                } else {
                    return [
                        'error' => true,
                        'message' => 'Data tidak ditemukan'
                    ];
                }
            }
            $update = $findWali->update([
                'password' => $password
            ]);
            if ($update) {
                if (request()->wantsJson()) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Password berhasil diubah'
                    ], 201);
                } else {
                    return true;
                }
            } else {
                return false;
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
     * cek email sudah terdaftar
     * @param mixed $email
     * 
     * @return [type]
     */
    public function emailAlreadyExists($data, $whereNot = false, $id = null, string $type = 'email')
    {
        if ($type == 'email') {
            $check = $this->waliModel->where('email', $data);
        } else {
            $check = $this->waliModel->where('telp', $data);
        }
        if ($whereNot === true && $id !== null) {
            $check->whereNotIn('wali_id', [$id]);
        }
        if ($check->count() > 0) {
            return true;
        }
        return false;
    }
    /**
     * untuk menambah data wali
     * @param mixed $data
     * 
     * @return [type]
     */
    public function create($data)
    {
        $emailSudahAda = $this->emailAlreadyExists(data: $data->email, type: 'email');
        $telpSudahAda = $this->emailAlreadyExists(data: $data->telp, type: 'telp');
        if ($emailSudahAda || $telpSudahAda) {
            return false;
        }
        $create = $this->waliModel->create([
            'email' => $data->email,
            'password' => $this->defaultPassword,
            'nama' => $data->nama,
            'alamat' => $data->alamat,
            'telp' => $data->telp,
            'desa' => $data->desa,
            'user_created' => auth()->user()->user_id,
            'updated_at' => null
        ]);
        if (!$create) {
            return false;
        }
        return true;
    }
    /**
     * untuk mengupdate data wali santri
     * @param mixed $data
     * @param mixed $oldData
     * 
     * @return [type]
     */
    public function update($data, $oldData)
    {
        $emailSudahAda = $this->emailAlreadyExists(data: $data->email, whereNot: true, id: $oldData->wali_id, type: 'email');
        $telpSudahAda = $this->emailAlreadyExists(data: $data->telp, whereNot: true, id: $oldData->wali_id, type: 'telp');
        if ($emailSudahAda || $telpSudahAda) {

            return false;
        }
        $update = $oldData->update([
            'email' => $data->email,
            'nama' => $data->nama,
            'alamat' => $data->alamat,
            'telp' => $data->telp,
            'desa' => $data->desa,
            'user_updated' => auth()->user()->user_id,
        ]);
        if (!$update) {
            return false;
        }
        return true;
    }


    /**
     * untuk menghapus data wali , bisa multiple
     * @param array $wali_id
     * 
     * @return [type]
     */
    public function delete(array $wali_id)
    {

        DB::beginTransaction();
        $delete = $this->waliModel->whereIn('wali_id', $wali_id)->update([
            'deleted_at' => now(),
            'user_deleted' => auth()->user()->user_id,
            'deleted' => true,
            'user_updated' => null,
            'updated_at' => null
        ]);
        $deleteRelasi = $this->waliRelasi->whereIn('wali_id', $wali_id)->update([
            'deleted_at' => now(),
            'user_deleted' => auth()->user()->user_id,
            'deleted' => true,
            'user_updated' => null,
            'updated_at' => null
        ]);
        DB::commit();
        if (!$delete || !$deleteRelasi) {
            DB::rollBack();
            return false;
        }
        return true;
    }
}
