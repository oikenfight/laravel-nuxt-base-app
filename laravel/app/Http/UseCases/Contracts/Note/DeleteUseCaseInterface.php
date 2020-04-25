<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Note;

use App\Repositories\Contracts\NoteRepositoryInterface;

/**
 * Interface DeleteUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Note
 */
interface DeleteUseCaseInterface
{
    /**
     * DeleteUseCaseInterface constructor.
     * @param NoteRepositoryInterface $repository
     */
    public function __construct(NoteRepositoryInterface $repository);

    /**
     * @param int $noteId
     * @return bool
     */
    public function __invoke(int $noteId): bool;
}
