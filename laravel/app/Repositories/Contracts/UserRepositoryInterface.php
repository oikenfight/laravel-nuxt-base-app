<?php
declare(strict_types=1);

namespace App\Http\Repositories\Contracts;

namespace App\Repositories\Contracts;

use App\Entities\Contracts\UserInterface;
use App\Repositories\Exceptions\UserNotFoundException;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserRepositoryInterface
 *
 * @package App\Repositories\Contracts
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * UserRepositoryInterface constructor.
     *
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user);

    /**
     * @return UserRepositoryInterface
     */
    public function resetQuery(): UserRepositoryInterface;

    /**
     * @param array $inputs
     *
     * @return UserInterface
     */
    public function create(array $inputs): UserInterface;

    /**
     * @param int $userId
     *
     * @return UserInterface
     * @throws UserNotFoundException
     */
    public function find(int $userId): UserInterface;

    /**
     * @param int $userId
     * @param array $inputs
     *
     * @return UserInterface
     * @throws UserNotFoundException
     */
    public function update(int $userId, array $inputs): UserInterface;

    /**
     * @param int $userId
     *
     * @return bool
     * @throws UserNotFoundException
     */
    public function delete(int $userId): bool;

    /**
     * @return Collection|UserInterface[]
     */
    public function all(): Collection;

    // /**
    //  * @param FilterInterface $filter
    //  *
    //  * @return UserRepositoryInterface
    //  */
    // public function filtering(FilterInterface $filter): UserRepositoryInterface;

    /**
     * @return int
     */
    public function count(): int;
}
