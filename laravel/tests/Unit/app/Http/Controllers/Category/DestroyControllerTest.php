<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Category;

use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Category\DestroyController;
use App\Http\UseCases\Contracts\Category\DeleteUseCaseInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class DestroyControllerTest
 * @package Tests\Unit\app\Http\Controllers\Categorys
 */
final class DestroyControllerTest extends TestCase
{
    /**
     * test instance of.
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $controller = new DestroyController();

        $this->assertInstanceOf(Controller::class, $controller);
    }

    /**
     * test __invoke method
     *
     * @raturn void
     */
    public function testInvoke()
    {
        $categoryId = 100;

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('route')->with('Category')->once()->andReturn($categoryId);

        /** @var Mockery\Mock|DeleteUseCaseInterface $useCase */
        $useCase = Mockery::mock(DeleteUseCaseInterface::class);
        $useCase->shouldReceive('__invoke')->with($categoryId)->once();

        /** @var Mockery\Mock|ResponseFactory $responseFactory */
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')->with([
            'result' => 'success'
        ])->once();

        app()->bind(ResponseFactory::class, function () use ($responseFactory) {
            return $responseFactory;
        });

        $controller = new DestroyController();

        $controller($request, $useCase);
    }
}
