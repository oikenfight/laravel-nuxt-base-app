<?php
declare(strict_types=1);

namespace App\Http\UseCases\Rack;

use App\Entities\Contracts\RackInterface;
use App\Http\UseCases\Contracts\Rack\FindUseCaseInterface;
use App\Repositories\Contracts\RackRepositoryInterface;

/**
 * Class FindUseCase
 * @package App\Http\UseCases\Rack
 */
final class FindUseCase implements FindUseCaseInterface
{
    /**
     * @var RackRepositoryInterface
     */
    private $repository;

    /**
     * FindUseCase constructor.
     * @param RackRepositoryInterface $repository
     */
    public function __construct(RackRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $rackId
     *
     * @return RackInterface
     * @throws \App\Repositories\Exceptions\RackNotFoundException
     */
    public function __invoke(int $rackId): RackInterface
    {
        return $this->repository->find($rackId);
    }
}
