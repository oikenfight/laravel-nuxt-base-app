<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Item;

use App\Repositories\Contracts\ItemRepositoryInterface;

/**
 * Interface DeleteUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Item
 */
interface DeleteUseCaseInterface
{
    /**
     * DeleteUseCaseInterface constructor.
     * @param ItemRepositoryInterface $repository
     */
    public function __construct(ItemRepositoryInterface $repository);

    /**
     * @param int $itemId
     * @return bool
     */
    public function __invoke(int $itemId): bool;
}
