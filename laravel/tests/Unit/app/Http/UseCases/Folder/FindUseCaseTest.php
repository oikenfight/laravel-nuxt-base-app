<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Folder\FindUseCaseInterface;
use App\Http\UseCases\Folder\FindUseCase;
use App\Repositories\Contracts\FolderRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class FindUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Folder
 */
final class FindUseCaseTest extends TestCase
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

        $useCase = new FindUseCase($repository);

        $this->assertInstanceOf(FindUseCaseInterface::class, $useCase);
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

        $useCase = new FindUseCase($repository);

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
        $folder = Mockery::mock(FolderInterface::class);
        $expected = $folder;

        $folderId = 100;

        /** @var Mockery\Mock|FolderRepositoryInterface $repository */
        $repository = Mockery::mock(FolderRepositoryInterface::class);
        $repository->shouldReceive('find')->once()->with($folderId)->andReturn($folder);

        $useCase = new FindUseCase($repository);

        $this->assertSame($expected, $useCase($folderId));
    }
}
