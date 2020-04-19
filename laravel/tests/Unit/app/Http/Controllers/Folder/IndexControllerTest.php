<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Folder;

use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Folder\IndexController;
use App\Services\ResponseDataMakers\Contracts\ResponseFoldersMakerInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class IndexControllerTest
 *
 * @package Tests\Unit\app\Http\Controllers\Folders
 */
final class IndexControllerTest extends TestCase
{
    /**
     * test instance of.
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $controller = new IndexController();

        $this->assertInstanceOf(Controller::class, $controller);
    }

    /**
     * test __invoke method
     *
     * @raturn void
     */
    public function testInvoke()
    {
        /** @var Mockery\Mock|Collection $collection */
        $collection = Mockery::mock(Collection::class);

        /** @var Mockery\Mock|HasMany $hasMany */
        $hasMany = Mockery::mock(HasMany::class);
        $hasMany->shouldReceive('get')->with()->once()->andReturn($collection);

        /** @var Mockery\Mock|UserInterface $user */
        $user = Mockery::mock(UserInterface::class);
        $user->shouldReceive('folders')->with()->once()->andReturn($hasMany);

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('user')->once()->with()->andReturn($user);

        /** @var Mockery\Mock|ResponseFoldersMakerInterface $makerUseCase */
        $responseMaker = Mockery::mock(ResponseFoldersMakerInterface::class);
        $responseMaker->shouldReceive('make')->with($collection)->once()->andReturn($collection);

        /** @var Mockery\Mock|ResponseFactory $responseFactory */
        $responseFactory = Mockery::mock(ResponseFactory::class);
        $responseFactory->shouldReceive('json')->with([
            'folders' => $collection
        ])->once();

        app()->bind(ResponseFactory::class, function () use ($responseFactory) {
            return $responseFactory;
        });

        $controller = new IndexController();

        $controller($request, $responseMaker);
    }
}
