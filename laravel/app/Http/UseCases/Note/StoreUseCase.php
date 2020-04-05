<?php
declare(strict_types=1);

namespace App\Http\UseCases\Note;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Note\StoreUseCaseInterface;
use App\Repositories\Contracts\NoteRepositoryInterface;

/**
 * Class StoreUseCase
 * @package App\Http\UseCases\Note
 */
class StoreUseCase implements StoreUseCaseInterface
{
    /**
     * @var NoteRepositoryInterface
     */
    private $repository;

    /**
     * StoreUseCase constructor.
     * @param NoteRepositoryInterface $repository
     */
    public function __construct(NoteRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserInterface $user
     * @param FolderInterface $folder
     * @return NoteInterface
     */
    public function __invoke(UserInterface $user, FolderInterface $folder): NoteInterface
    {
        return $this->repository->create([
            'user_id' => $user->id,
            'folder_id' => $folder->id,
        ]);
    }
}
