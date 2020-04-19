<?php
declare(strict_types=1);

namespace Tests\Unit\app\Providers\Services;

use App\Providers\Services\ResponseDataMakerServiceProvider;
use Illuminate\Support\ServiceProvider;
use Mockery;
use Tests\Unit\TestCase;

class ResponseDataMakerServiceProviderTest extends TestCase
{
    /**
     * test instance of
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $provider = new ResponseDataMakerServiceProvider(app());

        $this->assertInstanceOf(ServiceProvider::class, $provider);
    }

    public function testRegister()
    {
        /** @var Mockery\Mock|\Illuminate\Contracts\Foundation\Application $app */
        $app = Mockery::mock(\Illuminate\Contracts\Foundation\Application::class);

        $app->shouldReceive('bind')->once()->with(
            \App\Services\ResponseDataMakers\Contracts\ResponseDataMakerInterface::class,
            \App\Services\ResponseDataMakers\ResponseDataMaker::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Services\ResponseDataMakers\Contracts\ResponseFoldersMakerInterface::class,
            \App\Services\ResponseDataMakers\ResponseFoldersMaker::class
        );
        $app->shouldReceive('bind')->once()->with(
            \App\Services\ResponseDataMakers\Contracts\ResponseRacksMakerInterface::class,
            \App\Services\ResponseDataMakers\ResponseRacksMaker::class
        );

        $provider = new ResponseDataMakerServiceProvider($app);

        $provider->register();
    }
}
