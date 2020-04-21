<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Folder\StoreController;
use App\Http\UseCases\Contracts\Folder\StoreUseCaseInterface;
use App\Http\UseCases\Contracts\Rack\FindUseCaseInterface;
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
        $rackId = 100;
        $userId = 100;

        /** @var Mockery\Mock|RackInterface $rack */
        $rack = Mockery::mock(RackInterface::class);
        $rack->id = $rackId;
        /** @var Mockery\Mock|UserInterface $user */
        $user = Mockery::mock(UserInterface::class);
        $user->id = $userId;
        /** @var Mockery\Mock|FolderInterface $folder */
        $folder = Mockery::mock(FolderInterface::class);

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('user')->with()->once()->andReturn($user);
        $request->shouldReceive('get')->with('rackId')->once()->andReturn($rackId);

        /** @var Mockery\Mock|FindUseCaseInterface $findUseCase */
        $findUseCase = Mockery::mock(FindUseCaseInterface::class);
        $findUseCase->shouldReceive('__invoke')->with($rackId)->once()->andReturn($rack);

        /** @var Mockery\Mock|StoreUseCaseInterface $useCase */
        $useCase = Mockery::mock(StoreUseCaseInterface::class);
        $useCase->shouldReceive('__invoke')->with($userId, $rackId)->once()->andReturn($folder);

        /** @var Mockery\Mock|ResponseFactory $responseFactory */
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')->with([
            'folder' => $folder
        ])->once();

        app()->bind(ResponseFactory::class, function () use ($responseFactory) {
            return $responseFactory;
        });

        $controller = new StoreController();

        $controller($request, $useCase, $findUseCase);
    }
}
