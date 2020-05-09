<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\UserInterface;
use App\Repositories\Contracts\FolderRepositoryInterface;
use Illuminate\Http\Request;

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
     * @param int $userId
     * @param int $rackId
     * @param array $folderData
     *
     * @return FolderInterface
     */
    public function __invoke(int $userId, int $rackId, array $folderData=[]): FolderInterface;
}
