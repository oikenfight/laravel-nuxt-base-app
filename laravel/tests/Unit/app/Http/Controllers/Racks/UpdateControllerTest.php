<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Racks;

use App\Entities\Contracts\RackInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Rack\UpdateController;
use App\Http\UseCases\Contracts\Rack\UpdateUseCaseInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery;
use Tests\Unit\TestCase;

final class UpdateControllerTest extends TestCase
{
    /**
     * test instance of.
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $controller = new UpdateController();

        $this->assertInstanceOf(Controller::class, $controller);
    }

    /**
     * test __invoke method
     *
     * @raturn void
     */
    public function testInvoke()
    {
        $rackId = 100;
        $inputData = ['Dummy Rack Data'];

        /** @var Mockery\Mock|RackInterface $rack */
        $rack = Mockery::mock(RackInterface::class);

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('route')->with('Rack')->once()->andReturn($rackId);
        $request->shouldReceive('get')->with('rack')->once()->andReturn($inputData);

        /** @var Mockery\Mock|UpdateUseCaseInterface $useCase */
        $useCase = Mockery::mock(UpdateUseCaseInterface::class);
        $useCase->shouldReceive('__invoke')->with($rackId, $inputData)->once()->andReturn($rack);

        /** @var Mockery\Mock|ResponseFactory $responseFactory */
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')->with([
            'rack' => $rack
        ])->once();

        app()->bind(ResponseFactory::class, function () use ($responseFactory) {
            return $responseFactory;
        });

        $controller = new UpdateController();

        $controller($request, $useCase);
    }
}
