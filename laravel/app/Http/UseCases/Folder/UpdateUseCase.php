<?php
declare(strict_types=1);

namespace App\Http\UseCases\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Http\UseCases\Contracts\Folder\UpdateUseCaseInterface;
use App\Repositories\Contracts\FolderRepositoryInterface;

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
     * @param int $folderId
     * @param array $folderData
     *
     * @return FolderInterface
     * @throws \App\Repositories\Exceptions\FolderNotFoundException
     */
    public function __invoke(int $folderId, array $folderData): FolderInterface
    {
        return $this->repository->update($folderId, [
            'rack_id' => array_get($folderData, 'rack_id'),
            'name' => array_get($folderData, 'name'),
        ]);
    }
}
