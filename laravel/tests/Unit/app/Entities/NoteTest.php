<?php
declare(strict_types=1);

namespace Tests\Unit\app\Entities;

use App\Entities\Contracts\NoteInterface;
use App\Entities\Folder;
use App\Entities\Item;
use App\Entities\Note;
use App\Entities\Entity;
use App\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class NoteTest
 *
 * @package Tests\Unit\app\Entities
 */
final class NoteTest extends TestCase
{
    /**
     * instance of
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $note = new Note();

        $this->assertInstanceOf(Entity::class, $note);
        $this->assertInstanceOf(NoteInterface::class, $note);
    }

    /**
     * test $table property.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testTableProperty()
    {
        $note = new Note();

        $tableRef = $this->getHiddenProperty($note, 'table');
        $this->assertSame('notes', $tableRef->getValue($note));
    }

    /**
     * test $fillable property
     *
     * @throws \ReflectionException
     * @return void
     */
    public function testFillableProperty()
    {
        $note = new Note();

        $fillableRef = $this->getHiddenProperty($note, 'fillable');
        $this->assertSame(
            [
                'user_id',
                'folder_id',
                'name',
                'status',
                'category_id'
            ],
            $fillableRef->getValue($note)
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
        $note = new Note();

        $hiddenRef = $this->getHiddenProperty($note, 'hidden');
        $this->assertSame(
            [],
            $hiddenRef->getValue($note)
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
        $note = new Note();

        $castsRef = $this->getHiddenProperty($note, 'casts');
        $this->assertSame(
            [
                'user_id' => 'int',
                'folder_id' => 'int',
                'name' => 'string',
                'status' => 'int',
            ],
            $castsRef->getValue($note)
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
        $note = new Note();

        $datesRef = $this->getHiddenProperty($note, 'dates');
        $this->assertSame(
            [
                'created_at',
                'updated_at',
                'deleted_at',
            ],
            $datesRef->getValue($note)
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
        $note = new Note();

        $appendsRef = $this->getHiddenProperty($note, 'appends');
        $this->assertSame(
            [
                'item_ids',
            ],
            $appendsRef->getValue($note)
        );
    }

    /**
     * test getItemIdAttribute method
     *
     * @return void
     */
    public function testGetItemIdsAttribute()
    {
        $arrayItemIds = ['dummy item ids'];

        /** @var Mockery\Mock|Collection $collection */
        $collection = Mockery::mock(Collection::class);
        $collection->shouldReceive('sortBy')->with('order_index')->once()->andReturn($collection);
        $collection->shouldReceive('pluck')->with('id')->once()->andReturn($collection);
        $collection->shouldReceive('toArray')->with()->once()->andReturn($arrayItemIds);

        /** @var Mockery\Mock|HasMany $hasMany */
        $hasMany = Mockery::mock(HasMany::class);
        $hasMany->shouldReceive('get')->with()->once()->andReturn($collection);

        /** @var Mockery\Mock|Note $note */
        $note = Mockery::mock(Note::class)->makePartial();
        $note->shouldReceive('items')->with()->once()->andReturn($hasMany);

        $note->getItemIdsAttribute();
    }

    /**
     * test item_ids property
     *
     * @return void
     */
    public function testItemIdsProperty()
    {
        $arrayItemIds = ['dummy item ids'];
        $expected = $arrayItemIds;

        /** @var Mockery\Mock|Collection $collection */
        $collection = Mockery::mock(Collection::class);
        $collection->shouldReceive('sortBy')->with('order_index')->once()->andReturn($collection);
        $collection->shouldReceive('pluck')->with('id')->once()->andReturn($collection);
        $collection->shouldReceive('toArray')->with()->once()->andReturn($arrayItemIds);

        /** @var Mockery\Mock|HasMany $hasMany */
        $hasMany = Mockery::mock(HasMany::class);
        $hasMany->shouldReceive('get')->with()->once()->andReturn($collection);

        /** @var Mockery\Mock|Note $note */
        $note = Mockery::mock(Note::class)->makePartial();
        $note->shouldReceive('items')->with()->once()->andReturn($hasMany);

        $this->assertSame($expected, $note->item_ids);
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

        /** @var Mockery\Mock | Note $note */
        $note = Mockery::mock(Note::class)->makePartial();
        $note->shouldReceive('belongsTo')->once()->with(User::class)->andReturn($belongsTo);

        $note->user();
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

        /** @var Mockery\Mock|Note $note */
        $note = Mockery::mock(Note::class)->makePartial();
        $note->shouldReceive('belongsTo')->once()->with(User::class)->andReturn($relation);

        $this->assertSame($item, $note->user);
    }

    /**
     * test folder method
     *
     * @return void
     */
    public function testFolder()
    {
        /** @var Mockery\Mock $belongsTo */
        $belongsTo = Mockery::mock(\Illuminate\Database\Eloquent\Relations\belongsTo::class);

        /** @var Mockery\Mock | Note $note */
        $note = Mockery::mock(Note::class)->makePartial();
        $note->shouldReceive('belongsTo')->once()->with(Folder::class)->andReturn($belongsTo);

        $note->folder();
    }

    /**
     * test folder property.
     *
     * @return void
     */
    public function testFolderProperty()
    {
        /** @var Mockery\Mock $item */
        $item = Mockery::mock(User::class);

        /** @var Mockery\Mock $relation */
        $relation = Mockery::mock(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
        $relation->shouldReceive('getResults')->once()->with()->andReturn($item);

        /** @var Mockery\Mock|Note $note */
        $note = Mockery::mock(Note::class)->makePartial();
        $note->shouldReceive('belongsTo')->once()->with(Folder::class)->andReturn($relation);

        $this->assertSame($item, $note->folder);
    }

    /**
     * test items methods
     *
     * @return void
     */
    public function testItems()
    {
        /** @var Mockery\Mock $hasMany */
        $hasMany = Mockery::mock(\Illuminate\Database\Eloquent\Relations\HasMany::class);

        /** @var Mockery\Mock|Note $note */
        $note = Mockery::mock(Note::class)->makePartial();
        $note->shouldReceive('hasMany')->once()->with(Item::class)->andReturn($hasMany);

        $note->items();
    }

    /**
     * test items property.
     *
     * @return void
     */
    public function testItemsProperty()
    {
        /** @var Mockery\Mock $collection */
        $collection = Mockery::mock(Collection::class);

        /** @var Mockery\Mock $relation */
        $relation = Mockery::mock(\Illuminate\Database\Eloquent\Relations\HasMany::class);
        $relation->shouldReceive('getResults')->once()->with()->andReturn($collection);

        /** @var Mockery\Mock|Note $note */
        $note = Mockery::mock(Note::class)->makePartial();
        $note->shouldReceive('hasMany')->once()->with(Item::class)->andReturn($relation);

        $this->assertSame($collection, $note->items);
    }
}
