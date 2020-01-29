<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Contracts\ItemInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;
use App\Repositories\Exceptions\ItemNotFoundException;
use App\Repositories\Filters\Contracts\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ItemRepository
 *
 * @package App\Repositories
 */
class ItemRepository implements ItemRepositoryInterface
{
    /**
     * @var ItemInterface
     */
    private $eloquent;

    /**
     * @var Builder
     */
    private $query;

    /**
     * ItemRepository constructor.
     *
     * @param ItemInterface $item
     */
    public function __construct(ItemInterface $item)
    {
        $this->eloquent = $item;
        $this->query = $item->newQuery();
    }

    /**
     * @return ItemRepositoryInterface
     */
    public function resetQuery(): ItemRepositoryInterface
    {
        $this->query = $this->eloquent->newQuery();
        return $this;
    }

    /**
     * @return ItemRepository
     */
    protected function orderBy(): self
    {
        $this->query->orderBy('order_index');
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
     * @return ItemInterface
     */
    public function create(array $inputs): ItemInterface
    {
        $item = $this->eloquent->newInstance([]);
        $item->save();

        return $item;
    }

    /**
     * @param int $itemId
     *
     * @return ItemInterface
     * @throws ItemNotFoundException
     */
    public function find(int $itemId): ItemInterface
    {
        /** @var ItemInterface $item */
        if (!$item = $this->query->find($itemId)) {
            throw new ItemNotFoundException('Item '.$itemId.' not found.');
        };

        return $item;
    }

    /**
     * @param int $itemId
     * @param array $inputs
     *
     * @return ItemInterface
     * @throws ItemNotFoundException
     */
    public function update(int $itemId, array $inputs): ItemInterface
    {
        /** @var ItemInterface $item */
        if (!$item = $this->query->find($itemId)) {
            throw new ItemNotFoundException('Item '.$itemId.' not found.');
        };

        $item->update([]);

        return $item;
    }

    /**
     * @param int $itemId
     *
     * @return bool
     * @throws ItemNotFoundException
     * @throws \Exception "No primary key defined on model." のケースだが、 Eloquent の責務に於いてテストが終わっているものと考え、ここで \Exception::class を受ける処理や test は書かない。
     */
    public function delete(int $itemId): bool
    {
        /** @var ItemInterface $item */
        if (!$item = $this->query->find($itemId)) {
            throw new ItemNotFoundException('Item '.$itemId.' not found.');
        };

        $result = $item->delete();

        return $result;
    }

    /**
     * @return Collection|ItemInterface[]
     */
    public function all(): Collection
    {
        $this->orderBy();
        return $this->query->get();
    }

    /**
     * @param FilterInterface $filter
     *
     * @return ItemRepositoryInterface
     */
    public function filtering(FilterInterface $filter): ItemRepositoryInterface
    {
        $filter->apply($this->query);
        return $this;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->query->count(['id']);
    }
}
