<?php
declare(strict_types=1);

namespace App\Http\UseCases\Rack;

use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Rack\DeleteUseCaseInterface;
use App\Repositories\Contracts\RackRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class DeleteUseCase
 * @package App\Http\UseCases\Rack
 */
final class DeleteUseCase implements DeleteUseCaseInterface
{
    /**
     * @var RackRepositoryInterface
     */
    private $repository;

    /**
     * DeleteUseCase constructor.
     * @param RackRepositoryInterface $repository
     */
    public function __construct(RackRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $rackId
     * @param Request $request
     *
     * @return RackInterface
     * @throws \App\Repositories\Exceptions\RackNotFoundException
     */
    public function __invoke(int $rackId): bool
    {
        return $this->repository->delete($rackId);
    }
}
