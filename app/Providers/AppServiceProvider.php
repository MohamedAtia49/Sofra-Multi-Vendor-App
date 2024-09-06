<?php

namespace App\Providers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\RegionRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\SettingRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CityRepository;
use App\Repositories\RegionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\SettingRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        app()->bind(RegionRepositoryInterface::class , RegionRepository::class);
        app()->bind(CityRepositoryInterface::class , CityRepository::class);
        app()->bind(SettingRepositoryInterface::class , SettingRepository::class);
        app()->bind(RoleRepositoryInterface::class , RoleRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
