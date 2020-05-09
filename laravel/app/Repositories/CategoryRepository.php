<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Contracts\CategoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Exceptions\CategoryNotFoundException;
use App\Repositories\Filters\Contracts\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CategoryRepository
 *
 * @package App\Repositories
 */
class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var CategoryInterface
     */
    private $eloquent;

    /**
     * @var Builder
     */
    private $query;

    /**
     * CategoryRepository constructor.
     *
     * @param CategoryInterface $category
     */
    public function __construct(CategoryInterface $category)
    {
        $this->eloquent = $category;
        $this->query = $category->newQuery();
    }

    /**
     * @return CategoryRepositoryInterface
     */
    public function resetQuery(): CategoryRepositoryInterface
    {
        $this->query = $this->eloquent->newQuery();
        return $this;
    }

    /**
     * @return CategoryRepository
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
     * @return CategoryInterface
     */
    public function create(array $inputs): CategoryInterface
    {
        $category = $this->eloquent->newInstance([
            'user_id' => array_get($inputs, 'user_id'),
            'name' => array_get($inputs, 'name'),
        ]);
        $category->save();

        return $category;
    }

    /**
     * @param int $categoryId
     *
     * @return CategoryInterface
     * @throws CategoryNotFoundException
     */
    public function find(int $categoryId): CategoryInterface
    {
        /** @var CategoryInterface $category */
        if (!$category = $this->query->find($categoryId)) {
            throw new CategoryNotFoundException('Category '.$categoryId.' not found.');
        };

        return $category;
    }

    /**
     * @param int $categoryId
     * @param array $inputs
     *
     * @return CategoryInterface
     * @throws CategoryNotFoundException
     */
    public function update(int $categoryId, array $inputs): CategoryInterface
    {
        /** @var CategoryInterface $category */
        if (!$category = $this->query->find($categoryId)) {
            throw new CategoryNotFoundException('Category '.$categoryId.' not found.');
        };

        $category->update([
            'name' => array_get($inputs, 'name'),
        ]);

        return $category;
    }

    /**
     * @param int $categoryId
     *
     * @return bool
     * @throws CategoryNotFoundException
     * @throws \Exception "No primary key defined on model." のケースだが、 Eloquent の責務に於いてテストが終わっているものと考え、ここで \Exception::class を受ける処理や test は書かない。
     */
    public function delete(int $categoryId): bool
    {
        /** @var CategoryInterface $category */
        if (!$category = $this->query->find($categoryId)) {
            throw new CategoryNotFoundException('Category '.$categoryId.' not found.');
        };

        $result = $category->delete();

        return $result;
    }

    /**
     * @return Collection|CategoryInterface[]
     */
    public function all(): Collection
    {
        $this->orderBy();
        return $this->query->get();
    }

    // /**
    //  * @param FilterInterface $filter
    //  *
    //  * @return CategoryRepositoryInterface
    //  */
    // public function filtering(FilterInterface $filter): CategoryRepositoryInterface
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
