<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Note;

use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;
use App\Repositories\Contracts\NoteRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Interface StoreUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Note
 */
interface StoreUseCaseInterface
{
    /**
     * StoreUseCaseInterface constructor.
     * @param NoteRepositoryInterface $repository
     */
    public function __construct(NoteRepositoryInterface $repository);

    /**
     * @param int $userId
     * @param int $folderId
     * @param array $noteData
     *
     * @return NoteInterface
     */
    public function __invoke(int $userId, int $folderId, array $noteData=[]): NoteInterface;
}
