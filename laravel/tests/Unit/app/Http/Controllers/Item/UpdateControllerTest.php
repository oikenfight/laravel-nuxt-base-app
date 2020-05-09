<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Item;

use App\Entities\Contracts\ItemInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Item\UpdateController;
use App\Http\UseCases\Contracts\Item\UpdateUseCaseInterface;
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
        $itemId = 100;
        $inputData = ['Dummy Item Data'];

        /** @var Mockery\Mock|ItemInterface $item */
        $item = Mockery::mock(ItemInterface::class);

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('route')->with('Item')->once()->andReturn($itemId);
        $request->shouldReceive('get')->with('item')->once()->andReturn($inputData);

        /** @var Mockery\Mock|UpdateUseCaseInterface $useCase */
        $useCase = Mockery::mock(UpdateUseCaseInterface::class);
        $useCase->shouldReceive('__invoke')->with($itemId, $inputData)->once()->andReturn($item);

        /** @var Mockery\Mock|ResponseFactory $responseFactory */
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')->with([
            'item' => $item
        ])->once();

        app()->bind(ResponseFactory::class, function () use ($responseFactory) {
            return $responseFactory;
        });

        $controller = new UpdateController();

        $controller($request, $useCase);
    }
}
