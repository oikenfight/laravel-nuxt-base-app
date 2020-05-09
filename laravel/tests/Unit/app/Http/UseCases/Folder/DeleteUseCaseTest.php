<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Folder;

use App\Http\UseCases\Contracts\Folder\DeleteUseCaseInterface;
use App\Http\UseCases\Folder\DeleteUseCase;
use App\Repositories\Contracts\FolderRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class DeleteUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Folder
 */
final class DeleteUseCaseTest extends TestCase
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

        $useCase = new DeleteUseCase($repository);

        $this->assertInstanceOf(DeleteUseCaseInterface::class, $useCase);
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

        $useCase = new DeleteUseCase($repository);

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
        $expected = true;
        $folderId = 100;

        /** @var Mockery\Mock|FolderRepositoryInterface $repository */
        $repository = Mockery::mock(FolderRepositoryInterface::class);
        $repository->shouldReceive('delete')->once()->with($folderId)->andReturn(true);

        $useCase = new DeleteUseCase($repository);

        $this->assertSame($expected, $useCase($folderId));
    }
}
