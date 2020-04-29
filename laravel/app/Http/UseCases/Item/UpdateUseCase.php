<?php
declare(strict_types=1);

namespace App\Http\UseCases\Item;

use App\Entities\Contracts\ItemInterface;
use App\Http\UseCases\Contracts\Item\UpdateUseCaseInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;

/**
 * Class UpdateUseCase
 * @package App\Http\UseCases\Item
 */
final class UpdateUseCase implements UpdateUseCaseInterface
{
    /**
     * @var ItemRepositoryInterface
     */
    private $repository;

    /**
     * UpdateUseCase constructor.
     * @param ItemRepositoryInterface $repository
     */
    public function __construct(ItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $itemId
     * @param array $itemData
     *
     * @return ItemInterface
     * @throws \App\Repositories\Exceptions\ItemNotFoundException
     */
    public function __invoke(int $itemId, array $itemData): ItemInterface
    {
        return $this->repository->update($itemId, [
            'note_id' => array_get($itemData, 'note_id'),
            'body' => array_get($itemData, 'body'),
        ]);
    }
}
