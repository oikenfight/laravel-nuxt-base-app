<?php
declare(strict_types=1);

namespace Tests\Unit\app\Services\ResponseDataMakers;

use App\Entities\Contracts\FolderInterface;
use App\Services\ResponseDataMakers\Contracts\ResponseFoldersMakerInterface;
use App\Services\ResponseDataMakers\ResponseDataMaker;
use App\Services\ResponseDataMakers\ResponseFoldersMaker;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class ResponseFoldersMakerTest
 * @package Tests\Unit\app\Services\ResponseDataMakers
 */
final class ResponseFoldersMakerTest extends TestCase
{
    /**
     * test instance of
     *
     * @return void
     */
    public function testInstanceOf()
    {
        $maker = new ResponseFoldersMaker();

        $this->assertInstanceOf(ResponseDataMaker::class, $maker);
        $this->assertInstanceOf(ResponseFoldersMakerInterface::class, $maker);
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

        /** @var Mockery\Mock|FolderInterface $folder1 */
        $folder1 = Mockery::mock(FolderInterface::class);
        $folder1->shouldReceive('folders')->with()->once()->andReturn($hasMany);

        /** @var Mockery\Mock|FolderInterface $folder2 */
        $folder2 = Mockery::mock(FolderInterface::class);
        $folder2->shouldReceive('folders')->with()->once()->andReturn($hasMany);

        /** @var Collection|FolderInterface[] $inputFolders */
        $inputFolders = collect([$folder1, $folder2]);

        $folder1->folderIds = $folderIds;
        $folder2->folderIds = $folderIds;
        /** @var Collection|FolderInterface[] $expectedFolders */
        $expectedFolders = collect([$folder1, $folder2]);

        $maker = new ResponseFoldersMaker();

        $result = $maker->make($inputFolders);

        $this->assertEquals($result, $expectedFolders);
    }
}
