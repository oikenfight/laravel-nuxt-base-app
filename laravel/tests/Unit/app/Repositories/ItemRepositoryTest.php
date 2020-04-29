<?php
declare(strict_types=1);

namespace Tests\Unit\app\Repositories;

use App\Entities\Contracts\ItemInterface;
use App\Repositories\ItemRepository;
use App\Repositories\Contracts\ItemRepositoryInterface;
use App\Repositories\Exceptions\ItemNotFoundException;
use App\Repositories\Filters\Contracts\FilterInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mockery;
use Tests\Unit\TestCase;

// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ItemRepositoryTest
 *
 * @package Tests\Unit\app\Repositories
 */
final class ItemRepositoryTest extends TestCase
{
    /**
     * test instance of.
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $repository = app(ItemRepository::class);

        $this->assertInstanceOf(ItemRepositoryInterface::class, $repository);
    }

    /**
     * test construct method and props.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testConstruct()
    {
        /** @var Mockery\Mock|Builder $query */
        $query = Mockery::mock(Builder::class);

        /** @var Mockery\Mock|ItemInterface $eloquent */
        $eloquent = Mockery::mock(ItemInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($query);

        $repository = new ItemRepository($eloquent);

        $eloquentRef = $this->getHiddenProperty($repository, 'eloquent');
        $queryRef = $this->getHiddenProperty($repository, 'query');

        $this->assertSame($eloquent, $eloquentRef->getValue($repository));
        $this->assertSame($query, $queryRef->getValue($repository));
    }

    /**
     * test resetQuery method.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testResetQuery()
    {
        // expected
        $expectedQuery = 'new query';

        /** @var Mockery\Mock|ItemInterface $eloquent */
        $eloquent = Mockery::mock(ItemInterface::class);
        // construct 及び resetQuery で各々 newQuery が呼ばれるので twice
        $eloquent->shouldReceive('newQuery')->twice()->with()->andReturn($expectedQuery);

        $repository = new ItemRepository($eloquent);

        $this->assertSame($repository, $repository->resetQuery());

        $queryRef = $this->getHiddenProperty($repository, 'query');
        $this->assertSame($expectedQuery, $queryRef->getValue($repository));
    }

    /**
     * test orderBy method.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testOrderBy()
    {
        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('orderBy')->once()->with('order_index');

        /** @var Mockery\Mock|ItemInterface $eloquent */
        $eloquent = Mockery::mock(ItemInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|ItemRepository $repository */
        $repository = Mockery::mock(ItemRepository::class, [$eloquent])->makePartial();

        $this->callHiddenMethod($repository, 'orderBy');
    }

    /**
     * test totalCount method.
     *
     * @return void
     */
    public function testTotalCount()
    {
        // conditions
        $expected = 2;

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('count')->once()->with(['id'])->andReturn($expected);

        /** @var Mockery\Mock|ItemInterface $eloquent */
        $eloquent = Mockery::mock(ItemInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new ItemRepository($eloquent);

        $this->assertSame($expected, $repository->totalCount());
    }

    /**
     * test create method.
     *
     * @return void
     */
    public function testCreate()
    {
        $inputs = [
            'user_id' => 'dummy user_id',
            'note_id' => 'dummy note_id',
            'body' => 'dummy body',
            'order_index' => 'dummy order_index',
        ];
        $eloquentInputs = [
            'user_id' => 'dummy user_id',
            'note_id' => 'dummy note_id',
            'body' => 'dummy body',
            'order_index' => 'dummy order_index',
        ];

        /** @var Mockery\Mock|ItemInterface $createdItem */
        $createdItem = Mockery::mock(ItemInterface::class);
        $createdItem->shouldReceive('save')->once()->with()->andReturn(true);

        /** @var Mockery\Mock|ItemInterface $eloquent */
        $eloquent = Mockery::mock(ItemInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with();
        $eloquent->shouldReceive('newInstance')->once()->with($eloquentInputs)->andReturn($createdItem);

        $repository = new ItemRepository($eloquent);

        $this->assertSame($createdItem, $repository->create($inputs));
    }

    /**
     * test find method.
     *
     * @throws \App\Repositories\Exceptions\ItemNotFoundException
     *
     * @return void
     */
    public function testFind()
    {
        // conditions
        $itemId = 999;

        /** @var Mockery\Mock|ItemInterface */
        $foundItem = Mockery::mock(ItemInterface::class);

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($itemId)->andReturn($foundItem);

        /** @var Mockery\Mock|ItemInterface $item */
        $item = Mockery::mock(ItemInterface::class);
        $item->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|ItemRepository $repository */
        $repository = Mockery::mock(ItemRepository::class, [$item])->makePartial()->shouldAllowMockingProtectedMethods();

        $this->assertSame($foundItem, $repository->find($itemId));
    }

    /**
     * test find method. not found case.
     *
     * @throws ItemNotFoundException
     *
     * @return void
     */
    public function testFindNotFoundCase()
    {
        // conditions
        $itemId = 2;
        $this->expectException(ItemNotFoundException::class);

        $foundItem = null;

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($itemId)->andReturn($foundItem);

        /** @var Mockery\Mock|ItemInterface $item */
        $item = Mockery::mock(ItemInterface::class);
        $item->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|ItemRepository $repository */
        $repository = Mockery::mock(ItemRepository::class, [$item])->makePartial()->shouldAllowMockingProtectedMethods();

        $this->assertSame($foundItem, $repository->find($itemId));
    }

    /**
     * test update method.
     *
     * @throws ItemNotFoundException
     *
     * @return void
     */
    public function testUpdate()
    {
        // conditions
        $itemId = 999;
        $inputs = [
            'note_id' => 'dummy note_id',
            'body' => 'dummy body',
            'order_index' => 'dummy order_index',
        ];
        $eloquentInputs = [
            'note_id' => 'dummy note_id',
            'body' => 'dummy body',
            'order_index' => 'dummy order_index',
        ];

        /** @var Mockery\Mock|ItemInterface $updatedItem */
        $updatedItem = Mockery::mock(ItemInterface::class);
        $updatedItem->shouldReceive('update')->once()->with($eloquentInputs)->andReturn($updatedItem);

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($itemId)->andReturn($updatedItem);

        /** @var Mockery\Mock|ItemInterface $item */
        $item = Mockery::mock(ItemInterface::class);
        $item->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new ItemRepository($item);

        $this->assertSame($updatedItem, $repository->update($itemId, $inputs));
    }

    /**
     * test update method with not found case
     *
     * @throws ItemNotFoundException
     *
     * @return void
     */
    public function testUpdateNotFoundCase()
    {
        // conditions
        $itemId = 999;
        $this->expectException(ItemNotFoundException::class);
        $inputs = [
            'note_id' => 'dummy note_id',
            'body' => 'dummy body',
            'order_index' => 'dummy order_index',
        ];

        /** @var Mockery\Mock|ItemInterface $updatedItem */
        $updatedItem = Mockery::mock(ItemInterface::class);
        $updatedItem->shouldReceive('update')->never();

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($itemId)->andReturn(null);

        /** @var Mockery\Mock|ItemInterface $item */
        $item = Mockery::mock(ItemInterface::class);
        $item->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new ItemRepository($item);

        $this->assertSame($updatedItem, $repository->update($itemId, $inputs));
    }

    /**
     * test delete method.
     *
     * @throws ItemNotFoundException
     * @throws \Exception
     * @return void
     */
    public function testDelete()
    {
        // conditions
        $itemId = 999;
        $deleteResult = true;

        /** @var Mockery\Mock|ItemInterface $foundItem */
        $foundItem = Mockery::mock(ItemInterface::class);
        $foundItem->shouldReceive('delete')->once()->with()->andReturn($deleteResult);

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($itemId)->andReturn($foundItem);

        /** @var Mockery\Mock|ItemInterface $item */
        $item = Mockery::mock(ItemInterface::class);
        $item->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new ItemRepository($item);

        $this->assertTrue($repository->delete($itemId));
    }

    /**
     * test delete method, not found case.
     *
     * @throws ItemNotFoundException
     * @throws \Exception
     * @return void
     */
    public function testDeleteNotFoundCase()
    {
        // conditions
        $itemId = 2;
        $this->expectException(ItemNotFoundException::class);

        $foundItem = null;

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($itemId)->andReturn($foundItem);

        /** @var Mockery\Mock|ItemInterface $item */
        $item = Mockery::mock(ItemInterface::class);
        $item->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new ItemRepository($item);

        $repository->delete($itemId);
    }

    /**
     * test all method
     *
     * @return void
     */
    public function testAll()
    {
        /** @var Mockery\Mock|Collection $collection */
        $collection = Mockery::mock(Collection::class);

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('get')->once()->with()->andReturn($collection);

        /** @var Mockery\Mock|ItemInterface $eloquent */
        $eloquent = Mockery::mock(ItemInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|ItemRepository $repository */
        $repository = Mockery::mock(ItemRepository::class, [$eloquent])->makePartial()->shouldAllowMockingProtectedMethods();
        $repository->shouldReceive('orderBy')->once()->with()->andReturn($repository);

        $this->assertSame($collection, $repository->all());
    }

//    /**
//     * test filter method.
//     *
//     * @return void
//     */
//    public function testFilter()
//    {
//        /** @var Mockery\Mock|\Illuminate\Database\Eloquent\Builder $query */
//        $query = Mockery::mock(\Illuminate\Database\Eloquent\Builder::class);
//
//        /** @var Mockery\Mock|ItemInterface $eloquent */
//        $eloquent = Mockery::mock(ItemInterface::class);
//        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($query);
//
//        /** @var Mockery\Mock|FilterInterface $filter */
//        $filter = Mockery::mock(FilterInterface::class);
//        $filter->shouldReceive('apply')->once()->with($query);
//
//        $repository = new ItemRepository($eloquent);
//
//        $this->assertSame($repository, $repository->filtering($filter));
//    }

    /**
     * test count method.
     *
     * @return void
     */
    public function testCount()
    {
        // conditions
        $expected = 2;

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('count')->once()->with(['id'])->andReturn($expected);

        /** @var Mockery\Mock|ItemInterface $eloquent */
        $eloquent = Mockery::mock(ItemInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new ItemRepository($eloquent);

        $this->assertSame($expected, $repository->count());
    }
}
