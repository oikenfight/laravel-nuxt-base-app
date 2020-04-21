<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Folder;

use App\Repositories\Contracts\FolderRepositoryInterface;

/**
 * Interface DeleteUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Folder
 */
interface DeleteUseCaseInterface
{
    /**
     * DeleteUseCaseInterface constructor.
     * @param FolderRepositoryInterface $repository
     */
    public function __construct(FolderRepositoryInterface $repository);

    /**
     * @param int $folderId
     * @return bool
     */
    public function __invoke(int $folderId): bool;
}
