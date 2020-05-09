<?php
declare(strict_types=1);

namespace Tests\Unit\app\Providers;

use App\Providers\RepositoriesServiceProvider;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class RepositoriesServiceProviderTest
 *
 * @package Tests\Unit\app\Providers
 */
final class RepositoriesServiceProviderTest extends TestCase
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
            \App\Repositories\Contracts\CategoryRepositoryInterface::class,
            \App\Repositories\CategoryRepository::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Repositories\Contracts\FolderRepositoryInterface::class,
            \App\Repositories\FolderRepository::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Repositories\Contracts\ItemRepositoryInterface::class,
            \App\Repositories\ItemRepository::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Repositories\Contracts\NoteRepositoryInterface::class,
            \App\Repositories\NoteRepository::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Repositories\Contracts\RackRepositoryInterface::class,
            \App\Repositories\RackRepository::class
        );


        $provider = new RepositoriesServiceProvider($app);

        $provider->register();
    }
}
