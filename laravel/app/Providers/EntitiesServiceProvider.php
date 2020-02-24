<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * EntitiesServiceProvider class
 *
 * @package App\Providers
 */
class EntitiesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Entities\Contracts\EntityInterface::class,
            \App\Entities\Entity::class
        );
        $this->app->bind(
            \App\Entities\Contracts\EntityInterface::class,
            \App\Entities\Entity::class
        );
        $this->app->bind(
            \App\Entities\Contracts\FolderInterface::class,
            \App\Entities\Folder::class
        );
        $this->app->bind(
            \App\Entities\Contracts\ItemInterface::class,
            \App\Entities\Item::class
        );
        $this->app->bind(
            \App\Entities\Contracts\NoteInterface::class,
            \App\Entities\Note::class
        );
        $this->app->bind(
            \App\Entities\Contracts\RackInterface::class,
            \App\Entities\Rack::class
        );
        $this->app->bind(
            \App\Entities\Contracts\ReleaseInterface::class,
            \App\Entities\Release::class
        );
        $this->app->bind(
            \App\Entities\Contracts\SettingInterface::class,
            \App\Entities\Setting::class
        );
        $this->app->bind(
            \App\Entities\Contracts\UserInterface::class,
            \App\Entities\User::class
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
