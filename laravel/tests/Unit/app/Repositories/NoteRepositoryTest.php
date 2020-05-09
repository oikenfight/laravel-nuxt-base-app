<?php
declare(strict_types=1);

namespace Tests\Unit\app\Repositories;

use App\Entities\Contracts\NoteInterface;
use App\Repositories\NoteRepository;
use App\Repositories\Contracts\NoteRepositoryInterface;
use App\Repositories\Exceptions\NoteNotFoundException;
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
 * Class NoteRepositoryTest
 *
 * @package Tests\Unit\app\Repositories
 */
final class NoteRepositoryTest extends TestCase
{
    /**
     * test instance of.
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $repository = app(NoteRepository::class);

        $this->assertInstanceOf(NoteRepositoryInterface::class, $repository);
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

        /** @var Mockery\Mock|NoteInterface $eloquent */
        $eloquent = Mockery::mock(NoteInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($query);

        $repository = new NoteRepository($eloquent);

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

        /** @var Mockery\Mock|NoteInterface $eloquent */
        $eloquent = Mockery::mock(NoteInterface::class);
        // construct 及び resetQuery で各々 newQuery が呼ばれるので twice
        $eloquent->shouldReceive('newQuery')->twice()->with()->andReturn($expectedQuery);

        $repository = new NoteRepository($eloquent);

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

        /** @var Mockery\Mock|NoteInterface $eloquent */
        $eloquent = Mockery::mock(NoteInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|NoteRepository $repository */
        $repository = Mockery::mock(NoteRepository::class, [$eloquent])->makePartial();

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

        /** @var Mockery\Mock|NoteInterface $eloquent */
        $eloquent = Mockery::mock(NoteInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new NoteRepository($eloquent);

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
            'folder_id' => 'dummy folder_id',
            'name' => 'dummy name',
            'status' => 'dummy status',
            'category_id' => 'dummy category_id',
        ];
        $eloquentInputs = [
            'user_id' => 'dummy user_id',
            'folder_id' => 'dummy folder_id',
            'name' => 'dummy name',
            'status' => 'dummy status',
            'category_id' => 'dummy category_id',
        ];

        /** @var Mockery\Mock|NoteInterface $createdNote */
        $createdNote = Mockery::mock(NoteInterface::class);
        $createdNote->shouldReceive('save')->once()->with()->andReturn(true);

        /** @var Mockery\Mock|NoteInterface $eloquent */
        $eloquent = Mockery::mock(NoteInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with();
        $eloquent->shouldReceive('newInstance')->once()->with($eloquentInputs)->andReturn($createdNote);

        $repository = new NoteRepository($eloquent);

        $this->assertSame($createdNote, $repository->create($inputs));
    }

    /**
     * test find method.
     *
     * @throws \App\Repositories\Exceptions\NoteNotFoundException
     *
     * @return void
     */
    public function testFind()
    {
        // conditions
        $noteId = 999;

        /** @var Mockery\Mock|NoteInterface */
        $foundNote = Mockery::mock(NoteInterface::class);

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($noteId)->andReturn($foundNote);

        /** @var Mockery\Mock|NoteInterface $note */
        $note = Mockery::mock(NoteInterface::class);
        $note->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|NoteRepository $repository */
        $repository = Mockery::mock(NoteRepository::class, [$note])->makePartial()->shouldAllowMockingProtectedMethods();

        $this->assertSame($foundNote, $repository->find($noteId));
    }

    /**
     * test find method. not found case.
     *
     * @throws NoteNotFoundException
     *
     * @return void
     */
    public function testFindNotFoundCase()
    {
        // conditions
        $noteId = 2;
        $this->expectException(NoteNotFoundException::class);

        $foundNote = null;

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($noteId)->andReturn($foundNote);

        /** @var Mockery\Mock|NoteInterface $note */
        $note = Mockery::mock(NoteInterface::class);
        $note->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|NoteRepository $repository */
        $repository = Mockery::mock(NoteRepository::class, [$note])->makePartial()->shouldAllowMockingProtectedMethods();

        $this->assertSame($foundNote, $repository->find($noteId));
    }

    /**
     * test update method.
     *
     * @throws NoteNotFoundException
     *
     * @return void
     */
    public function testUpdate()
    {
        // conditions
        $noteId = 999;
        $inputs = [
            'folder_id' => 'dummy folder_id',
            'name' => 'dummy name',
            'status' => 'dummy status',
            'category_id' => 'dummy category_id',
        ];
        $eloquentInputs = [
            'folder_id' => 'dummy folder_id',
            'name' => 'dummy name',
            'status' => 'dummy status',
            'category_id' => 'dummy category_id',
        ];

        /** @var Mockery\Mock|NoteInterface $updatedNote */
        $updatedNote = Mockery::mock(NoteInterface::class);
        $updatedNote->shouldReceive('update')->once()->with($eloquentInputs)->andReturn($updatedNote);

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($noteId)->andReturn($updatedNote);

        /** @var Mockery\Mock|NoteInterface $note */
        $note = Mockery::mock(NoteInterface::class);
        $note->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new NoteRepository($note);

        $this->assertSame($updatedNote, $repository->update($noteId, $inputs));
    }

    /**
     * test update method with not found case
     *
     * @throws NoteNotFoundException
     *
     * @return void
     */
    public function testUpdateNotFoundCase()
    {
        // conditions
        $noteId = 999;
        $this->expectException(NoteNotFoundException::class);
        $inputs = [
            'user_id' => 'dummy user_id',
            'folder_id' => 'dummy folder_id',
            'name' => 'dummy name',
            'status' => 'dummy status',
            'category_id' => 'dummy category_id',
        ];

        /** @var Mockery\Mock|NoteInterface $updatedNote */
        $updatedNote = Mockery::mock(NoteInterface::class);
        $updatedNote->shouldReceive('update')->never();

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($noteId)->andReturn(null);

        /** @var Mockery\Mock|NoteInterface $note */
        $note = Mockery::mock(NoteInterface::class);
        $note->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new NoteRepository($note);

        $this->assertSame($updatedNote, $repository->update($noteId, $inputs));
    }

    /**
     * test delete method.
     *
     * @throws NoteNotFoundException
     * @throws \Exception
     * @return void
     */
    public function testDelete()
    {
        // conditions
        $noteId = 999;
        $deleteResult = true;

        /** @var Mockery\Mock|NoteInterface $foundNote */
        $foundNote = Mockery::mock(NoteInterface::class);
        $foundNote->shouldReceive('delete')->once()->with()->andReturn($deleteResult);

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($noteId)->andReturn($foundNote);

        /** @var Mockery\Mock|NoteInterface $note */
        $note = Mockery::mock(NoteInterface::class);
        $note->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new NoteRepository($note);

        $this->assertTrue($repository->delete($noteId));
    }

    /**
     * test delete method, not found case.
     *
     * @throws NoteNotFoundException
     * @throws \Exception
     * @return void
     */
    public function testDeleteNotFoundCase()
    {
        // conditions
        $noteId = 2;
        $this->expectException(NoteNotFoundException::class);

        $foundNote = null;

        /** @var Mockery\Mock|Builder $builder */
        $builder = Mockery::mock(Builder::class);
        $builder->shouldReceive('find')->once()->with($noteId)->andReturn($foundNote);

        /** @var Mockery\Mock|NoteInterface $note */
        $note = Mockery::mock(NoteInterface::class);
        $note->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new NoteRepository($note);

        $repository->delete($noteId);
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

        /** @var Mockery\Mock|NoteInterface $eloquent */
        $eloquent = Mockery::mock(NoteInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        /** @var Mockery\Mock|NoteRepository $repository */
        $repository = Mockery::mock(NoteRepository::class, [$eloquent])->makePartial()->shouldAllowMockingProtectedMethods();
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
//        /** @var Mockery\Mock|NoteInterface $eloquent */
//        $eloquent = Mockery::mock(NoteInterface::class);
//        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($query);
//
//        /** @var Mockery\Mock|FilterInterface $filter */
//        $filter = Mockery::mock(FilterInterface::class);
//        $filter->shouldReceive('apply')->once()->with($query);
//
//        $repository = new NoteRepository($eloquent);
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

        /** @var Mockery\Mock|NoteInterface $eloquent */
        $eloquent = Mockery::mock(NoteInterface::class);
        $eloquent->shouldReceive('newQuery')->once()->with()->andReturn($builder);

        $repository = new NoteRepository($eloquent);

        $this->assertSame($expected, $repository->count());
    }
}
