<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Note;

use App\Entities\Contracts\NoteInterface;
use App\Http\UseCases\Contracts\Note\UpdateUseCaseInterface;
use App\Http\UseCases\Note\UpdateUseCase;
use App\Repositories\Contracts\NoteRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class UpdateUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Note
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
        /** @var Mockery\Mock|NoteRepositoryInterface $repository */
        $repository = Mockery::mock(NoteRepositoryInterface::class);

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
        /** @var Mockery\Mock|NoteRepositoryInterface $repository */
        $repository = Mockery::mock(NoteRepositoryInterface::class);

        $useCase = new UpdateUseCase($repository);

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
        $folderId = 100;
        $categoryId = 100;
        $name = 'dummy note name';
        $status = 'dummy note status';
        $noteData = [
            'folder_id' => $folderId,
            'name' => $name,
            'status' => $status,
            'category_id' => $categoryId,
        ];
        $updateData = [
            'folder_id' => $folderId,
            'name' => $name,
            'status' => $status,
            'category_id' => $categoryId,
        ];

        /** @var Mockery\Mock|NoteRepositoryInterface $repository */
        $repository = Mockery::mock(NoteRepositoryInterface::class);
        $repository->shouldReceive('update')->once()->with($noteId, $updateData)->andReturn($note);

        $useCase = new UpdateUseCase($repository);

        $this->assertSame($expected, $useCase($noteId, $noteData));
    }
}
