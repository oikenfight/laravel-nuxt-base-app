<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Note;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;
use App\Repositories\Contracts\NoteRepositoryInterface;

/**
 * Interface StoreUseCaseInterface
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
     * @param UserInterface $user
     * @param FolderInterface $folder
     * @return NoteInterface
     */
    public function __invoke(UserInterface $user, FolderInterface $folder): NoteInterface;
}
