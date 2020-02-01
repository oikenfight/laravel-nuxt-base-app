<?php
declare(strict_types=1);

namespace Tests\Unit\app\Entities;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Folder;
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
 * Class FolderTest
 *
 * @package Tests\Unit\app\Entities
 */
final class FolderTest extends TestCase
{
    /**
     * instance of
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $folder = new Folder();

        $this->assertInstanceOf(Entity::class, $folder);
        $this->assertInstanceOf(FolderInterface::class, $folder);
    }

    /**
     * test $table property.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testTableProperty()
    {
        $folder = new Folder();

        $tableRef = $this->getHiddenProperty($folder, 'table');
        $this->assertSame('folders', $tableRef->getValue($folder));
    }

    /**
     * test $fillable property
     *
     * @throws \ReflectionException
     * @return void
     */
    public function testFillableProperty()
    {
        $folder = new Folder();

        $fillableRef = $this->getHiddenProperty($folder, 'fillable');
        $this->assertSame(
            [
                'user_id',
                'rack_id',
                'name',
            ],
            $fillableRef->getValue($folder)
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
        $folder = new Folder();

        $hiddenRef = $this->getHiddenProperty($folder, 'hidden');
        $this->assertSame(
            [],
            $hiddenRef->getValue($folder)
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
        $folder = new Folder();

        $castsRef = $this->getHiddenProperty($folder, 'casts');
        $this->assertSame(
            [
                'user_id' => 'int',
                'rack_id' => 'int',
                'name' => 'string',
            ],
            $castsRef->getValue($folder)
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
        $folder = new Folder();

        $datesRef = $this->getHiddenProperty($folder, 'dates');
        $this->assertSame(
            [
                'created_at',
                'updated_at',
                'deleted_at',
            ],
            $datesRef->getValue($folder)
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
        $folder = new Folder();

        $appendsRef = $this->getHiddenProperty($folder, 'appends');
        $this->assertSame(
            [],
            $appendsRef->getValue($folder)
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

        /** @var Mockery\Mock | Folder $folder */
        $folder = Mockery::mock(Folder::class)->makePartial();
        $folder->shouldReceive('belongsTo')->once()->with(User::class)->andReturn($belongsTo);

        $folder->user();
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

        /** @var Mockery\Mock|Folder $folder */
        $folder = Mockery::mock(Folder::class)->makePartial();
        $folder->shouldReceive('belongsTo')->once()->with(User::class)->andReturn($relation);

        $this->assertSame($item, $folder->user);
    }

    /**
     * test rack method
     *
     * @return void
     */
    public function testRack()
    {
        /** @var Mockery\Mock $belongsTo */
        $belongsTo = Mockery::mock(\Illuminate\Database\Eloquent\Relations\belongsTo::class);

        /** @var Mockery\Mock | Folder $folder */
        $folder = Mockery::mock(Folder::class)->makePartial();
        $folder->shouldReceive('belongsTo')->once()->with(Rack::class)->andReturn($belongsTo);

        $folder->rack();
    }

    /**
     * test rack property.
     *
     * @return void
     */
    public function testRackProperty()
    {
        /** @var Mockery\Mock $item */
        $item = Mockery::mock(User::class);

        /** @var Mockery\Mock $relation */
        $relation = Mockery::mock(\Illuminate\Database\Eloquent\Relations\BelongsTo::class);
        $relation->shouldReceive('getResults')->once()->with()->andReturn($item);

        /** @var Mockery\Mock|Folder $folder */
        $folder = Mockery::mock(Folder::class)->makePartial();
        $folder->shouldReceive('belongsTo')->once()->with(Rack::class)->andReturn($relation);

        $this->assertSame($item, $folder->rack);
    }

    /**
     * test notes methods
     *
     * @return void
     */
    public function testNotes()
    {
        /** @var Mockery\Mock $hasMany */
        $hasMany = Mockery::mock(\Illuminate\Database\Eloquent\Relations\belongsTo::class);

        /** @var Mockery\Mock | Folder $folder */
        $folder = Mockery::mock(Folder::class)->makePartial();
        $folder->shouldReceive('hasMany')->once()->with(Note::class)->andReturn($hasMany);

        $folder->notes();
    }

    /**
     * test notes property.
     *
     * @return void
     */
    public function testNotesProperty()
    {
        /** @var Mockery\Mock $collection */
        $collection = Mockery::mock(Collection::class);

        /** @var Mockery\Mock $relation */
        $relation = Mockery::mock(\Illuminate\Database\Eloquent\Relations\HasMany::class);
        $relation->shouldReceive('getResults')->once()->with()->andReturn($collection);

        /** @var Mockery\Mock|Folder $folder */
        $folder = Mockery::mock(Folder::class)->makePartial();
        $folder->shouldReceive('hasMany')->once()->with(Note::class)->andReturn($relation);

        $this->assertSame($collection, $folder->notes);
    }
}
