<?php
declare(strict_types=1);

namespace App\Http\UseCases\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Http\UseCases\Contracts\Folder\DeleteUseCaseInterface;
use App\Repositories\Contracts\FolderRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class DeleteUseCase
 * @package App\Http\UseCases\Folder
 */
final class DeleteUseCase implements DeleteUseCaseInterface
{
    /**
     * @var FolderRepositoryInterface
     */
    private $repository;

    /**
     * DeleteUseCase constructor.
     * @param FolderRepositoryInterface $repository
     */
    public function __construct(FolderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $FolderId
     * @param Request $request
     *
     * @return FolderInterface
     * @throws \App\Repositories\Exceptions\FolderNotFoundException
     */
    public function __invoke(int $FolderId): bool
    {
        return $this->repository->delete($FolderId);
    }
}
