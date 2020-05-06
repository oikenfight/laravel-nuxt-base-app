<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * RepositoriesServiceProvider class
 *
 * @package App\Providers
 */
class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Contracts\CategoryRepositoryInterface::class,
            \App\Repositories\CategoryRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\FolderRepositoryInterface::class,
            \App\Repositories\FolderRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\ItemRepositoryInterface::class,
            \App\Repositories\ItemRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\NoteRepositoryInterface::class,
            \App\Repositories\NoteRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\RackRepositoryInterface::class,
            \App\Repositories\RackRepository::class
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
