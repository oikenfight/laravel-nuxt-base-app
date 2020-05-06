<?php
declare(strict_types=1);

namespace App\Http\UseCases\Note;

use App\Entities\Contracts\NoteInterface;
use App\Http\UseCases\Contracts\Note\UpdateUseCaseInterface;
use App\Repositories\Contracts\NoteRepositoryInterface;

/**
 * Class UpdateUseCase
 * @package App\Http\UseCases\Note
 */
final class UpdateUseCase implements UpdateUseCaseInterface
{
    /**
     * @var NoteRepositoryInterface
     */
    private $repository;

    /**
     * UpdateUseCase constructor.
     * @param NoteRepositoryInterface $repository
     */
    public function __construct(NoteRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $noteId
     * @param array $noteData
     *
     * @return NoteInterface
     * @throws \App\Repositories\Exceptions\NoteNotFoundException
     */
    public function __invoke(int $noteId, array $noteData): NoteInterface
    {
        return $this->repository->update($noteId, [
            'folder_id' => array_get($noteData, 'folder_id'),
            'name' => array_get($noteData, 'name'),
            'status' => array_get($noteData, 'status'),
        ]);
    }
}
