<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Folder\StoreController;
use App\Http\UseCases\Contracts\Folder\StoreUseCaseInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class StoreControllerTest
 *
 * @package Tests\Unit\app\Http\Controllers\Folders
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
        /** @var Mockery\Mock|UserInterface $user */
        $user = Mockery::mock(UserInterface::class);

        /** @var Mockery\Mock|FolderInterface $folder */
        $folder = Mockery::mock(FolderInterface::class);

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('user')->once()->with()->andReturn($user);

        /** @var Mockery\Mock|StoreUseCaseInterface $useCase */
        $useCase = Mockery::mock(StoreUseCaseInterface::class);
        $useCase->shouldReceive('__invoke')->with($user)->once()->andReturn($folder);

        /** @var Mockery\Mock|ResponseFactory $responseFactory */
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')->with([
            'folder' => $folder
        ])->once();

        app()->bind(ResponseFactory::class, function () use ($responseFactory) {
            return $responseFactory;
        });

        $controller = new StoreController();

        $controller($request, $useCase);
    }
}
