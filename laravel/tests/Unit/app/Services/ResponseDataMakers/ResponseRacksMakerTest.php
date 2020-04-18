<?php
declare(strict_types=1);

namespace Tests\Unit\app\Services\ResponseDataMakers;

use App\Entities\Contracts\RackInterface;
use App\Services\ResponseDataMakers\Contracts\ResponseRacksMakerInterface;
use App\Services\ResponseDataMakers\ResponseDataMaker;
use App\Services\ResponseDataMakers\ResponseRacksMaker;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class ResponseRacksMakerTest
 * @package Tests\Unit\app\Services\ResponseDataMakers
 */
final class ResponseRacksMakerTest extends TestCase
{
    /**
     * test instance of
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $maker = new ResponseRacksMaker();

        $this->assertInstanceOf(ResponseDataMaker::class, $maker);
        $this->assertInstanceOf(ResponseRacksMakerInterface::class, $maker);
    }

    /**
     * test make method
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testMake()
    {
        $folderIds = [
            100,
            200,
        ];

        /** @var Mockery\Mock|Collection $collection */
        $collection = Mockery::mock(Collection::class);
        $collection->shouldReceive('pluck')->with('id')->twice()->andReturn($folderIds);

        /** @var Mockery\Mock|HasMany $hasMany */
        $hasMany = Mockery::mock(HasMany::class);
        $hasMany->shouldReceive('get')->with()->twice()->andReturn($collection);

        /** @var Mockery\Mock|RackInterface $rack1 */
        $rack1 = Mockery::mock(RackInterface::class);
        $rack1->shouldReceive('folders')->with()->once()->andReturn($hasMany);

        /** @var Mockery\Mock|RackInterface $rack2 */
        $rack2 = Mockery::mock(RackInterface::class);
        $rack2->shouldReceive('folders')->with()->once()->andReturn($hasMany);

        /** @var Collection|RackInterface[] $inputRacks */
        $inputRacks = collect([$rack1, $rack2]);

        $rack1->folderIds = $folderIds;
        $rack2->folderIds = $folderIds;
        /** @var Collection|RackInterface[] $expectedRacks */
        $expectedRacks = collect([$rack1, $rack2]);

        $maker = new ResponseRacksMaker();

        $result = $maker->make($inputRacks);

        $this->assertEquals($result, $expectedRacks);
    }
}
