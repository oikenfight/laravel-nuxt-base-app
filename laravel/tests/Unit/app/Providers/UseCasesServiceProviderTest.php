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

        $app->shouldReceive('bind')->once()->with(
            \App\Http\UseCases\Contracts\Rack\StoreUseCaseInterface::class,
            \App\Http\UseCases\Rack\StoreUseCase::class
        );

        $app->shouldReceive('bind')->once()->with(
            \App\Http\UseCases\Contracts\Folder\FindUseCaseInterface::class,
            \App\Http\UseCases\Folder\FindUseCase::class
        );

        $app->shouldReceive('bind')->once()->with(
            \App\Http\UseCases\Contracts\Note\StoreUseCaseInterface::class,
            \App\Http\UseCases\Note\StoreUseCase::class
        );

        $provider = new UseCasesServiceProvider($app);

        $provider->register();
    }

}
