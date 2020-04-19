<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\UserInterface;
use App\Repositories\Contracts\FolderRepositoryInterface;

/**
 * Interface StoreUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Folder
 */
interface StoreUseCaseInterface
{
    /**
     * StoreUseCaseInterface constructor.
     * @param FolderRepositoryInterface $repository
     */
    public function __construct(FolderRepositoryInterface $repository);

    /**
     * @param UserInterface $user
     * @param array $folderData
     *
     * @return FolderInterface
     */
    public function __invoke(UserInterface $user, array $folderData=[]): FolderInterface;
}
