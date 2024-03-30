<?php
namespace App\Repositories\Wali;

use App\Http\Resources\Wali\SantriOnWaliResource;
use Exception;
use App\Models\Wali;
use App\Models\WaliRelasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Wali\WaliInterface;

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
    public function emailAlreadyExists($email, $whereNot = false, $id = null)
    {
        $check = $this->waliModel->where('email', $email);
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
        $emailSudahAda = $this->emailAlreadyExists($data->email);
        if ($emailSudahAda) {
            return false;
        }
        $password = Hash::make($this->defaultPassword);
        $create = $this->waliModel->create([
            'email' => $data->email,
            'password' => $password,
            'nama' => $data->nama,
            'alamat' => $data->alamat,
            'telp' => $data->telp,
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
        $emailSudahAda = $this->emailAlreadyExists($data->email, true, $oldData->wali_id);
        if ($emailSudahAda) {
            return false;
        }
        $update = $oldData->update([
            'email' => $data->email,
            'nama' => $data->nama,
            'alamat' => $data->alamat,
            'telp' => $data->telp,
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
