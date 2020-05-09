<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\UseCases\Note;

use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Note\StoreUseCaseInterface;
use App\Http\UseCases\Note\StoreUseCase;
use App\Repositories\Contracts\NoteRepositoryInterface;
use Mockery;
use Tests\Unit\TestCase;


/**
 * Class StoreUseCaseTest
 *
 * @package Tests\Unit\app\Http\UseCases\Note
 */
final class StoreUseCaseTest extends TestCase
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

        $useCase = new StoreUseCase($repository);

        $this->assertInstanceOf(StoreUseCaseInterface::class, $useCase);
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

        $useCase = new StoreUseCase($repository);

        $repositoryRef = $this->getHiddenProperty($useCase, 'repository');

        $this->assertSame($repository, $repositoryRef->getValue($useCase));
    }

    /**
     * test __invoke method
     *
     * @return void
     */
    public function testInvoke()
    {
        /** @var Mockery\Mock|NoteInterface $user */
        $note = Mockery::mock(NoteInterface::class);
        $expected = $note;

        $userId = 100;
        $folderId = 100;
        $categoryId = 100;
        $name = 'dummy note name';
        $noteData = [
            'name' => $name,
            'category_id' => $categoryId,
        ];
        $createData = [
            'user_id' => $userId,
            'folder_id' => $folderId,
            'name' => $name,
            'category_id' => $categoryId,

        ];

        /** @var Mockery\Mock|NoteRepositoryInterface $repository */
        $repository = Mockery::mock(NoteRepositoryInterface::class);
        $repository->shouldReceive('create')->once()->with($createData)->andReturn($note);

        $useCase = new StoreUseCase($repository);

        $this->assertSame($expected, $useCase($userId, $folderId, $noteData));
    }

    /**
     * test __invoke method with none input
     *
     * @return void
     */
    public function testInvokeWithNoteDataIsNone()
    {
        /** @var Mockery\Mock|NoteInterface $user */
        $note = Mockery::mock(NoteInterface::class);
        $expected = $note;

        $userId = 100;
        $folderId = 100;
        $createData = [
            'user_id' => $userId,
            'folder_id' => $folderId,
            'name' => null,
            'category_id' => null,
        ];

        /** @var Mockery\Mock|UserInterface $user */
        $user = Mockery::mock(UserInterface::class);
        $user->id = $userId;

        /** @var Mockery\Mock|NoteRepositoryInterface $repository */
        $repository = Mockery::mock(NoteRepositoryInterface::class);
        $repository->shouldReceive('create')->once()->with($createData)->andReturn($note);

        $useCase = new StoreUseCase($repository);

        $this->assertSame($expected, $useCase($userId, $folderId));
    }
}
