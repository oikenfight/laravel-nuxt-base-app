<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Rack;

use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Repositories\Contracts\RackRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Interface UpdateUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Rack
 */
interface UpdateUseCaseInterface
{
    /**
     * UpdateUseCaseInterface constructor.
     * @param RackRepositoryInterface $repository
     */
    public function __construct(RackRepositoryInterface $repository);

    /**
     * @param int $rackId
     * @param Request $request
     *
     * @return RackInterface
     */
    public function __invoke(int $rackId, Request $request): RackInterface;
}
