<?php

namespace App\Providers;

use App\Models\Volume;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use App\Repositories\FamilyRepository;
use App\Repositories\Contracts\FamilyRepositoryInterface;
use App\Repositories\GenusRepository;
use App\Repositories\Contracts\GenusRepositoryInterface;
use App\Repositories\SpeciesRepository;
use App\Repositories\Contracts\SpeciesRepositoryInterface;
use App\Repositories\Contracts\VolumeRepositoryInterface;
use App\Repositories\VolumeRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(FamilyRepositoryInterface::class, FamilyRepository::class);
        $this->app->bind(GenusRepositoryInterface::class, GenusRepository::class);
        $this->app->bind(SpeciesRepositoryInterface::class, SpeciesRepository::class);
        $this->app->bind(SpeciesRepositoryInterface::class, SpeciesRepository::class);
        $this->app->bind(VolumeRepositoryInterface::class, VolumeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */


    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
