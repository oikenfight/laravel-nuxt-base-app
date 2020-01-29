<?php
declare(strict_types=1);

namespace App\Http\Repositories\Contracts;

namespace App\Repositories\Contracts;

use App\Entities\Contracts\ItemInterface;
use App\Repositories\Exceptions\ItemNotFoundException;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ItemRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface ItemRepositoryInterface extends RepositoryInterface
{
    /**
     * ItemRepositoryInterface constructor.
     *
     * @param ItemInterface $item
     */
    public function __construct(ItemInterface $item);

    /**
     * @return ItemRepositoryInterface
     */
    public function resetQuery(): ItemRepositoryInterface;

    /**
     * @param array $inputs
     *
     * @return ItemInterface
     */
    public function create(array $inputs): ItemInterface;

    /**
     * @param int $itemId
     *
     * @return ItemInterface
     * @throws ItemNotFoundException
     */
    public function find(int $itemId): ItemInterface;

    /**
     * @param int $itemId
     * @param array $inputs
     *
     * @return ItemInterface
     * @throws ItemNotFoundException
     */
    public function update(int $itemId, array $inputs): ItemInterface;

    /**
     * @param int $itemId
     *
     * @return bool
     * @throws ItemNotFoundException
     */
    public function delete(int $itemId): bool;

    /**
     * @return Collection|ItemInterface[]
     */
    public function all(): Collection;

    /**
     * @param FilterInterface $filter
     *
     * @return ItemRepositoryInterface
     */
    public function filtering(FilterInterface $filter): ItemRepositoryInterface;

    /**
     * @return int
     */
    public function count(): int;
}
