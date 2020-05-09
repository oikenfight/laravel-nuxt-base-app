<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Note;

use App\Http\UseCases\Contracts\Note\DeleteUseCaseInterface;
use App\Http\UseCases\Note\DeleteUseCase;
use App\Repositories\Contracts\NoteRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class DeleteUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Note
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
        /** @var Mockery\Mock|NoteRepositoryInterface $repository */
        $repository = Mockery::mock(NoteRepositoryInterface::class);

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
        /** @var Mockery\Mock|NoteRepositoryInterface $repository */
        $repository = Mockery::mock(NoteRepositoryInterface::class);

        $useCase = new DeleteUseCase($repository);

        $repositoryRef = $this->getHiddenProperty($useCase, 'repository');

        $this->assertSame($repository, $repositoryRef->getValue($useCase));
    }

    /**
     * test __invoke method
     *
     * @return void
     * @throws \App\Repositories\Exceptions\NoteNotFoundException
     */
    public function testInvoke()
    {
        $expected = true;
        $noteId = 100;

        /** @var Mockery\Mock|NoteRepositoryInterface $repository */
        $repository = Mockery::mock(NoteRepositoryInterface::class);
        $repository->shouldReceive('delete')->once()->with($noteId)->andReturn(true);

        $useCase = new DeleteUseCase($repository);

        $this->assertSame($expected, $useCase($noteId));
    }
}
