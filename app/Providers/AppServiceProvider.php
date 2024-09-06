<?php

namespace App\Providers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\RegionRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\RegionRepository;
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
