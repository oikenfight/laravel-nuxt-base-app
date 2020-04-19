<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Repositories\Contracts\FolderRepositoryInterface;

/**
 * Interface UpdateUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Folder
 */
interface UpdateUseCaseInterface
{
    /**
     * UpdateUseCaseInterface constructor.
     * @param FolderRepositoryInterface $repository
     */
    public function __construct(FolderRepositoryInterface $repository);

    /**
     * @param int $folderId
     * @param array $folderData
     *
     * @return FolderInterface
     */
    public function __invoke(int $folderId, array $folderData): FolderInterface;
}
