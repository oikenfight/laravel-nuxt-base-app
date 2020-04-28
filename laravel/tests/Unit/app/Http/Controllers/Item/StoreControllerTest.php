<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Item;

use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Item\StoreController;
use App\Http\UseCases\Contracts\Item\StoreUseCaseInterface;
use App\Http\UseCases\Contracts\Note\FindUseCaseInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class StoreControllerTest
 *
 * @package Tests\Unit\app\Http\Controllers\Items
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
        $noteId = 100;
        $userId = 100;

        /** @var Mockery\Mock|NoteInterface $note */
        $note = Mockery::mock(NoteInterface::class);
        $note->id = $noteId;
        /** @var Mockery\Mock|UserInterface $user */
        $user = Mockery::mock(UserInterface::class);
        $user->id = $userId;
        /** @var Mockery\Mock|ItemInterface $item */
        $item = Mockery::mock(ItemInterface::class);

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('user')->with()->once()->andReturn($user);
        $request->shouldReceive('get')->with('noteId')->once()->andReturn($noteId);

        /** @var Mockery\Mock|FindUseCaseInterface $findUseCase */
        $findUseCase = Mockery::mock(FindUseCaseInterface::class);
        $findUseCase->shouldReceive('__invoke')->with($noteId)->once()->andReturn($note);

        /** @var Mockery\Mock|StoreUseCaseInterface $useCase */
        $useCase = Mockery::mock(StoreUseCaseInterface::class);
        $useCase->shouldReceive('__invoke')->with($userId, $noteId)->once()->andReturn($item);

        /** @var Mockery\Mock|ResponseFactory $responseFactory */
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')->with([
            'item' => $item
        ])->once();

        app()->bind(ResponseFactory::class, function () use ($responseFactory) {
            return $responseFactory;
        });

        $controller = new StoreController();

        $controller($request, $useCase, $findUseCase);
    }
}
