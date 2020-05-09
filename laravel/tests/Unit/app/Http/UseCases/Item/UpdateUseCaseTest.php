<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Item;

use App\Entities\Contracts\ItemInterface;
use App\Http\UseCases\Contracts\Item\UpdateUseCaseInterface;
use App\Http\UseCases\Item\UpdateUseCase;
use App\Repositories\Contracts\ItemRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class UpdateUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Item
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
        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);

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
        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);

        $useCase = new UpdateUseCase($repository);

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
        $noteId = 100;
        $body = 'dummy item body';
        $itemData = [
            'note_id' => $noteId,
            'body' => $body,
        ];
        $updateData = [
            'note_id' => $noteId,
            'body' => $body,
        ];

        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);
        $repository->shouldReceive('update')->once()->with($itemId, $updateData)->andReturn($item);

        $useCase = new UpdateUseCase($repository);

        $this->assertSame($expected, $useCase($itemId, $itemData));
    }

    /**
     * test __invoke method
     *
     * @return void
     * @throws \App\Repositories\Exceptions\ItemNotFoundException
     */
    public function testInvokeWithNullItemBody()
    {
        /** @var Mockery\Mock|ItemInterface $user */
        $item = Mockery::mock(ItemInterface::class);
        $expected = $item;

        $itemId = 100;
        $noteId = 100;
        $itemData = [
            'note_id' => $noteId,
            'body' => null,
        ];
        $updateData = [
            'note_id' => $noteId,
            'body' => '',
        ];

        /** @var Mockery\Mock|ItemRepositoryInterface $repository */
        $repository = Mockery::mock(ItemRepositoryInterface::class);
        $repository->shouldReceive('update')->once()->with($itemId, $updateData)->andReturn($item);

        $useCase = new UpdateUseCase($repository);

        $this->assertSame($expected, $useCase($itemId, $itemData));
    }
}
