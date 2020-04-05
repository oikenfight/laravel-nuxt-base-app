<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * UseCasesServiceProvider class
 *
 * @package App\Providers
 */
class UseCasesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Rack

        // Folder
        $this->app->bind(
            \App\Http\UseCases\Contracts\Folder\FindUseCaseInterface::class,
            \App\Http\UseCases\Folder\FindUseCase::class
        );

        // Note
        $this->app->bind(
            \App\Http\UseCases\Contracts\Note\StoreUseCaseInterface::class,
            \App\Http\UseCases\Note\StoreUseCase::class
        );

        // Item
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
