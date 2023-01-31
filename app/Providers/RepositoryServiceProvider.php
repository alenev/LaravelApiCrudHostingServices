<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\ClientsServicesRepositoryInterface;
use App\Repositories\ClientsServicesRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ClientsServicesRepositoryInterface::class, ClientsServicesRepository::class
         );

         $this->app->bind(
            UserRepositoryInterface::class, UserRepository::class
         );
         
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
