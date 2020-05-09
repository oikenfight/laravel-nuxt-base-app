<?php
declare(strict_types=1);

namespace Tests\Unit\app\Providers;

use App\Providers\EntitiesServiceProvider;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class EntitiesServiceProviderTest
 *
 * @package Tests\Unit\app\Providers
 */
final class EntitiesServiceProviderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        /** @var Mockery\Mock|\Illuminate\Contracts\Foundation\Application $app */
        $app = Mockery::mock(\Illuminate\Contracts\Foundation\Application::class);

        $app->shouldReceive('bind')->once()->with(
            \App\Entities\Contracts\EntityInterface::class,
            \App\Entities\Entity::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Entities\Contracts\AuthenticatableEntityInterface::class,
            \App\Entities\AuthenticatableEntity::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Entities\Contracts\CategoryInterface::class,
            \App\Entities\Category::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Entities\Contracts\FolderInterface::class,
            \App\Entities\Folder::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Entities\Contracts\ItemInterface::class,
            \App\Entities\Item::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Entities\Contracts\NoteInterface::class,
            \App\Entities\Note::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Entities\Contracts\RackInterface::class,
            \App\Entities\Rack::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Entities\Contracts\ReleaseInterface::class,
            \App\Entities\Release::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Entities\Contracts\SettingInterface::class,
            \App\Entities\Setting::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Entities\Contracts\UserInterface::class,
            \App\Entities\User::class
        );

        $provider = new EntitiesServiceProvider($app);

        $provider->register();
    }
}
