<?php
declare(strict_types=1);

namespace App\Http\Repositories\Contracts;

namespace App\Repositories\Contracts;

use App\Entities\Contracts\CategoryInterface;
use App\Repositories\Exceptions\CategoryNotFoundException;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface CategoryRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface CategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * CategoryRepositoryInterface constructor.
     *
     * @param CategoryInterface $category
     */
    public function __construct(CategoryInterface $category);

    /**
     * @return CategoryRepositoryInterface
     */
    public function resetQuery(): CategoryRepositoryInterface;

    /**
     * @param array $inputs
     *
     * @return CategoryInterface
     */
    public function create(array $inputs): CategoryInterface;

    /**
     * @param int $categoryId
     *
     * @return CategoryInterface
     * @throws CategoryNotFoundException
     */
    public function find(int $categoryId): CategoryInterface;

    /**
     * @param int $categoryId
     * @param array $inputs
     *
     * @return CategoryInterface
     * @throws CategoryNotFoundException
     */
    public function update(int $categoryId, array $inputs): CategoryInterface;

    /**
     * @param int $categoryId
     *
     * @return bool
     * @throws CategoryNotFoundException
     */
    public function delete(int $categoryId): bool;

    /**
     * @return Collection|CategoryInterface[]
     */
    public function all(): Collection;

    // /**
    //  * @param FilterInterface $filter
    //  *
    //  * @return CategoryRepositoryInterface
    //  */
    // public function filtering(FilterInterface $filter): CategoryRepositoryInterface;

    /**
     * @return int
     */
    public function count(): int;
}
