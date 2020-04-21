<?php
declare(strict_types=1);

namespace Tests\Unit\app\Entities;

use App\Entities\Contracts\RackInterface;
use App\Entities\Folder;
use App\Entities\Rack;
use App\Entities\Entity;
use App\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mockery;
use Tests\Unit\TestCase;

// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class RackTest
 *
 * @package Tests\Unit\app\Entities
 */
final class RackTest extends TestCase
{
    /**
     * instance of
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $rack = new Rack();

        $this->assertInstanceOf(Entity::class, $rack);
        $this->assertInstanceOf(RackInterface::class, $rack);
    }

    /**
     * test $table property.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testTableProperty()
    {
        $rack = new Rack();

        $tableRef = $this->getHiddenProperty($rack, 'table');
        $this->assertSame('racks', $tableRef->getValue($rack));
    }

    /**
     * test $fillable property
     *
     * @throws \ReflectionException
     * @return void
     */
    public function testFillableProperty()
    {
        $rack = new Rack();

        $fillableRef = $this->getHiddenProperty($rack, 'fillable');
        $this->assertSame(
            [
                'user_id',
                'name',
            ],
            $fillableRef->getValue($rack)
        );
    }

    /**
     * test $hidden property.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testHiddenProperty ()
    {
        $rack = new Rack();

        $hiddenRef = $this->getHiddenProperty($rack, 'hidden');
        $this->assertSame(
            [],
            $hiddenRef->getValue($rack)
        );
    }

    /**
     * test $casts property.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testCastsProperty()
    {
        $rack = new Rack();

        $castsRef = $this->getHiddenProperty($rack, 'casts');
        $this->assertSame(
            [
                'user_id' => 'int',
                'name' => 'string',
            ],
            $castsRef->getValue($rack)
        );
    }

    /**
     * test $dates property.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testDatesProperty()
    {
        $rack = new Rack();

        $datesRef = $this->getHiddenProperty($rack, 'dates');
        $this->assertSame(
            [
                'created_at',
                'updated_at',
                'deleted_at',
            ],
            $datesRef->getValue($rack)
        );
    }

    /**
     * test $appends property.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testAppendsProperty()
    {
        $rack = new Rack();

        $appendsRef = $this->getHiddenProperty($rack, 'appends');
        $this->assertSame(
            [
                'folder_ids',
            ],
            $appendsRef->getValue($rack)
        );
    }

    /**
     * test getFolderIdAttribute method
     *
     * @return void
     */
    public function testGetFolderIdsAttribute()
    {
        $arrayFolderIds = ['dummy folder ids'];

        /** @var Mockery\Mock|Collection $collection */
        $collection = Mockery::mock(Collection::class);
        $collection->shouldReceive('pluck')->with('id')->once()->andReturn($collection);
        $collection->shouldReceive('toArray')->with()->once()->andReturn($arrayFolderIds);

        /** @var Mockery\Mock|HasMany $hasMany */
        $hasMany = Mockery::mock(HasMany::class);
        $hasMany->shouldReceive('get')->with()->once()->andReturn($collection);

        /** @var Mockery\Mock|Rack $rack */
        $rack = Mockery::mock(Rack::class)->makePartial();
        $rack->shouldReceive('folders')->with()->once()->andReturn($hasMany);

        $rack->getFolderIdsAttribute();
    }

    /**
     * test folder_ids property
     *
     * @return void
     */
    public function testFolderIdsProperty()
    {
        $arrayFolderIds = ['dummy folder ids'];
        $expected = $arrayFolderIds;

        /** @var Mockery\Mock|Collection $collection */
        $collection = Mockery::mock(Collection::class);
        $collection->shouldReceive('pluck')->with('id')->once()->andReturn($collection);
        $collection->shouldReceive('toArray')->with()->once()->andReturn($arrayFolderIds);

        /** @var Mockery\Mock|HasMany $hasMany */
        $hasMany = Mockery::mock(HasMany::class);
        $hasMany->shouldReceive('get')->with()->once()->andReturn($collection);

        /** @var Mockery\Mock|Rack $rack */
        $rack = Mockery::mock(Rack::class)->makePartial();
        $rack->shouldReceive('folders')->with()->once()->andReturn($hasMany);

        $this->assertSame($expected, $rack->folder_ids);
    }

    /**
     * test user method.
     *
     * @return void
     */
    public function testUser()
    {
        /** @var Mockery\Mock $belongsTo */
        $belongsTo = Mockery::mock(\Illuminate\Database\Eloquent\Relations\belongsTo::class);

        /** @var Mockery\Mock | Rack $rack */
        $rack = Mockery::mock(Rack::class)->makePartial();
        $rack->shouldReceive('belongsTo')->once()->with(User::class)->andReturn($belongsTo);

        $rack->user();
    }

    /**
     * test user property.
     *
     * @return void
     */
    public function testUserProperty()
    {
        /** @var Mockery\Mock $item */
        $item = Mockery::mock(User::class);

        /** @var Mockery\Mock $relation */
        $relation = Mockery::mock(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
        $relation->shouldReceive('getResults')->once()->with()->andReturn($item);

        /** @var Mockery\Mock|Rack $rack */
        $rack = Mockery::mock(Rack::class)->makePartial();
        $rack->shouldReceive('belongsTo')->once()->with(User::class)->andReturn($relation);

        $this->assertSame($item, $rack->user);
    }

    /**
     * test folders methods
     *
     * @return void
     */
    public function testFolders()
    {
        /** @var Mockery\Mock $hasMany */
        $hasMany = Mockery::mock(\Illuminate\Database\Eloquent\Relations\belongsTo::class);

        /** @var Mockery\Mock | Rack $rack */
        $rack = Mockery::mock(Rack::class)->makePartial();
        $rack->shouldReceive('hasMany')->once()->with(Folder::class)->andReturn($hasMany);

        $rack->folders();
    }

    /**
     * test folders property.
     *
     * @return void
     */
    public function testFoldersProperty()
    {
        /** @var Mockery\Mock $collection */
        $collection = Mockery::mock(Collection::class);

        /** @var Mockery\Mock $relation */
        $relation = Mockery::mock(\Illuminate\Database\Eloquent\Relations\HasMany::class);
        $relation->shouldReceive('getResults')->once()->with()->andReturn($collection);

        /** @var Mockery\Mock|Rack $rack */
        $rack = Mockery::mock(Rack::class)->makePartial();
        $rack->shouldReceive('hasMany')->once()->with(Folder::class)->andReturn($relation);

        $this->assertSame($collection, $rack->folders);
    }
}
