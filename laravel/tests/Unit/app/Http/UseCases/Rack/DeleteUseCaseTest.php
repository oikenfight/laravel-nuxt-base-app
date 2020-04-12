<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Rack;

use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Rack\DeleteUseCaseInterface;
use App\Http\UseCases\Rack\DeleteUseCase;
use App\Repositories\Contracts\RackRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class DeleteUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Rack
 */
final class DeleteUseCaseTest extends TestCase
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

        $useCase = new DeleteUseCase($repository);

        $this->assertInstanceOf(DeleteUseCaseInterface::class, $useCase);
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

        $useCase = new DeleteUseCase($repository);

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
        $expected = true;
        $rackId = 100;

        /** @var Mockery\Mock|RackRepositoryInterface $repository */
        $repository = Mockery::mock(RackRepositoryInterface::class);
        $repository->shouldReceive('delete')->once()->with($rackId)->andReturn(true);

        $useCase = new DeleteUseCase($repository);

        $this->assertSame($expected, $useCase($rackId));
    }
}
