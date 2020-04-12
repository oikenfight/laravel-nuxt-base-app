<?php
declare(strict_types=1);

namespace App\Http\UseCases\Rack;

use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Rack\StoreUseCaseInterface;
use App\Repositories\Contracts\RackRepositoryInterface;

/**
 * Class StoreUseCase
 * @package App\Http\UseCases\Rack
 */
final class StoreUseCase implements StoreUseCaseInterface
{
    /**
     * @var RackRepositoryInterface
     */
    private $repository;

    /**
     * StoreUseCase constructor.
     * @param RackRepositoryInterface $repository
     */
    public function __construct(RackRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserInterface $user
     * @param array $input
     *
     * @return RackInterface
     */
    public function __invoke(UserInterface $user, array $input=[]): RackInterface
    {
        return $this->repository->create([
            'user_id' => $user->id,
            'name' => array_get($input, 'name'),
        ]);
    }
}
