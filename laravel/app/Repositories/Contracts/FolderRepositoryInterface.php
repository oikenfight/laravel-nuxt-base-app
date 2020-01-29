<?php
declare(strict_types=1);

namespace App\Http\Repositories\Contracts;

namespace App\Repositories\Contracts;

use App\Entities\Contracts\FolderInterface;
use App\Repositories\Exceptions\FolderNotFoundException;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface FolderRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface FolderRepositoryInterface extends RepositoryInterface
{
    /**
     * FolderRepositoryInterface constructor.
     *
     * @param FolderInterface $folder
     */
    public function __construct(FolderInterface $folder);

    /**
     * @return FolderRepositoryInterface
     */
    public function resetQuery(): FolderRepositoryInterface;

    /**
     * @param array $inputs
     *
     * @return FolderInterface
     */
    public function create(array $inputs): FolderInterface;

    /**
     * @param int $folderId
     *
     * @return FolderInterface
     * @throws FolderNotFoundException
     */
    public function find(int $folderId): FolderInterface;

    /**
     * @param int $folderId
     * @param array $inputs
     *
     * @return FolderInterface
     * @throws FolderNotFoundException
     */
    public function update(int $folderId, array $inputs): FolderInterface;

    /**
     * @param int $folderId
     *
     * @return bool
     * @throws FolderNotFoundException
     */
    public function delete(int $folderId): bool;

    /**
     * @return Collection|FolderInterface[]
     */
    public function all(): Collection;

    /**
     * @param FilterInterface $filter
     *
     * @return FolderRepositoryInterface
     */
    public function filtering(FilterInterface $filter): FolderRepositoryInterface;

    /**
     * @return int
     */
    public function count(): int;
}
