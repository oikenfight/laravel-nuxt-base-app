<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Rack;

use App\Entities\Contracts\RackInterface;
use App\Repositories\Contracts\RackRepositoryInterface;

/**
 * Interface FindUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Rack
 */
interface FindUseCaseInterface
{
    /**
     * FindUseCaseInterface constructor.
     * @param RackRepositoryInterface $repository
     */
    public function __construct(RackRepositoryInterface $repository);

    /**
     * @param int $rackId
     *
     * @return RackInterface
     */
    public function __invoke(int $rackId): RackInterface;
}
