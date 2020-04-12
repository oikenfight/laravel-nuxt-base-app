<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Rack;

use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Rack\FindUseCaseInterface;
use App\Http\UseCases\Rack\FindUseCase;
use App\Repositories\Contracts\RackRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class FindUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Rack
 */
final class FindUseCaseTest extends TestCase
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

        $useCase = new FindUseCase($repository);

        $this->assertInstanceOf(FindUseCaseInterface::class, $useCase);
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

        $useCase = new FindUseCase($repository);

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

        /** @var Mockery\Mock|RackRepositoryInterface $repository */
        $repository = Mockery::mock(RackRepositoryInterface::class);
        $repository->shouldReceive('find')->once()->with($rackId)->andReturn($rack);

        $useCase = new FindUseCase($repository);

        $this->assertSame($expected, $useCase($rackId));
    }
}
