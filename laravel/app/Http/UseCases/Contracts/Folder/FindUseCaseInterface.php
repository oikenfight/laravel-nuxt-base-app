<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Repositories\Contracts\FolderRepositoryInterface;

/**
 * Interface FindUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Folder
 */
interface FindUseCaseInterface
{
    /**
     * FindUseCaseInterface constructor.
     * @param FolderRepositoryInterface $repository
     */
    public function __construct(FolderRepositoryInterface $repository);

    /**
     * @param int $folderId
     * @return FolderInterface
     */
    public function __invoke(int $folderId): FolderInterface;
}
