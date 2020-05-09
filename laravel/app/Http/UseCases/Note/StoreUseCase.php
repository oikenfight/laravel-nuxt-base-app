<?php
declare(strict_types=1);

namespace App\Http\UseCases\Note;

use App\Entities\Contracts\NoteInterface;
use App\Http\UseCases\Contracts\Note\StoreUseCaseInterface;
use App\Repositories\Contracts\NoteRepositoryInterface;

/**
 * Class StoreUseCase
 * @package App\Http\UseCases\Note
 */
final class StoreUseCase implements StoreUseCaseInterface
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
     * @param int $userId
     * @param int $folderId
     * @param array $noteData
     *
     * @return NoteInterface
     */
    public function __invoke(int $userId, int $folderId, array $noteData=[]): NoteInterface
    {
        return $this->repository->create([
            'user_id' => $userId,
            'folder_id' => $folderId,
            'name' => array_get($noteData, 'name'),
            'category_id' => array_get($noteData, 'category_id'),
        ]);
    }
}
