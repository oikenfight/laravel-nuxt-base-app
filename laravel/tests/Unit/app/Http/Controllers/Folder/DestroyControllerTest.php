<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Folder;

use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Folder\DestroyController;
use App\Http\UseCases\Contracts\Folder\DeleteUseCaseInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class DestroyControllerTest
 * @package Tests\Unit\app\Http\Controllers\Folders
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
        $folderId = 100;

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('route')->with('Folder')->once()->andReturn($folderId);

        /** @var Mockery\Mock|DeleteUseCaseInterface $useCase */
        $useCase = Mockery::mock(DeleteUseCaseInterface::class);
        $useCase->shouldReceive('__invoke')->with($folderId)->once();

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
