<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Http\UseCases\Contracts\Folder\UpdateUseCaseInterface;
use App\Http\UseCases\Folder\UpdateUseCase;
use App\Repositories\Contracts\FolderRepositoryInterface;
use Illuminate\Http\Request;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class UpdateUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Folder
 */
final class UpdateUseCaseTest extends TestCase
{
    /**
     * test instance of
     *
     * @return void
     */
    public function testInstanceOf()
    {
        /** @var Mockery\Mock|FolderRepositoryInterface $repository */
        $repository = Mockery::mock(FolderRepositoryInterface::class);

        $useCase = new UpdateUseCase($repository);

        $this->assertInstanceOf(UpdateUseCaseInterface::class, $useCase);
    }

    /**
     * test __construct
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testConstruct()
    {
        /** @var Mockery\Mock|FolderRepositoryInterface $repository */
        $repository = Mockery::mock(FolderRepositoryInterface::class);

        $useCase = new UpdateUseCase($repository);

        $repositoryRef = $this->getHiddenProperty($useCase, 'repository');

        $this->assertSame($repository, $repositoryRef->getValue($useCase));
    }

    /**
     * test __invoke method
     *
     * @return void
     * @throws \App\Repositories\Exceptions\FolderNotFoundException
     */
    public function testInvoke()
    {
        /** @var Mockery\Mock|FolderInterface $user */
        $Folder = Mockery::mock(FolderInterface::class);
        $expected = $Folder;

        $FolderId = 100;
        $FolderData = [
            'name' => 'dummy-name'
        ];

        /** @var Mockery\Mock|FolderRepositoryInterface $repository */
        $repository = Mockery::mock(FolderRepositoryInterface::class);
        $repository->shouldReceive('update')->once()->with($FolderId, [
            'name' => $FolderData['name']
        ])->andReturn($Folder);

        $useCase = new UpdateUseCase($repository);

        $this->assertSame($expected, $useCase($FolderId, $FolderData));
    }
}
