<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Folder\UpdateController;
use App\Http\UseCases\Contracts\Folder\UpdateUseCaseInterface;
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
        $folderId = 100;
        $inputData = ['Dummy Folder Data'];

        /** @var Mockery\Mock|FolderInterface $folder */
        $folder = Mockery::mock(FolderInterface::class);

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('route')->with('Folder')->once()->andReturn($folderId);
        $request->shouldReceive('get')->with('folder')->once()->andReturn($inputData);

        /** @var Mockery\Mock|UpdateUseCaseInterface $useCase */
        $useCase = Mockery::mock(UpdateUseCaseInterface::class);
        $useCase->shouldReceive('__invoke')->with($folderId, $inputData)->once()->andReturn($folder);

        /** @var Mockery\Mock|ResponseFactory $responseFactory */
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')->with([
            'folder' => $folder
        ])->once();

        app()->bind(ResponseFactory::class, function () use ($responseFactory) {
            return $responseFactory;
        });

        $controller = new UpdateController();

        $controller($request, $useCase);
    }
}
