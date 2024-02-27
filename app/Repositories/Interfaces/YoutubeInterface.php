<?php
namespace App\Repositories\Interfaces;


interface YoutubeInterface
{

    /**
     * Mendapatkan semua daftar playlist dari channel yang di dapatkan dari api YouTube.
     * @param int $maxResults Jumlah maksimal hasil yang akan diambil (default adalah 50)
     * @param bool $filter jika true maka akan memfilter , akan menampilkan data yang belum tersimpan di database saja
     * @param string $part ini bertipe string , contoh 'snippet,contentDetails,id,player,status,localizations'
     * 
     * @return mixed Mengembalikan respons dari YouTube API yang berisi informasi Playlist.
     */
    public function getAllPlaylistFrYoutube($maxResults = 50,$filter = false, $part = 'snippet');
    /**
     * Menyimpan playlistId ke database
     * @param mixed $data data request yang berisi playlistId yang akan disimpan di dalam database
     * 
     * @return mixed
     */
    public function createPlaylistId($data);
    /**
     * Mengambil data playlist dari api youtube berdasarkan playlistId yang tersimpan dalam database
     * @param int $maxResults Jumlah maksimal hasil yang akan diambil (default adalah 50)
     * @param string $part ini bertipe string , contoh 'snippet,contentDetails,id,player,status,localizations'
     * 
     * @return mixed
     */

    public function getAllDataPlaylist($part = 'snippet');
    /**
     * Mengambil semua data playlistId yang tersimpan dalam database
     * @return mixed
     */
    public function getAllPlaylistId($paginate = null);
    /**
     * Mengambil semua isi video dari isi playlist berdasarkan playlistId
     * @param mixed $playlistId playlistId yang di dapatkan dari database
     * @param int $maxResults Jumlah maksimal hasil yang akan diambil (default adalah 50)
     * 
     * @return mixed
     */
    public function getPlaylistItems($playlistId, $maxResults = 50);
    /**
     * mengambil detail data video berdasarkan VideoId
     * @param mixed $videoId id video yang ini di tampilkan
     * 
     * @return mixed
     */
    public function getVideoItem($videoId);
    /**
     * update data playlistId yang tersimpan didalam database
     * @param mixed $newData Data baru yang akan disimpan ke database
     * @param mixed $oldData Data lama dari database yang akan di update
     * 
     * @return mixed
     */
    public function updatePlaylist($newData, $oldData);
    /**
     * hapus data playlistId dari database
     * @param mixed $data data playlistId yang ingin dihapus
     * 
     * @return mixed
     */
    public function deletePlaylist($data);

    /**
     * 
     * filter data playlist dari api , jadi hanya menampilkan data playlist yang belum tersimpan di db
     * @param mixed $data
     * @param mixed $playlistFromDb
     * 
     * @return [type]
     */
    public function filterDataYangSudahAda($data,$playlistFromDb);
}