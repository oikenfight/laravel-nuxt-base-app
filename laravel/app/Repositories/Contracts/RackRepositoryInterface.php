<?php
declare(strict_types=1);

namespace App\Http\Repositories\Contracts;

namespace App\Repositories\Contracts;

use App\Entities\Contracts\RackInterface;
use App\Repositories\Exceptions\RackNotFoundException;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface RackRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface RackRepositoryInterface extends RepositoryInterface
{
    /**
     * RackRepositoryInterface constructor.
     *
     * @param RackInterface $rack
     */
    public function __construct(RackInterface $rack);

    /**
     * @return RackRepositoryInterface
     */
    public function resetQuery(): RackRepositoryInterface;

    /**
     * @param array $inputs
     *
     * @return RackInterface
     */
    public function create(array $inputs): RackInterface;

    /**
     * @param int $rackId
     *
     * @return RackInterface
     * @throws RackNotFoundException
     */
    public function find(int $rackId): RackInterface;

    /**
     * @param int $rackId
     * @param array $inputs
     *
     * @return RackInterface
     * @throws RackNotFoundException
     */
    public function update(int $rackId, array $inputs): RackInterface;

    /**
     * @param int $rackId
     *
     * @return bool
     * @throws RackNotFoundException
     * @throws HasChildrenException
     */
    public function delete(int $rackId): bool;

    /**
     * @return Collection|RackInterface[]
     */
    public function all(): Collection;

    // /**
    //  * @param FilterInterface $filter
    //  *
    //  * @return RackRepositoryInterface
    //  */
    // public function filtering(FilterInterface $filter): RackRepositoryInterface;

    /**
     * @return int
     */
    public function count(): int;
}
