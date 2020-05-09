<?php
declare(strict_types=1);

namespace Tests\Unit\app\Repositories;

use App\Entities\Contracts\RackInterface;
use App\Repositories\RackRepository;
use App\Repositories\Contracts\RackRepositoryInterface;
use App\Repositories\Exceptions\RackNotFoundException;
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
 * Class RackRepositoryTest
 *
 * @package Tests\Unit\app\Repositories
 */
final class RackRepositoryTest extends TestCase
{
    /**
     * test instance of.
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $repository = app(RackRepository::class);

        $this->assertInstanceOf(RackRepositoryInterface::class, $repository);
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

        /** @var Mockery\Mock|RackInterface $eloquent */
        $eloquent = Mockery::mock(RackInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($query);

        $repository = new RackRepository($eloquent);

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

        /** @var Mockery\Mock|RackInterface $eloquent */
        $eloquent = Mockery::mock(RackInterface::class);
        // construct 及び resetQuery で各々 newQuery が呼ばれるので twice
        $eloquent->shouldReceive('newQuery')->twice()->with()->andReturn($expectedQuery);

        $repository = new RackRepository($eloquent);

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
        $builder->shouldReceive('orderBy')->once()->with('updated_at');

        /** @var Mockery\Mock|RackInterface $eloquent */
        $eloquent = Mockery::mock(RackInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|RackRepository $repository */
        $repository = Mockery::mock(RackRepository::class, [$eloquent])->makePartial();

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

        /** @var Mockery\Mock|RackInterface $eloquent */
        $eloquent = Mockery::mock(RackInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new RackRepository($eloquent);

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
            'name' => 'dummy name',
        ];
        $eloquentInputs = [
            'user_id' => 'dummy user_id',
            'name' => 'dummy name',
        ];

        /** @var Mockery\Mock|RackInterface $createdRack */
        $createdRack = Mockery::mock(RackInterface::class);
        $createdRack->shouldReceive('save')->once()->with()->andReturn(true);

        /** @var Mockery\Mock|RackInterface $eloquent */
        $eloquent = Mockery::mock(RackInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with();
        $eloquent->shouldReceive('newInstance')->once()->with($eloquentInputs)->andReturn($createdRack);

        $repository = new RackRepository($eloquent);

        $this->assertSame($createdRack, $repository->create($inputs));
    }

    /**
     * test find method.
     *
     * @throws \App\Repositories\Exceptions\RackNotFoundException
     *
     * @return void
     */
    public function testFind()
    {
        // conditions
        $rackId = 999;

        /** @var Mockery\Mock|RackInterface */
        $foundRack = Mockery::mock(RackInterface::class);

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($rackId)->andReturn($foundRack);

        /** @var Mockery\Mock|RackInterface $rack */
        $rack = Mockery::mock(RackInterface::class);
        $rack->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|RackRepository $repository */
        $repository = Mockery::mock(RackRepository::class, [$rack])->makePartial()->shouldAllowMockingProtectedMethods();

        $this->assertSame($foundRack, $repository->find($rackId));
    }

    /**
     * test find method. not found case.
     *
     * @throws RackNotFoundException
     *
     * @return void
     */
    public function testFindNotFoundCase()
    {
        // conditions
        $rackId = 2;
        $this->expectException(RackNotFoundException::class);

        $foundRack = null;

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($rackId)->andReturn($foundRack);

        /** @var Mockery\Mock|RackInterface $rack */
        $rack = Mockery::mock(RackInterface::class);
        $rack->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|RackRepository $repository */
        $repository = Mockery::mock(RackRepository::class, [$rack])->makePartial()->shouldAllowMockingProtectedMethods();

        $this->assertSame($foundRack, $repository->find($rackId));
    }

    /**
     * test update method.
     *
     * @throws RackNotFoundException
     *
     * @return void
     */
    public function testUpdate()
    {
        // conditions
        $rackId = 999;
        $inputs = [
            'name' => 'dummy name',
        ];
        $eloquentInputs = [
            'name' => 'dummy name',
        ];

        /** @var Mockery\Mock|RackInterface $updatedRack */
        $updatedRack = Mockery::mock(RackInterface::class);
        $updatedRack->shouldReceive('update')->once()->with($eloquentInputs)->andReturn($updatedRack);

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($rackId)->andReturn($updatedRack);

        /** @var Mockery\Mock|RackInterface $rack */
        $rack = Mockery::mock(RackInterface::class);
        $rack->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new RackRepository($rack);

        $this->assertSame($updatedRack, $repository->update($rackId, $inputs));
    }

    /**
     * test update method with not found case
     *
     * @throws RackNotFoundException
     *
     * @return void
     */
    public function testUpdateNotFoundCase()
    {
        // conditions
        $rackId = 999;
        $this->expectException(RackNotFoundException::class);
        $inputs = [
            'user_id' => 'dummy user_id',
            'name' => 'dummy name',
        ];

        /** @var Mockery\Mock|RackInterface $updatedRack */
        $updatedRack = Mockery::mock(RackInterface::class);
        $updatedRack->shouldReceive('update')->never();

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($rackId)->andReturn(null);

        /** @var Mockery\Mock|RackInterface $rack */
        $rack = Mockery::mock(RackInterface::class);
        $rack->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new RackRepository($rack);

        $this->assertSame($updatedRack, $repository->update($rackId, $inputs));
    }

    /**
     * test delete method.
     *
     * @throws RackNotFoundException
     * @throws \Exception
     * @return void
     */
    public function testDelete()
    {
        // conditions
        $rackId = 999;
        $deleteResult = true;

        /** @var Mockery\Mock|RackInterface $foundRack */
        $foundRack = Mockery::mock(RackInterface::class);
        $foundRack->shouldReceive('delete')->once()->with()->andReturn($deleteResult);

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($rackId)->andReturn($foundRack);

        /** @var Mockery\Mock|RackInterface $rack */
        $rack = Mockery::mock(RackInterface::class);
        $rack->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new RackRepository($rack);

        $this->assertTrue($repository->delete($rackId));
    }

    /**
     * test delete method, not found case.
     *
     * @throws RackNotFoundException
     * @throws \Exception
     * @return void
     */
    public function testDeleteNotFoundCase()
    {
        // conditions
        $rackId = 2;
        $this->expectException(RackNotFoundException::class);

        $foundRack = null;

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($rackId)->andReturn($foundRack);

        /** @var Mockery\Mock|RackInterface $rack */
        $rack = Mockery::mock(RackInterface::class);
        $rack->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new RackRepository($rack);

        $repository->delete($rackId);
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

        /** @var Mockery\Mock|RackInterface $eloquent */
        $eloquent = Mockery::mock(RackInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|RackRepository $repository */
        $repository = Mockery::mock(RackRepository::class, [$eloquent])->makePartial()->shouldAllowMockingProtectedMethods();
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
//        /** @var Mockery\Mock|RackInterface $eloquent */
//        $eloquent = Mockery::mock(RackInterface::class);
//        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($query);
//
//        /** @var Mockery\Mock|FilterInterface $filter */
//        $filter = Mockery::mock(FilterInterface::class);
//        $filter->shouldReceive('apply')->once()->with($query);
//
//        $repository = new RackRepository($eloquent);
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

        /** @var Mockery\Mock|RackInterface $eloquent */
        $eloquent = Mockery::mock(RackInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new RackRepository($eloquent);

        $this->assertSame($expected, $repository->count());
    }
}
