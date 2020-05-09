<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Note;

use App\Entities\Contracts\NoteInterface;
use App\Repositories\Contracts\NoteRepositoryInterface;

/**
 * Interface FindUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Note
 */
interface FindUseCaseInterface
{
    /**
     * FindUseCaseInterface constructor.
     * @param NoteRepositoryInterface $repository
     */
    public function __construct(NoteRepositoryInterface $repository);

    /**
     * @param int $noteId
     * @return NoteInterface
     */
    public function __invoke(int $noteId): NoteInterface;
}
