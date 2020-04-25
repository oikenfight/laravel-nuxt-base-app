<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Note;

use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Note\FindUseCaseInterface;
use App\Http\UseCases\Note\FindUseCase;
use App\Repositories\Contracts\NoteRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class FindUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Note
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
        /** @var Mockery\Mock|NoteRepositoryInterface $repository */
        $repository = Mockery::mock(NoteRepositoryInterface::class);

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
        /** @var Mockery\Mock|NoteRepositoryInterface $repository */
        $repository = Mockery::mock(NoteRepositoryInterface::class);

        $useCase = new FindUseCase($repository);

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
        /** @var Mockery\Mock|NoteInterface $user */
        $note = Mockery::mock(NoteInterface::class);
        $expected = $note;

        $noteId = 100;

        /** @var Mockery\Mock|NoteRepositoryInterface $repository */
        $repository = Mockery::mock(NoteRepositoryInterface::class);
        $repository->shouldReceive('find')->once()->with($noteId)->andReturn($note);

        $useCase = new FindUseCase($repository);

        $this->assertSame($expected, $useCase($noteId));
    }
}
