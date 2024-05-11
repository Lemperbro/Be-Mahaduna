<?php
namespace App\Repositories\Wali;

interface WaliInterface
{
    /**
     * untuk login wali santri
     * @param mixed $data
     * 
     * @return [type]
     */
    public function login($data);
    /**
     * untuk logout
     * @param mixed $user
     * 
     * @return [type]
     */
    public function logout($user);
    /**
     * untuk mengambil semua data wali
     * @param int|null $paginate
     * @param string|null $keyword
     * 
     * @return [type]
     */
    public function getAll(int $paginate = null, string $keyword = null);
    /**
     * untuk menampilkan santri dari wali
     * @param mixed $wali_id
     * 
     * @return [type]
     */
    public function showSantri($wali_id);
    /**
     * untuk menambah data wali
     * @param mixed $data
     * 
     * @return [type]
     */
    public function create($data);
    /**
     * untuk mengupdate data wali santri
     * @param mixed $data
     * @param mixed $oldData
     * 
     * @return [type]
     */
    public function update($data, $oldData);
    /**
     * untuk menghapus data wali , bisa multiple
     * @param array $wali_id
     * 
     * @return [type]
     */
    public function delete(array $wali_id);
    public function findWali();
}