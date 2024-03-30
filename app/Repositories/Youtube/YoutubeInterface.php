<?php
namespace App\Repositories\Youtube;


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
    public function getAllPlaylistFrYoutube($maxResults = 50, $filter = false, $part = 'snippet');
    /**
     * Menyimpan playlistId ke database
     * @param mixed $data data request yang berisi playlistId yang akan disimpan di dalam database
     * 
     * @return mixed
     */
    public function createPlaylistId($data);
    /**
     * ambil semua data playlist dari api youtube, berdasarkan playlistId yang di simpan di db
     * @param int $maxResults
     * @param string $part ini bertipe string , contoh 'snippet,contentDetails,id,player,status,localizations'
     * @param mixed $keyword untuk mencari data
     * @param int $paginate untuk mempaginate data
     * 
     * @return [type]
     */
    public function getAllDataPlaylist($part = 'snippet', $keyword = null, $paginate = 10);
    /**
     * Mengambil semua data playlistId yang tersimpan dalam database
     * @return mixed
     */
    public function getAllPlaylistId($paginate = null);
/**
     * Menampilkan isi playlist
     * @param mixed $playlistId id playlist yang akan di ambil
     * @param int $paginate untuk mempaginate data
     * @param string $part ini bertipe string , contoh 'snippet,contentDetails,id,status'
     * @param mixed $pageToken ini untuk ketika ada nextPageToken atau paginate di api youtube
     * 
     * @return mixed
     */
    public function getPlaylistItems($part = 'snippet', $playlistId, $paginate = 10, $pageToken = null);
    /**
     * untuk menampilkan video dari semua playlist
     * @param string $evenType default 'completed', nilai yang tersedia 'completed', 'live'
     * @param int $paginate
     * 
     * @return [type]
     */
    public function getAllVideo($evenType = 'completed', $paginate = 10,$pageToken = null);

    /**
     * Ambil detail data video dari id video
     * @param mixed $videoId id video yang akan di ambil datanya
     * @param string $part default 'player,snippet' , nilai yang tersedia 'player,snippet,contentDetails,statistics',
     * 
     * @return mixed
     */
    public function getVideoItem(string $videoId, string $part = 'player,snippet');
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
    public function filterDataYangSudahAda($data, $playlistFromDb);
}