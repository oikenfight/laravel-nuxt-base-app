<?php
declare(strict_types=1);

namespace App\Http\UseCases\Item;

use App\Entities\Contracts\ItemInterface;
use App\Http\UseCases\Contracts\Item\StoreUseCaseInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;

/**
 * Class StoreUseCase
 * @package App\Http\UseCases\Item
 */
final class StoreUseCase implements StoreUseCaseInterface
{
    /**
     * @var ItemRepositoryInterface
     */
    private $repository;

    /**
     * StoreUseCase constructor.
     * @param ItemRepositoryInterface $repository
     */
    public function __construct(ItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $userId
     * @param int $noteId
     * @param array $itemData
     *
     * @return ItemInterface
     */
    public function __invoke(int $userId, int $noteId, array $itemData=[]): ItemInterface
    {
        return $this->repository->create([
            'user_id' => $userId,
            'note_id' => $noteId,
            'name' => array_get($itemData, 'name'),
        ]);
    }
}
