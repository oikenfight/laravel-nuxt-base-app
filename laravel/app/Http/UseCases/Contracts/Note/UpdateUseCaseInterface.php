<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Note;

use App\Entities\Contracts\NoteInterface;
use App\Repositories\Contracts\NoteRepositoryInterface;

/**
 * Interface UpdateUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Note
 */
interface UpdateUseCaseInterface
{
    /**
     * UpdateUseCaseInterface constructor.
     * @param NoteRepositoryInterface $repository
     */
    public function __construct(NoteRepositoryInterface $repository);

    /**
     * @param int $noteId
     * @param array $noteData
     *
     * @return NoteInterface
     */
    public function __invoke(int $noteId, array $noteData): NoteInterface;
}
