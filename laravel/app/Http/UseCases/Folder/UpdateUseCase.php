<?php
declare(strict_types=1);

namespace App\Http\UseCases\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Folder\UpdateUseCaseInterface;
use App\Repositories\Contracts\FolderRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class UpdateUseCase
 * @package App\Http\UseCases\Folder
 */
final class UpdateUseCase implements UpdateUseCaseInterface
{
    /**
     * @var FolderRepositoryInterface
     */
    private $repository;

    /**
     * UpdateUseCase constructor.
     * @param FolderRepositoryInterface $repository
     */
    public function __construct(FolderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $FolderId
     * @param array $FolderData
     *
     * @return FolderInterface
     * @throws \App\Repositories\Exceptions\FolderNotFoundException
     */
    public function __invoke(int $FolderId, array $FolderData): FolderInterface
    {
        return $this->repository->update($FolderId, [
            'name' => $FolderData['name'],
        ]);
    }
}
