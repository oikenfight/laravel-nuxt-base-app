<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Note;

use App\Entities\Contracts\NoteInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Note\UpdateController;
use App\Http\UseCases\Contracts\Note\UpdateUseCaseInterface;
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
        $noteId = 100;
        $inputData = ['Dummy Note Data'];

        /** @var Mockery\Mock|NoteInterface $note */
        $note = Mockery::mock(NoteInterface::class);

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('route')->with('Note')->once()->andReturn($noteId);
        $request->shouldReceive('get')->with('note')->once()->andReturn($inputData);

        /** @var Mockery\Mock|UpdateUseCaseInterface $useCase */
        $useCase = Mockery::mock(UpdateUseCaseInterface::class);
        $useCase->shouldReceive('__invoke')->with($noteId, $inputData)->once()->andReturn($note);

        /** @var Mockery\Mock|ResponseFactory $responseFactory */
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')->with([
            'note' => $note
        ])->once();

        app()->bind(ResponseFactory::class, function () use ($responseFactory) {
            return $responseFactory;
        });

        $controller = new UpdateController();

        $controller($request, $useCase);
    }
}
