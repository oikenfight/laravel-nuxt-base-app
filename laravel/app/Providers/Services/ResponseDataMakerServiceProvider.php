<?php
declare(strict_types=1);

namespace App\Providers\Services;

use Illuminate\Support\ServiceProvider;

/**
 * Class ResponseDataMakerServiceProvider
 * @package App\Providers\Services
 */
final class ResponseDataMakerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // ResponseDataMaker
        $this->app->bind(
            \App\Services\ResponseDataMakers\Contracts\ResponseDataMakerInterface::class,
            \App\Services\ResponseDataMakers\ResponseDataMaker::class
        );
        // ResponseRacksMaker
        $this->app->bind(
            \App\Services\ResponseDataMakers\Contracts\ResponseRacksMakerInterface::class,
            \App\Services\ResponseDataMakers\ResponseRacksMaker::class
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
