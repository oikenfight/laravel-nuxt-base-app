<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\UserInterface;
use App\Repositories\Contracts\FolderRepositoryInterface;
use Illuminate\Http\Request;

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
     * @param int $FolderId
     * @param array $FolderData
     *
     * @return FolderInterface
     */
    public function __invoke(int $FolderId, array $FolderData): FolderInterface;
}
