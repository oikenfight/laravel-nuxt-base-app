<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Category\StoreController;
use App\Http\UseCases\Contracts\Category\StoreUseCaseInterface;
use App\Http\UseCases\Contracts\Rack\FindUseCaseInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class StoreControllerTest
 *
 * @package Tests\Unit\app\Http\Controllers\Categorys
 */
final class StoreControllerTest extends TestCase
{
    /**
     * test instance of.
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $controller = new StoreController();

        $this->assertInstanceOf(Controller::class, $controller);
    }

    /**
     * test __invoke method
     *
     * @raturn void
     */
    public function testInvoke()
    {
        $userId = 100;

        /** @var Mockery\Mock|UserInterface $user */
        $user = Mockery::mock(UserInterface::class);
        $user->id = $userId;
        /** @var Mockery\Mock|CategoryInterface $category */
        $category = Mockery::mock(CategoryInterface::class);

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('user')->with()->once()->andReturn($user);

        /** @var Mockery\Mock|StoreUseCaseInterface $useCase */
        $useCase = Mockery::mock(StoreUseCaseInterface::class);
        $useCase->shouldReceive('__invoke')->with($userId)->once()->andReturn($category);

        /** @var Mockery\Mock|ResponseFactory $responseFactory */
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')->with([
            'category' => $category
        ])->once();

        app()->bind(ResponseFactory::class, function () use ($responseFactory) {
            return $responseFactory;
        });

        $controller = new StoreController();

        $controller($request, $useCase);
    }
}
