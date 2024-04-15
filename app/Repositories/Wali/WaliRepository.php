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

class WaliRepository implements WaliInterface
{
    private $waliModel, $waliRelasi;
    private $defaultPassword = 'mahaduna12345';
    public function __construct()
    {
        $this->waliModel = new Wali;
        $this->waliRelasi = new WaliRelasi;
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
    public function logout($user){
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
    public function showSantri($wali_id)
    {
        $data = $this->waliModel->with('waliRelasi.santri.jenjang')->where('wali_id', $wali_id)->firstOrFail();
        if (request()->wantsJson()) {
            return (SantriOnWaliResource::make($data))->response()->setStatusCode(200);
        } else {
            return $data;
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
        $password = Hash::make($this->defaultPassword);
        $create = $this->waliModel->create([
            'email' => $data->email,
            'password' => $password,
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
