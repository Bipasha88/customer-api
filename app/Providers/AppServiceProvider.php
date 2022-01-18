<?php

namespace App\Providers;

use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\IBaseRepository;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\ICustomerRepository;
use App\Services\Customer\CustomerServices;
use App\Services\Customer\ICustomerService;
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
        $this->app->bind(IBaseRepository::class,BaseRepository::class);
        $this->app->bind(ICustomerRepository::class,CustomerRepository::class);
        $this->app->bind(ICustomerService::class,CustomerServices::class);
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
