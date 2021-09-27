<?php

namespace App\Providers;

use App\Repositories\Api\V1\System\NewsRepository;
use App\Repositories\Repository;
use App\Services\Api\V1\Impl\NewsServiceImpl;
use App\Services\Api\V1\NewsService;
use App\Services\Core\FileService;
use App\Services\Core\Impl\FileServiceImpl;
use Carbon\Laravel\ServiceProvider;

class SystemServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $newsRepo = new NewsRepository();
        $fileRepo = new FileServiceImpl();
        $this->app->bind(NewsService::class, function () use ($fileRepo, $newsRepo) {
            return new NewsServiceImpl($fileRepo, $newsRepo);
        });

        $this->app->bind(FileService::class, function () {
            return new  FileServiceImpl();
        });

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
