<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Rack;

use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Rack\StoreUseCaseInterface;
use App\Http\UseCases\Rack\StoreUseCase;
use App\Repositories\Contracts\RackRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class StoreUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Rack
 */
final class StoreUseCaseTest extends TestCase
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

        $useCase = new StoreUseCase($repository);

        $this->assertInstanceOf(StoreUseCaseInterface::class, $useCase);
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

        $useCase = new StoreUseCase($repository);

        $repositoryRef = $this->getHiddenProperty($useCase, 'repository');

        $this->assertSame($repository, $repositoryRef->getValue($useCase));
    }

    /**
     * test __invoke method
     *
     * @return void
     */
    public function testInvoke()
    {
        /** @var Mockery\Mock|RackInterface $user */
        $rack = Mockery::mock(RackInterface::class);
        $expected = $rack;

        $userId = 100;
        $paramInput = [
            'name' => 'test input'
        ];
        $input = [
            'user_id' => $userId,
            'name' => 'test input'
        ];

        /** @var Mockery\Mock|UserInterface $user */
        $user = Mockery::mock(UserInterface::class);
        $user->id = $userId;

        /** @var Mockery\Mock|RackRepositoryInterface $repository */
        $repository = Mockery::mock(RackRepositoryInterface::class);
        $repository->shouldReceive('create')->once()->with($input)->andReturn($rack);

        $useCase = new StoreUseCase($repository);

        $this->assertSame($expected, $useCase($user, $paramInput));
    }

    /**
     * test __invoke method with none input
     *
     * @return void
     */
    public function testInvokeWithNone()
    {
        /** @var Mockery\Mock|RackInterface $user */
        $rack = Mockery::mock(RackInterface::class);
        $expected = $rack;

        $userId = 100;
        $input = [
            'user_id' => $userId,
            'name' => null,
        ];

        /** @var Mockery\Mock|UserInterface $user */
        $user = Mockery::mock(UserInterface::class);
        $user->id = $userId;

        /** @var Mockery\Mock|RackRepositoryInterface $repository */
        $repository = Mockery::mock(RackRepositoryInterface::class);
        $repository->shouldReceive('create')->once()->with($input)->andReturn($rack);

        $useCase = new StoreUseCase($repository);

        $this->assertSame($expected, $useCase($user));
    }
}
