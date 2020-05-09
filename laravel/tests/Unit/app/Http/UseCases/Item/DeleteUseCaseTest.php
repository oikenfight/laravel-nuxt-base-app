<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Item;

use App\Http\UseCases\Contracts\Item\DeleteUseCaseInterface;
use App\Http\UseCases\Item\DeleteUseCase;
use App\Repositories\Contracts\ItemRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class DeleteUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Item
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
        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);

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
        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);

        $useCase = new DeleteUseCase($repository);

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
        $expected = true;
        $itemId = 100;

        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);
        $repository->shouldReceive('delete')->once()->with($itemId)->andReturn(true);

        $useCase = new DeleteUseCase($repository);

        $this->assertSame($expected, $useCase($itemId));
    }
}
