<?php
declare(strict_types=1);

namespace Tests\Unit\app\Entities;

use App\Entities\Contracts\ItemInterface;
use App\Entities\Item;
use App\Entities\Note;
use App\Entities\Rack;
use App\Entities\Entity;
use App\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Tests\Unit\TestCase;

// use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class CompanyTest
 *
 * @package Tests\Unit\app\Entities
 */
final class ItemTest extends TestCase
{
    /**
     * instance of
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $item = new Item();

        $this->assertInstanceOf(Entity::class, $item);
        $this->assertInstanceOf(ItemInterface::class, $item);
    }

    /**
     * test $table property.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testTableProperty()
    {
        $item = new Item();

        $tableRef = $this->getHiddenProperty($item, 'table');
        $this->assertSame('items', $tableRef->getValue($item));
    }

    /**
     * test $fillable property
     *
     * @throws \ReflectionException
     * @return void
     */
    public function testFillableProperty()
    {
        $item = new Item();

        $fillableRef = $this->getHiddenProperty($item, 'fillable');
        $this->assertSame(
            [
                'user_id',
                'note_id',
                'body',
                'order_index'
            ],
            $fillableRef->getValue($item)
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
        $item = new Item();

        $hiddenRef = $this->getHiddenProperty($item, 'hidden');
        $this->assertSame(
            [],
            $hiddenRef->getValue($item)
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
        $item = new Item();

        $castsRef = $this->getHiddenProperty($item, 'casts');
        $this->assertSame(
            [
                'user_id' => 'int',
                'note_id' => 'int',
                'body' => 'string',
                'order_index' => 'int'
            ],
            $castsRef->getValue($item)
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
        $item = new Item();

        $datesRef = $this->getHiddenProperty($item, 'dates');
        $this->assertSame(
            [
                'created_at',
                'updated_at',
                'deleted_at',
            ],
            $datesRef->getValue($item)
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
        $item = new Item();

        $appendsRef = $this->getHiddenProperty($item, 'appends');
        $this->assertSame(
            [],
            $appendsRef->getValue($item)
        );
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

        /** @var Mockery\Mock | Item $item */
        $item = Mockery::mock(Item::class)->makePartial();
        $item->shouldReceive('belongsTo')->once()->with(User::class)->andReturn($belongsTo);

        $item->user();
    }

    /**
     * test user property.
     *
     * @return void
     */
    public function testUserProperty()
    {
        /** @var Mockery\Mock $itemMock */
        $itemMock = Mockery::mock(User::class);

        /** @var Mockery\Mock $relation */
        $relation = Mockery::mock(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
        $relation->shouldReceive('getResults')->once()->with()->andReturn($itemMock);

        /** @var Mockery\Mock|Item $item */
        $item = Mockery::mock(Item::class)->makePartial();
        $item->shouldReceive('belongsTo')->once()->with(User::class)->andReturn($relation);

        $this->assertSame($itemMock, $item->user);
    }

    /**
     * test note method
     *
     * @return void
     */
    public function testNote()
    {
        /** @var Mockery\Mock $belongsTo */
        $belongsTo = Mockery::mock(\Illuminate\Database\Eloquent\Relations\belongsTo::class);

        /** @var Mockery\Mock | Item $item */
        $item = Mockery::mock(Item::class)->makePartial();
        $item->shouldReceive('belongsTo')->once()->with(Note::class)->andReturn($belongsTo);

        $item->note();
    }

    /**
     * test note property.
     *
     * @return void
     */
    public function testNoteProperty()
    {
        /** @var Mockery\Mock $itemMock */
        $itemMock = Mockery::mock(User::class);

        /** @var Mockery\Mock $relation */
        $relation = Mockery::mock(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
        $relation->shouldReceive('getResults')->once()->with()->andReturn($itemMock);

        /** @var Mockery\Mock|Item $item */
        $item = Mockery::mock(Item::class)->makePartial();
        $item->shouldReceive('belongsTo')->once()->with(Note::class)->andReturn($relation);

        $this->assertSame($itemMock, $item->note);
    }
}
