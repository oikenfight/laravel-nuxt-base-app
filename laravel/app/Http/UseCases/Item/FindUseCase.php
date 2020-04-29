<?php
declare(strict_types=1);

namespace App\Http\UseCases\Item;

use App\Entities\Contracts\ItemInterface;
use App\Http\UseCases\Contracts\Item\FindUseCaseInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;

/**
 * Class FindUseCase
 *
 * @package App\Http\UseCases\Item
 */
class FindUseCase implements FindUseCaseInterface
{
    /**
     * @var ItemRepositoryInterface
     */
    private $repository;

    /**
     * FindUseCase constructor.
     * @param ItemRepositoryInterface $repository
     */
    public function __construct(ItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $itemId
     * @return ItemInterface
     * @throws \App\Repositories\Exceptions\ItemNotFoundException
     */
    public function __invoke(int $itemId): ItemInterface
    {
        return $this->repository->find($itemId);
    }
}
