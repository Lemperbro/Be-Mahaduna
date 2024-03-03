<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\StoreRepository;
use App\Repositories\JadwalRepository;
use App\Repositories\UserRepositories;
use App\Repositories\ArtikelRepository;
use App\Repositories\MajalahRepository;
use App\Repositories\YoutubeRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\AuthInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Interfaces\StoreInterface;
use App\Repositories\Interfaces\JadwalInterface;
use App\Repositories\Interfaces\ArtikelInterface;
use App\Repositories\Interfaces\MajalahInterface;
use App\Repositories\Interfaces\YoutubeInterface;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
