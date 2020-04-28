<?php
declare(strict_types=1);

namespace App\Http\UseCases\Note;

use App\Entities\Contracts\NoteInterface;
use App\Http\UseCases\Contracts\Note\FindUseCaseInterface;
use App\Repositories\Contracts\NoteRepositoryInterface;

/**
 * Class FindUseCase
 *
 * @package App\Http\UseCases\Note
 */
class FindUseCase implements FindUseCaseInterface
{
    /**
     * @var NoteRepositoryInterface
     */
    private $repository;

    /**
     * FindUseCase constructor.
     * @param NoteRepositoryInterface $repository
     */
    public function __construct(NoteRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $noteId
     * @return NoteInterface
     * @throws \App\Repositories\Exceptions\NoteNotFoundException
     */
    public function __invoke(int $noteId): NoteInterface
    {
        return $this->repository->find($noteId);
    }
}
