<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Entities\Contracts\UserInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Exceptions\UserNotFoundException;
use App\Repositories\Filters\Contracts\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @var UserInterface
     */
    private $eloquent;

    /**
     * @var Builder
     */
    private $query;

    /**
     * UserRepository constructor.
     *
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->eloquent = $user;
        $this->query = $user->newQuery();
    }

    /**
     * @return UserRepositoryInterface
     */
    public function resetQuery(): UserRepositoryInterface
    {
        $this->query = $this->eloquent->newQuery();
        return $this;
    }

    /**
     * @return UserRepository
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
     * @return UserInterface
     */
    public function create(array $inputs): UserInterface
    {
        $user = $this->eloquent->newInstance([
            'user_id' => array_get($inputs, 'user_id'),
            'note_id' => array_get($inputs, 'note_id'),
            'body' => array_get($inputs, 'body'),
            'order_index' => array_get($inputs, 'order_index'),
        ]);
        $user->save();

        return $user;
    }

    /**
     * @param int $userId
     *
     * @return UserInterface
     * @throws UserNotFoundException
     */
    public function find(int $userId): UserInterface
    {
        /** @var UserInterface $user */
        if (!$user = $this->query->find($userId)) {
            throw new UserNotFoundException('User '.$userId.' not found.');
        };

        return $user;
    }

    /**
     * @param int $userId
     * @param array $inputs
     *
     * @return UserInterface
     * @throws UserNotFoundException
     */
    public function update(int $userId, array $inputs): UserInterface
    {
        /** @var UserInterface $user */
        if (!$user = $this->query->find($userId)) {
            throw new UserNotFoundException('User '.$userId.' not found.');
        };

        $user->update([
            'user_id' => array_get($inputs, 'user_id'),
            'note_id' => array_get($inputs, 'note_id'),
            'body' => array_get($inputs, 'body'),
            'order_index' => array_get($inputs, 'order_index'),
        ]);

        return $user;
    }

    /**
     * @param int $userId
     *
     * @return bool
     * @throws UserNotFoundException
     * @throws \Exception "No primary key defined on model." のケースだが、 Eloquent の責務に於いてテストが終わっているものと考え、ここで \Exception::class を受ける処理や test は書かない。
     */
    public function delete(int $userId): bool
    {
        /** @var UserInterface $user */
        if (!$user = $this->query->find($userId)) {
            throw new UserNotFoundException('User '.$userId.' not found.');
        };

        $result = $user->delete();

        return $result;
    }

    /**
     * @return Collection|UserInterface[]
     */
    public function all(): Collection
    {
        $this->orderBy();
        return $this->query->get();
    }

    // /**
    //  * @param FilterInterface $filter
    //  *
    //  * @return UserRepositoryInterface
    //  */
    // public function filtering(FilterInterface $filter): UserRepositoryInterface
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
