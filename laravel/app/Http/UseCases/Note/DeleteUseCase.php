<?php
declare(strict_types=1);

namespace App\Http\UseCases\Note;

use App\Entities\Contracts\NoteInterface;
use App\Http\UseCases\Contracts\Note\DeleteUseCaseInterface;
use App\Repositories\Contracts\NoteRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class DeleteUseCase
 * @package App\Http\UseCases\Note
 */
final class DeleteUseCase implements DeleteUseCaseInterface
{
    /**
     * @var NoteRepositoryInterface
     */
    private $repository;

    /**
     * DeleteUseCase constructor.
     * @param NoteRepositoryInterface $repository
     */
    public function __construct(NoteRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $noteId
     * @param Request $request
     *
     * @return NoteInterface
     * @throws \App\Repositories\Exceptions\NoteNotFoundException
     */
    public function __invoke(int $noteId): bool
    {
        return $this->repository->delete($noteId);
    }
}
