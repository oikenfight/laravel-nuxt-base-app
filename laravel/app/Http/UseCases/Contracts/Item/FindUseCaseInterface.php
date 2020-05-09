<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Item;

use App\Entities\Contracts\ItemInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;

/**
 * Interface FindUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Item
 */
interface FindUseCaseInterface
{
    /**
     * FindUseCaseInterface constructor.
     * @param ItemRepositoryInterface $repository
     */
    public function __construct(ItemRepositoryInterface $repository);

    /**
     * @param int $itemId
     * @return ItemInterface
     */
    public function __invoke(int $itemId): ItemInterface;
}
