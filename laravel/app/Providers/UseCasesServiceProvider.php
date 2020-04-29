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
        $this->app->bind(
            \App\Http\UseCases\Contracts\Rack\DeleteUseCaseInterface::class,
            \App\Http\UseCases\Rack\DeleteUseCase::class
        );
        $this->app->bind(
            \App\Http\UseCases\Contracts\Rack\FindUseCaseInterface::class,
            \App\Http\UseCases\Rack\FindUseCase::class
        );
        $this->app->bind(
            \App\Http\UseCases\Contracts\Rack\StoreUseCaseInterface::class,
            \App\Http\UseCases\Rack\StoreUseCase::class
        );
        $this->app->bind(
            \App\Http\UseCases\Contracts\Rack\UpdateUseCaseInterface::class,
            \App\Http\UseCases\Rack\UpdateUseCase::class
        );

        // Folder
        $this->app->bind(
            \App\Http\UseCases\Contracts\Folder\DeleteUseCaseInterface::class,
            \App\Http\UseCases\Folder\DeleteUseCase::class
        );
        $this->app->bind(
            \App\Http\UseCases\Contracts\Folder\FindUseCaseInterface::class,
            \App\Http\UseCases\Folder\FindUseCase::class
        );
        $this->app->bind(
            \App\Http\UseCases\Contracts\Folder\StoreUseCaseInterface::class,
            \App\Http\UseCases\Folder\StoreUseCase::class
        );
        $this->app->bind(
            \App\Http\UseCases\Contracts\Folder\UpdateUseCaseInterface::class,
            \App\Http\UseCases\Folder\UpdateUseCase::class
        );

        // Note
        $this->app->bind(
            \App\Http\UseCases\Contracts\Note\DeleteUseCaseInterface::class,
            \App\Http\UseCases\Note\DeleteUseCase::class
        );
        $this->app->bind(
            \App\Http\UseCases\Contracts\Note\FindUseCaseInterface::class,
            \App\Http\UseCases\Note\FindUseCase::class
        );
        $this->app->bind(
            \App\Http\UseCases\Contracts\Note\StoreUseCaseInterface::class,
            \App\Http\UseCases\Note\StoreUseCase::class
        );
        $this->app->bind(
            \App\Http\UseCases\Contracts\Note\UpdateUseCaseInterface::class,
            \App\Http\UseCases\Note\UpdateUseCase::class
        );

        // Item
        $this->app->bind(
            \App\Http\UseCases\Contracts\Item\DeleteUseCaseInterface::class,
            \App\Http\UseCases\Item\DeleteUseCase::class
        );
        $this->app->bind(
            \App\Http\UseCases\Contracts\Item\FindUseCaseInterface::class,
            \App\Http\UseCases\Item\FindUseCase::class
        );
        $this->app->bind(
            \App\Http\UseCases\Contracts\Item\StoreUseCaseInterface::class,
            \App\Http\UseCases\Item\StoreUseCase::class
        );
        $this->app->bind(
            \App\Http\UseCases\Contracts\Item\UpdateUseCaseInterface::class,
            \App\Http\UseCases\Item\UpdateUseCase::class
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
