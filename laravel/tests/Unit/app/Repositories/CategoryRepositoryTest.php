<?php
declare(strict_types=1);

namespace Tests\Unit\app\Repositories;

use App\Entities\Contracts\CategoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Exceptions\CategoryNotFoundException;
use App\Repositories\Filters\Contracts\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class CategoryRepositoryTest
 *
 * @package Tests\Unit\app\Repositories
 */
final class CategoryRepositoryTest extends TestCase
{
    /**
     * test instance of.
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $repository = app(CategoryRepository::class);

        $this->assertInstanceOf(CategoryRepositoryInterface::class, $repository);
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

        /** @var Mockery\Mock|CategoryInterface $eloquent */
        $eloquent = Mockery::mock(CategoryInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($query);

        $repository = new CategoryRepository($eloquent);

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

        /** @var Mockery\Mock|CategoryInterface $eloquent */
        $eloquent = Mockery::mock(CategoryInterface::class);
        // construct 及び resetQuery で各々 newQuery が呼ばれるので twice
        $eloquent->shouldReceive('newQuery')->twice()->with()->andReturn($expectedQuery);

        $repository = new CategoryRepository($eloquent);

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

        /** @var Mockery\Mock|CategoryInterface $eloquent */
        $eloquent = Mockery::mock(CategoryInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|CategoryRepository $repository */
        $repository = Mockery::mock(CategoryRepository::class, [$eloquent])->makePartial();

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

        /** @var Mockery\Mock|CategoryInterface $eloquent */
        $eloquent = Mockery::mock(CategoryInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new CategoryRepository($eloquent);

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

        /** @var Mockery\Mock|CategoryInterface $createdCategory */
        $createdCategory = Mockery::mock(CategoryInterface::class);
        $createdCategory->shouldReceive('save')->once()->with()->andReturn(true);

        /** @var Mockery\Mock|CategoryInterface $eloquent */
        $eloquent = Mockery::mock(CategoryInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with();
        $eloquent->shouldReceive('newInstance')->once()->with($eloquentInputs)->andReturn($createdCategory);

        $repository = new CategoryRepository($eloquent);

        $this->assertSame($createdCategory, $repository->create($inputs));
    }

    /**
     * test find method.
     *
     * @throws \App\Repositories\Exceptions\CategoryNotFoundException
     *
     * @return void
     */
    public function testFind()
    {
        // conditions
        $categoryId = 999;

        /** @var Mockery\Mock|CategoryInterface */
        $foundCategory = Mockery::mock(CategoryInterface::class);

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($categoryId)->andReturn($foundCategory);

        /** @var Mockery\Mock|CategoryInterface $category */
        $category = Mockery::mock(CategoryInterface::class);
        $category->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|CategoryRepository $repository */
        $repository = Mockery::mock(CategoryRepository::class, [$category])->makePartial()->shouldAllowMockingProtectedMethods();

        $this->assertSame($foundCategory, $repository->find($categoryId));
    }

    /**
     * test find method. not found case.
     *
     * @throws CategoryNotFoundException
     *
     * @return void
     */
    public function testFindNotFoundCase()
    {
        // conditions
        $categoryId = 2;
        $this->expectException(CategoryNotFoundException::class);

        $foundCategory = null;

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($categoryId)->andReturn($foundCategory);

        /** @var Mockery\Mock|CategoryInterface $category */
        $category = Mockery::mock(CategoryInterface::class);
        $category->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|CategoryRepository $repository */
        $repository = Mockery::mock(CategoryRepository::class, [$category])->makePartial()->shouldAllowMockingProtectedMethods();

        $this->assertSame($foundCategory, $repository->find($categoryId));
    }

    /**
     * test update method.
     *
     * @throws CategoryNotFoundException
     *
     * @return void
     */
    public function testUpdate()
    {
        // conditions
        $categoryId = 999;
        $inputs = [
            'name' => 'dummy name',
        ];
        $eloquentInputs = [
            'name' => 'dummy name',
        ];

        /** @var Mockery\Mock|CategoryInterface $updatedCategory */
        $updatedCategory = Mockery::mock(CategoryInterface::class);
        $updatedCategory->shouldReceive('update')->once()->with($eloquentInputs)->andReturn($updatedCategory);

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($categoryId)->andReturn($updatedCategory);

        /** @var Mockery\Mock|CategoryInterface $category */
        $category = Mockery::mock(CategoryInterface::class);
        $category->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new CategoryRepository($category);

        $this->assertSame($updatedCategory, $repository->update($categoryId, $inputs));
    }

    /**
     * test update method with not found case
     *
     * @throws CategoryNotFoundException
     *
     * @return void
     */
    public function testUpdateNotFoundCase()
    {
        // conditions
        $categoryId = 999;
        $this->expectException(CategoryNotFoundException::class);
        $inputs = [
            'name' => 'dummy name',
        ];

        /** @var Mockery\Mock|CategoryInterface $updatedCategory */
        $updatedCategory = Mockery::mock(CategoryInterface::class);
        $updatedCategory->shouldReceive('update')->never();

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($categoryId)->andReturn(null);

        /** @var Mockery\Mock|CategoryInterface $category */
        $category = Mockery::mock(CategoryInterface::class);
        $category->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new CategoryRepository($category);

        $this->assertSame($updatedCategory, $repository->update($categoryId, $inputs));
    }

    /**
     * test delete method.
     *
     * @throws CategoryNotFoundException
     * @throws \Exception
     * @return void
     */
    public function testDelete()
    {
        // conditions
        $categoryId = 999;
        $deleteResult = true;

        /** @var Mockery\Mock|CategoryInterface $foundCategory */
        $foundCategory = Mockery::mock(CategoryInterface::class);
        $foundCategory->shouldReceive('delete')->once()->with()->andReturn($deleteResult);

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($categoryId)->andReturn($foundCategory);

        /** @var Mockery\Mock|CategoryInterface $category */
        $category = Mockery::mock(CategoryInterface::class);
        $category->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new CategoryRepository($category);

        $this->assertTrue($repository->delete($categoryId));
    }

    /**
     * test delete method, not found case.
     *
     * @throws CategoryNotFoundException
     * @throws \Exception
     * @return void
     */
    public function testDeleteNotFoundCase()
    {
        // conditions
        $categoryId = 2;
        $this->expectException(CategoryNotFoundException::class);

        $foundCategory = null;

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($categoryId)->andReturn($foundCategory);

        /** @var Mockery\Mock|CategoryInterface $category */
        $category = Mockery::mock(CategoryInterface::class);
        $category->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new CategoryRepository($category);

        $repository->delete($categoryId);
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

        /** @var Mockery\Mock|CategoryInterface $eloquent */
        $eloquent = Mockery::mock(CategoryInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|CategoryRepository $repository */
        $repository = Mockery::mock(CategoryRepository::class, [$eloquent])->makePartial()->shouldAllowMockingProtectedMethods();
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
//        /** @var Mockery\Mock|CategoryInterface $eloquent */
//        $eloquent = Mockery::mock(CategoryInterface::class);
//        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($query);
//
//        /** @var Mockery\Mock|FilterInterface $filter */
//        $filter = Mockery::mock(FilterInterface::class);
//        $filter->shouldReceive('apply')->once()->with($query);
//
//        $repository = new CategoryRepository($eloquent);
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

        /** @var Mockery\Mock|CategoryInterface $eloquent */
        $eloquent = Mockery::mock(CategoryInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new CategoryRepository($eloquent);

        $this->assertSame($expected, $repository->count());
    }
}
