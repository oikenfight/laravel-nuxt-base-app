<?php
declare(strict_types=1);

namespace Tests\Unit\app\Entities;

use App\Entities\Contracts\CategoryInterface;
use App\Entities\Category;
use App\Entities\Note;
use App\Entities\Entity;
use App\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class CategoryTest
 *
 * @package Tests\Unit\app\Entities
 */
final class CategoryTest extends TestCase
{
    /**
     * instance of
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $category = new Category();

        $this->assertInstanceOf(Entity::class, $category);
        $this->assertInstanceOf(CategoryInterface::class, $category);
    }

    /**
     * test $table property.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testTableProperty()
    {
        $category = new Category();

        $tableRef = $this->getHiddenProperty($category, 'table');
        $this->assertSame('categories', $tableRef->getValue($category));
    }

    /**
     * test $fillable property
     *
     * @throws \ReflectionException
     * @return void
     */
    public function testFillableProperty()
    {
        $category = new Category();

        $fillableRef = $this->getHiddenProperty($category, 'fillable');
        $this->assertSame(
            [
                'user_id',
                'name',
            ],
            $fillableRef->getValue($category)
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
        $category = new Category();

        $hiddenRef = $this->getHiddenProperty($category, 'hidden');
        $this->assertSame(
            [],
            $hiddenRef->getValue($category)
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
        $category = new Category();

        $castsRef = $this->getHiddenProperty($category, 'casts');
        $this->assertSame(
            [
                'user_id' => 'int',
                'name' => 'string',
            ],
            $castsRef->getValue($category)
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
        $category = new Category();

        $datesRef = $this->getHiddenProperty($category, 'dates');
        $this->assertSame(
            [
                'created_at',
                'updated_at',
                'deleted_at',
            ],
            $datesRef->getValue($category)
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
        $category = new Category();

        $appendsRef = $this->getHiddenProperty($category, 'appends');
        $this->assertSame(
            [
                'note_ids'
            ],
            $appendsRef->getValue($category)
        );
    }

    /**
     * test getNoteIdAttribute method
     *
     * @return void
     */
    public function testGetNoteIdsAttribute()
    {
        $arrayNoteIds = ['dummy note ids'];

        /** @var Mockery\Mock|Collection $collection */
        $collection = Mockery::mock(Collection::class);
        $collection->shouldReceive('pluck')->with('id')->once()->andReturn($collection);
        $collection->shouldReceive('toArray')->with()->once()->andReturn($arrayNoteIds);

        /** @var Mockery\Mock|HasMany $hasMany */
        $hasMany = Mockery::mock(HasMany::class);
        $hasMany->shouldReceive('get')->with()->once()->andReturn($collection);

        /** @var Mockery\Mock|Category $category */
        $category = Mockery::mock(Category::class)->makePartial();
        $category->shouldReceive('notes')->with()->once()->andReturn($hasMany);

        $category->getNoteIdsAttribute();
    }

    /**
     * test note_ids property
     *
     * @return void
     */
    public function testNoteIdsProperty()
    {
        $arrayNoteIds = ['dummy note ids'];
        $expected = $arrayNoteIds;

        /** @var Mockery\Mock|Collection $collection */
        $collection = Mockery::mock(Collection::class);
        $collection->shouldReceive('pluck')->with('id')->once()->andReturn($collection);
        $collection->shouldReceive('toArray')->with()->once()->andReturn($arrayNoteIds);

        /** @var Mockery\Mock|HasMany $hasMany */
        $hasMany = Mockery::mock(HasMany::class);
        $hasMany->shouldReceive('get')->with()->once()->andReturn($collection);

        /** @var Mockery\Mock|Category $category */
        $category = Mockery::mock(Category::class)->makePartial();
        $category->shouldReceive('notes')->with()->once()->andReturn($hasMany);

        $this->assertSame($expected, $category->note_ids);
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

        /** @var Mockery\Mock | Category $category */
        $category = Mockery::mock(Category::class)->makePartial();
        $category->shouldReceive('belongsTo')->once()->with(User::class)->andReturn($belongsTo);

        $category->user();
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

        /** @var Mockery\Mock|Category $category */
        $category = Mockery::mock(Category::class)->makePartial();
        $category->shouldReceive('belongsTo')->once()->with(User::class)->andReturn($relation);

        $this->assertSame($item, $category->user);
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

        /** @var Mockery\Mock | Category $category */
        $category = Mockery::mock(Category::class)->makePartial();
        $category->shouldReceive('hasMany')->once()->with(Note::class)->andReturn($hasMany);

        $category->notes();
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

        /** @var Mockery\Mock|Category $category */
        $category = Mockery::mock(Category::class)->makePartial();
        $category->shouldReceive('hasMany')->once()->with(Note::class)->andReturn($relation);

        $this->assertSame($collection, $category->notes);
    }
}
