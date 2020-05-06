<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Category\UpdateController;
use App\Http\UseCases\Contracts\Category\UpdateUseCaseInterface;
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
        $categoryId = 100;
        $inputData = ['Dummy Category Data'];

        /** @var Mockery\Mock|CategoryInterface $category */
        $category = Mockery::mock(CategoryInterface::class);

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('route')->with('Category')->once()->andReturn($categoryId);
        $request->shouldReceive('get')->with('category')->once()->andReturn($inputData);

        /** @var Mockery\Mock|UpdateUseCaseInterface $useCase */
        $useCase = Mockery::mock(UpdateUseCaseInterface::class);
        $useCase->shouldReceive('__invoke')->with($categoryId, $inputData)->once()->andReturn($category);

        /** @var Mockery\Mock|ResponseFactory $responseFactory */
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')->with([
            'category' => $category
        ])->once();

        app()->bind(ResponseFactory::class, function () use ($responseFactory) {
            return $responseFactory;
        });

        $controller = new UpdateController();

        $controller($request, $useCase);
    }
}
