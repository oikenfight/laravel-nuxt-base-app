<?php
declare(strict_types=1);

namespace App\Http\UseCases\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\UserInterface;
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
     * @param UserInterface $user
     * @param array $folderData
     *
     * @return FolderInterface
     */
    public function __invoke(UserInterface $user, array $folderData=[]): FolderInterface
    {
        return $this->repository->create([
            'user_id' => $user->id,
            'name' => array_get($folderData, 'name'),
        ]);
    }
}
