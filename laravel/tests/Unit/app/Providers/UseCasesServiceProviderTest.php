<?php
declare(strict_types=1);

namespace Tests\Unit\app\Providers;

use App\Providers\UseCasesServiceProvider;
use Illuminate\Support\ServiceProvider;
use Mockery;
use Tests\Unit\TestCase;

final class UseCasesServiceProviderTest extends TestCase
{
    /**
     * test instance of
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $provider = new UseCasesServiceProvider(app());

        $this->assertInstanceOf(ServiceProvider::class, $provider);
    }

    public function testRegister()
    {
        /** @var Mockery\Mock|\Illuminate\Contracts\Foundation\Application $app */
        $app = Mockery::mock(\Illuminate\Contracts\Foundation\Application::class);

        // Rack
        $app->shouldReceive('bind')->once()->with(
            \App\Http\UseCases\Contracts\Rack\DeleteUseCaseInterface::class,
            \App\Http\UseCases\Rack\DeleteUseCase::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Http\UseCases\Contracts\Rack\FindUseCaseInterface::class,
            \App\Http\UseCases\Rack\FindUseCase::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Http\UseCases\Contracts\Rack\UpdateUseCaseInterface::class,
            \App\Http\UseCases\Rack\UpdateUseCase::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Http\UseCases\Contracts\Rack\StoreUseCaseInterface::class,
            \App\Http\UseCases\Rack\StoreUseCase::class
        );

        // Folder
        $app->shouldReceive('bind')->once()->with(
            \App\Http\UseCases\Contracts\Folder\DeleteUseCaseInterface::class,
            \App\Http\UseCases\Folder\DeleteUseCase::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Http\UseCases\Contracts\Folder\FindUseCaseInterface::class,
            \App\Http\UseCases\Folder\FindUseCase::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Http\UseCases\Contracts\Folder\UpdateUseCaseInterface::class,
            \App\Http\UseCases\Folder\UpdateUseCase::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Http\UseCases\Contracts\Folder\StoreUseCaseInterface::class,
            \App\Http\UseCases\Folder\StoreUseCase::class
        );

        // Note
        $app->shouldReceive('bind')->once()->with(
            \App\Http\UseCases\Contracts\Note\StoreUseCaseInterface::class,
            \App\Http\UseCases\Note\StoreUseCase::class
        );

        $provider = new UseCasesServiceProvider($app);

        $provider->register();
    }

}
