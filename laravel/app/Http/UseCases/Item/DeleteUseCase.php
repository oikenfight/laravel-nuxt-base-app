<?php
declare(strict_types=1);

namespace App\Http\UseCases\Item;

use App\Entities\Contracts\ItemInterface;
use App\Http\UseCases\Contracts\Item\DeleteUseCaseInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class DeleteUseCase
 * @package App\Http\UseCases\Item
 */
final class DeleteUseCase implements DeleteUseCaseInterface
{
    /**
     * @var ItemRepositoryInterface
     */
    private $repository;

    /**
     * DeleteUseCase constructor.
     * @param ItemRepositoryInterface $repository
     */
    public function __construct(ItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $itemId
     * @param Request $request
     *
     * @return ItemInterface
     * @throws \App\Repositories\Exceptions\ItemNotFoundException
     */
    public function __invoke(int $itemId): bool
    {
        return $this->repository->delete($itemId);
    }
}
