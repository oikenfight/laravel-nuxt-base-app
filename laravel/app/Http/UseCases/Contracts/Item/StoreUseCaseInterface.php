<?php
declare(strict_types=1);

namespace App\Http\UseCases\Contracts\Item;

use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\UserInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Interface StoreUseCaseInterface
 *
 * @package App\Http\UseCases\Contracts\Item
 */
interface StoreUseCaseInterface
{
    /**
     * StoreUseCaseInterface constructor.
     * @param ItemRepositoryInterface $repository
     */
    public function __construct(ItemRepositoryInterface $repository);

    /**
     * @param int $userId
     * @param int $noteId
     * @param array $itemData
     *
     * @return ItemInterface
     */
    public function __invoke(int $userId, int $noteId, array $itemData=[]): ItemInterface;
}
