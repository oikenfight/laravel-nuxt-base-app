<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Item;

use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Item\FindUseCaseInterface;
use App\Http\UseCases\Item\FindUseCase;
use App\Repositories\Contracts\ItemRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class FindUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Item
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
        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);

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
        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);

        $useCase = new FindUseCase($repository);

        $repositoryRef = $this->getHiddenProperty($useCase, 'repository');

        $this->assertSame($repository, $repositoryRef->getValue($useCase));
    }

    /**
     * test __invoke method
     *
     * @return void
     * @throws \App\Repositories\Exceptions\ItemNotFoundException
     */
    public function testInvoke()
    {
        /** @var Mockery\Mock|ItemInterface $user */
        $item = Mockery::mock(ItemInterface::class);
        $expected = $item;

        $itemId = 100;

        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);
        $repository->shouldReceive('find')->once()->with($itemId)->andReturn($item);

        $useCase = new FindUseCase($repository);

        $this->assertSame($expected, $useCase($itemId));
    }
}
