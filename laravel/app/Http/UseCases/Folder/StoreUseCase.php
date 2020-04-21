<?php
declare(strict_types=1);

namespace App\Http\UseCases\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Http\UseCases\Contracts\Folder\StoreUseCaseInterface;
use App\Repositories\Contracts\FolderRepositoryInterface;

/**
 * Class StoreUseCase
 * @package App\Http\UseCases\Folder
 */
final class StoreUseCase implements StoreUseCaseInterface
{
    /**
     * @var FolderRepositoryInterface
     */
    private $repository;

    /**
     * StoreUseCase constructor.
     * @param FolderRepositoryInterface $repository
     */
    public function __construct(FolderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $userId
     * @param int $rackId
     * @param array $folderData
     *
     * @return FolderInterface
     */
    public function __invoke(int $userId, int $rackId, array $folderData=[]): FolderInterface
    {
        return $this->repository->create([
            'user_id' => $userId,
            'rack_id' => $rackId,
            'name' => array_get($folderData, 'name'),
        ]);
    }
}
