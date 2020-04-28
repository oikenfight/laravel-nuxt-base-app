<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Item;

use App\Entities\Contracts\ItemInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;

/**
 * Interface UpdateUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Item
 */
interface UpdateUseCaseInterface
{
    /**
     * UpdateUseCaseInterface constructor.
     * @param ItemRepositoryInterface $repository
     */
    public function __construct(ItemRepositoryInterface $repository);

    /**
     * @param int $itemId
     * @param array $itemData
     *
     * @return ItemInterface
     */
    public function __invoke(int $itemId, array $itemData): ItemInterface;
}
