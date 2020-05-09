<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Rack;

use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Repositories\Contracts\RackRepositoryInterface;

/**
 * Interface StoreUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Rack
 */
interface StoreUseCaseInterface
{
    /**
     * StoreUseCaseInterface constructor.
     * @param RackRepositoryInterface $repository
     */
    public function __construct(RackRepositoryInterface $repository);

    /**
     * @param UserInterface $user
     * @param array $input
     *
     * @return RackInterface
     */
    public function __invoke(UserInterface $user, array $input=[]): RackInterface;
}
