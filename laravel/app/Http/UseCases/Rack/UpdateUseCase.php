<?php
declare(strict_types=1);

namespace App\Http\UseCases\Rack;

use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\UseCases\Contracts\Rack\UpdateUseCaseInterface;
use App\Repositories\Contracts\RackRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class UpdateUseCase
 * @package App\Http\UseCases\Rack
 */
final class UpdateUseCase implements UpdateUseCaseInterface
{
    /**
     * @var RackRepositoryInterface
     */
    private $repository;

    /**
     * UpdateUseCase constructor.
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
    public function __invoke(int $rackId, Request $request): RackInterface
    {
        $input = $request->only([
            'rack.name'
        ]);

        return $this->repository->update($rackId, $input);
    }
}
