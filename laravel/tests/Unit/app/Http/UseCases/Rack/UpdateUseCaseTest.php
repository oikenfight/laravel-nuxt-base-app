<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Rack;

use App\Entities\Contracts\RackInterface;
use App\Http\UseCases\Contracts\Rack\UpdateUseCaseInterface;
use App\Http\UseCases\Rack\UpdateUseCase;
use App\Repositories\Contracts\RackRepositoryInterface;
use Illuminate\Http\Request;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class UpdateUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Rack
 */
final class UpdateUseCaseTest extends TestCase
{
    /**
     * test instance of
     *
     * @return void
     */
    public function testInstanceOf()
    {
        /** @var Mockery\Mock|RackRepositoryInterface $repository */
        $repository = Mockery::mock(RackRepositoryInterface::class);

        $useCase = new UpdateUseCase($repository);

        $this->assertInstanceOf(UpdateUseCaseInterface::class, $useCase);
    }

    /**
     * test __construct
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testConstruct()
    {
        /** @var Mockery\Mock|RackRepositoryInterface $repository */
        $repository = Mockery::mock(RackRepositoryInterface::class);

        $useCase = new UpdateUseCase($repository);

        $repositoryRef = $this->getHiddenProperty($useCase, 'repository');

        $this->assertSame($repository, $repositoryRef->getValue($useCase));
    }

    /**
     * test __invoke method
     *
     * @return void
     * @throws \App\Repositories\Exceptions\RackNotFoundException
     */
    public function testInvoke()
    {
        /** @var Mockery\Mock|RackInterface $user */
        $rack = Mockery::mock(RackInterface::class);
        $expected = $rack;

        $rackId = 100;
        $inputs = [
            'name' => 'dummy-name'
        ];

        /** @var Mockery\Mock|RackRepositoryInterface $repository */
        $repository = Mockery::mock(RackRepositoryInterface::class);
        $repository->shouldReceive('update')->once()->with($rackId, $inputs)->andReturn($rack);

        /** @var Mockery\Mock|Request $request */
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('only')->once()->with([
            'rack.name',
        ])->andReturn($inputs);

        $useCase = new UpdateUseCase($repository);

        $this->assertSame($expected, $useCase($rackId, $request));
    }
}
