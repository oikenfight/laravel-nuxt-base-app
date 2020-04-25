<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Note;

use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Note\StoreController;
use App\Http\UseCases\Contracts\Note\StoreUseCaseInterface;
use App\Http\UseCases\Contracts\Folder\FindUseCaseInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class StoreControllerTest
 *
 * @package Tests\Unit\app\Http\Controllers\Notes
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
        $folderId = 100;
        $userId = 100;

        /** @var Mockery\Mock|FolderInterface $folder */
        $folder = Mockery::mock(FolderInterface::class);
        $folder->id = $folderId;
        /** @var Mockery\Mock|UserInterface $user */
        $user = Mockery::mock(UserInterface::class);
        $user->id = $userId;
        /** @var Mockery\Mock|NoteInterface $note */
        $note = Mockery::mock(NoteInterface::class);

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('user')->with()->once()->andReturn($user);
        $request->shouldReceive('get')->with('folderId')->once()->andReturn($folderId);

        /** @var Mockery\Mock|FindUseCaseInterface $findUseCase */
        $findUseCase = Mockery::mock(FindUseCaseInterface::class);
        $findUseCase->shouldReceive('__invoke')->with($folderId)->once()->andReturn($folder);

        /** @var Mockery\Mock|StoreUseCaseInterface $useCase */
        $useCase = Mockery::mock(StoreUseCaseInterface::class);
        $useCase->shouldReceive('__invoke')->with($userId, $folderId)->once()->andReturn($note);

        /** @var Mockery\Mock|ResponseFactory $responseFactory */
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')->with([
            'note' => $note
        ])->once();

        app()->bind(ResponseFactory::class, function () use ($responseFactory) {
            return $responseFactory;
        });

        $controller = new StoreController();

        $controller($request, $useCase, $findUseCase);
    }
}
