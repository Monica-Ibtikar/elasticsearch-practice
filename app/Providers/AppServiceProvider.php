<?php

namespace App\Providers;

use App\Department;
use App\Repositories\Contracts\DepartmentRepositoryInterface;
use App\Repositories\Contracts\DeveloperRepositoryInterface;
use App\Repositories\DepartmentRepository;
use App\Repositories\DeveloperRepository;
use Elasticsearch\ClientBuilder;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(ClientBuilder::class, function ($app) {
            $hosts = [
                'es01',
                'es02',
                'es03',
            ];
            return ClientBuilder::create()->setHosts($hosts)->build();
        });

        $this->app->bind( DepartmentRepositoryInterface::class, function ($app) {
            return new DepartmentRepository("departments");
        });

        $this->app->bind( DeveloperRepositoryInterface::class, function ($app) {
            return new DeveloperRepository("developers");
        });
    }
}
