<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Item;

use App\Entities\Contracts\ItemInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;

/**
 * Interface UpdateNoteItemsUseCaseInterface
 * @package App\Http\UseCases\Contracts\Item
 */
interface UpdateNoteItemsUseCaseInterface
{
    /**
     * UpdateUseCaseInterface constructor.
     * @param ItemRepositoryInterface $repository
     */
    public function __construct(ItemRepositoryInterface $repository);

    /**
     * @param array $items
     *
     * @return array
     */
    public function __invoke(array $items): array;
}
