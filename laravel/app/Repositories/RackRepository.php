<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Contracts\RackInterface;
use App\Repositories\Contracts\RackRepositoryInterface;
use App\Repositories\Exceptions\RackNotFoundException;
use App\Repositories\Filters\Contracts\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RackRepository
 *
 * @package App\Repositories
 */
class RackRepository implements RackRepositoryInterface
{
    /**
     * @var RackInterface
     */
    private $eloquent;

    /**
     * @var Builder
     */
    private $query;

    /**
     * RackRepository constructor.
     *
     * @param RackInterface $rack
     */
    public function __construct(RackInterface $rack)
    {
        $this->eloquent = $rack;
        $this->query = $rack->newQuery();
    }

    /**
     * @return RackRepositoryInterface
     */
    public function resetQuery(): RackRepositoryInterface
    {
        $this->query = $this->eloquent->newQuery();
        return $this;
    }

    /**
     * @return RackRepository
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
     * @return RackInterface
     */
    public function create(array $inputs): RackInterface
    {
        $rack = $this->eloquent->newInstance([]);
        $rack->save();

        return $rack;
    }

    /**
     * @param int $rackId
     *
     * @return RackInterface
     * @throws RackNotFoundException
     */
    public function find(int $rackId): RackInterface
    {
        /** @var RackInterface $rack */
        if (!$rack = $this->query->find($rackId)) {
            throw new RackNotFoundException('Rack '.$rackId.' not found.');
        };

        return $rack;
    }

    /**
     * @param int $rackId
     * @param array $inputs
     *
     * @return RackInterface
     * @throws RackNotFoundException
     */
    public function update(int $rackId, array $inputs): RackInterface
    {
        /** @var RackInterface $rack */
        if (!$rack = $this->query->find($rackId)) {
            throw new RackNotFoundException('Rack '.$rackId.' not found.');
        };

        $rack->update([]);

        return $rack;
    }

    /**
     * @param int $rackId
     *
     * @return bool
     * @throws RackNotFoundException
     * @throws \Exception "No primary key defined on model." のケースだが、 Eloquent の責務に於いてテストが終わっているものと考え、ここで \Exception::class を受ける処理や test は書かない。
     */
    public function delete(int $rackId): bool
    {
        /** @var RackInterface $rack */
        if (!$rack = $this->query->find($rackId)) {
            throw new RackNotFoundException('Rack '.$rackId.' not found.');
        };

        $result = $rack->delete();

        return $result;
    }

    /**
     * @return Collection|RackInterface[]
     */
    public function all(): Collection
    {
        $this->orderBy();
        return $this->query->get();
    }

    /**
     * @param FilterInterface $filter
     *
     * @return RackRepositoryInterface
     */
    public function filtering(FilterInterface $filter): RackRepositoryInterface
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
