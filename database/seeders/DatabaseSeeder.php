<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Wali;
use App\Models\Store;
use App\Models\Galeri;
use App\Models\Jadwal;
use App\Models\Santri;
use App\Models\Artikel;
use App\Models\Majalah;
use App\Models\Tagihan;
use App\Models\Transaksi;
use App\Models\StoreImage;
use App\Models\WaliRelasi;
use App\Models\ArtikelRelasi;
use App\Models\PlaylistVideo;
use App\Models\MonitorBulanan;
use App\Models\ArtikelKategori;
use App\Models\Jenjang;
use App\Models\MonitorMingguan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'image' => 'uploads/users/default.png',
            'username' => 'ryan yulianto',
            'email' => 'sihdobleh@gmail.com',
            'password' => Hash::make('12345678'),
            'telp' => '082230736205',
            'role' => 'super admin',
        ]);
        User::factory(10)->create();
        Jenjang::factory(2)->create();
        Santri::factory(20)->create();
        Wali::factory(10)->create();
        WaliRelasi::factory(20)->create();
        Tagihan::factory(10)->create();
        Transaksi::factory(10)->create();
        MonitorBulanan::factory(10)->create();
        MonitorMingguan::factory(10)->create();
        ArtikelKategori::factory(4)->create();
        Artikel::factory(10)->create();
        ArtikelRelasi::factory(10)->create();
        Jadwal::factory(4)->create();
        Galeri::factory(20)->create();
        Majalah::factory(20)->create();
        PlaylistVideo::factory(4)->create();
        Store::factory(5)->create();
        StoreImage::factory(10)->create();
    }
}
