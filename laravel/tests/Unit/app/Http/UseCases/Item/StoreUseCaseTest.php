<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Item;

use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Item\StoreUseCaseInterface;
use App\Http\UseCases\Item\StoreUseCase;
use App\Repositories\Contracts\ItemRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class StoreUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Item
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
        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);

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
        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);

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
        /** @var Mockery\Mock|ItemInterface $user */
        $item = Mockery::mock(ItemInterface::class);
        $expected = $item;

        $userId = 100;
        $noteId = 100;
        $body = 'dummy item body';
        $itemData = [
            'body' => $body
        ];
        $createData = [
            'user_id' => $userId,
            'note_id' => $noteId,
            'body' => $body,
        ];

        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);
        $repository->shouldReceive('create')->once()->with($createData)->andReturn($item);

        $useCase = new StoreUseCase($repository);

        $this->assertSame($expected, $useCase($userId, $noteId, $itemData));
    }

    /**
     * test __invoke method with none input
     *
     * @return void
     */
    public function testInvokeWithItemDataIsNone()
    {
        /** @var Mockery\Mock|ItemInterface $user */
        $item = Mockery::mock(ItemInterface::class);
        $expected = $item;

        $userId = 100;
        $noteId = 100;
        $createData = [
            'user_id' => $userId,
            'note_id' => $noteId,
            'body' => null,
        ];

        /** @var Mockery\Mock|UserInterface $user */
        $user = Mockery::mock(UserInterface::class);
        $user->id = $userId;

        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);
        $repository->shouldReceive('create')->once()->with($createData)->andReturn($item);

        $useCase = new StoreUseCase($repository);

        $this->assertSame($expected, $useCase($userId, $noteId));
    }
}
