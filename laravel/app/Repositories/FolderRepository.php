<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Contracts\FolderInterface;
use App\Repositories\Contracts\FolderRepositoryInterface;
use App\Repositories\Exceptions\FolderNotFoundException;
use App\Repositories\Filters\Contracts\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class FolderRepository
 *
 * @package App\Repositories
 */
class FolderRepository implements FolderRepositoryInterface
{
    /**
     * @var FolderInterface
     */
    private $eloquent;

    /**
     * @var Builder
     */
    private $query;

    /**
     * FolderRepository constructor.
     *
     * @param FolderInterface $folder
     */
    public function __construct(FolderInterface $folder)
    {
        $this->eloquent = $folder;
        $this->query = $folder->newQuery();
    }

    /**
     * @return FolderRepositoryInterface
     */
    public function resetQuery(): FolderRepositoryInterface
    {
        $this->query = $this->eloquent->newQuery();
        return $this;
    }

    /**
     * @return FolderRepository
     */
    protected function orderBy(): self
    {
        $this->query->orderBy('updated_at');
        return $this;
    }

    /**
     * @return int
     */
    public function totalCount(): int
    {
        return $this->query->count(['id']);
    }

    /**
     * @param array $inputs
     *
     * @return FolderInterface
     */
    public function create(array $inputs): FolderInterface
    {
        $folder = $this->eloquent->newInstance([
            'user_id' => array_get($inputs, 'user_id'),
            'rack_id' => array_get($inputs, 'rack_id'),
            'name' => array_get($inputs, 'name'),
        ]);
        $folder->save();

        return $folder;
    }

    /**
     * @param int $folderId
     *
     * @return FolderInterface
     * @throws FolderNotFoundException
     */
    public function find(int $folderId): FolderInterface
    {
        /** @var FolderInterface $folder */
        if (!$folder = $this->query->find($folderId)) {
            throw new FolderNotFoundException('Folder '.$folderId.' not found.');
        };

        return $folder;
    }

    /**
     * @param int $folderId
     * @param array $inputs
     *
     * @return FolderInterface
     * @throws FolderNotFoundException
     */
    public function update(int $folderId, array $inputs): FolderInterface
    {
        /** @var FolderInterface $folder */
        if (!$folder = $this->query->find($folderId)) {
            throw new FolderNotFoundException('Folder '.$folderId.' not found.');
        };

        $folder->update([
            'rack_id' => array_get($inputs, 'rack_id'),
            'name' => array_get($inputs, 'name'),
        ]);

        return $folder;
    }

    /**
     * @param int $folderId
     *
     * @return bool
     * @throws FolderNotFoundException
     * @throws \Exception "No primary key defined on model." のケースだが、 Eloquent の責務に於いてテストが終わっているものと考え、ここで \Exception::class を受ける処理や test は書かない。
     */
    public function delete(int $folderId): bool
    {
        /** @var FolderInterface $folder */
        if (!$folder = $this->query->find($folderId)) {
            throw new FolderNotFoundException('Folder '.$folderId.' not found.');
        };

        $result = $folder->delete();

        return $result;
    }

    /**
     * @return Collection|FolderInterface[]
     */
    public function all(): Collection
    {
        $this->orderBy();
        return $this->query->get();
    }

    // /**
    //  * @param FilterInterface $filter
    //  *
    //  * @return FolderRepositoryInterface
    //  */
    // public function filtering(FilterInterface $filter): FolderRepositoryInterface
    // {
    //     $filter->apply($this->query);
    //     return $this;
    // }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->query->count(['id']);
    }
}
