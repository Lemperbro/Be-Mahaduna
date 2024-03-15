<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\StoreRepository;
use App\Repositories\JadwalRepository;
use App\Repositories\SantriRepository;
use App\Repositories\UserRepositories;
use App\Repositories\XenditRepository;
use App\Repositories\ArtikelRepository;
use App\Repositories\JenjangRepository;
use App\Repositories\MajalahRepository;
use App\Repositories\TagihanRepository;
use App\Repositories\YoutubeRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\TransaksiRepository;
use App\Repositories\Interfaces\AuthInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Interfaces\StoreInterface;
use App\Repositories\Interfaces\JadwalInterface;
use App\Repositories\Interfaces\SantriInterface;
use App\Repositories\Interfaces\XenditInterface;
use App\Repositories\Interfaces\ArtikelInterface;
use App\Repositories\Interfaces\JenjangInterface;
use App\Repositories\Interfaces\MajalahInterface;
use App\Repositories\Interfaces\TagihanInterface;
use App\Repositories\Interfaces\YoutubeInterface;
use App\Repositories\MonitoringMingguanRepository;
use App\Repositories\Interfaces\TransaksiInterface;
use App\Repositories\Interfaces\MonitoringMingguanInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepositories::class);
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
