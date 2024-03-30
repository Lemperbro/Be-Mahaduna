<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Auth\AuthInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Wali\WaliInterface;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Wali\WaliRepository;
use App\Repositories\Store\StoreInterface;
use App\Repositories\Store\StoreRepository;
use App\Repositories\Jadwal\JadwalInterface;
use App\Repositories\Santri\SantriInterface;
use App\Repositories\Xendit\XenditInterface;
use App\Repositories\Jadwal\JadwalRepository;
use App\Repositories\Santri\SantriRepository;
use App\Repositories\Xendit\XenditRepository;
use App\Repositories\Artikel\ArtikelInterface;
use App\Repositories\Hafalan\HafalanInterface;
use App\Repositories\Jenjang\JenjangInterface;
use App\Repositories\Majalah\MajalahInterface;
use App\Repositories\Tagihan\TagihanInterface;
use App\Repositories\Youtube\YoutubeInterface;
use App\Repositories\Artikel\ArtikelRepository;
use App\Repositories\Hafalan\HafalanRepository;
use App\Repositories\Jenjang\JenjangRepository;
use App\Repositories\Majalah\MajalahRepository;
use App\Repositories\Tagihan\TagihanRepository;
use App\Repositories\Youtube\YoutubeRepository;
use App\Repositories\Transaksi\TransaksiInterface;
use App\Repositories\Transaksi\TransaksiRepository;
use App\Repositories\MonitoringMingguan\MonitoringMingguanInterface;
use App\Repositories\MonitoringMingguan\MonitoringMingguanRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(YoutubeInterface::class, YoutubeRepository::class);
        $this->app->bind(AuthInterface::class, AuthRepository::class);
        $this->app->bind(ArtikelInterface::class, ArtikelRepository::class);
        $this->app->bind(MajalahInterface::class, MajalahRepository::class);
        $this->app->bind(StoreInterface::class, StoreRepository::class);
        $this->app->bind(JadwalInterface::class, JadwalRepository::class);
        $this->app->bind(TagihanInterface::class, TagihanRepository::class);
        $this->app->bind(SantriInterface::class, SantriRepository::class);
        $this->app->bind(TransaksiInterface::class, TransaksiRepository::class);
        $this->app->bind(XenditInterface::class, XenditRepository::class);
        $this->app->bind(MonitoringMingguanInterface::class, MonitoringMingguanRepository::class);
        $this->app->bind(JenjangInterface::class, JenjangRepository::class);
        $this->app->bind(HafalanInterface::class, HafalanRepository::class);
        $this->app->bind(WaliInterface::class, WaliRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
