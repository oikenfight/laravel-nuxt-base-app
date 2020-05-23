<?php
declare(strict_types=1);

namespace App\Http\UseCases\Item;

use App\Entities\Contracts\ItemInterface;
use App\Http\UseCases\Contracts\Item\UpdateNoteItemsUseCaseInterface;
use App\Repositories\Contracts\ItemRepositoryInterface;

/**
 * Class UpdateNoteItemsUseCase
 * @package App\Http\UseCases\Item
 */
final class UpdateNoteItemsUseCase implements UpdateNoteItemsUseCaseInterface
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
     * @param array $items
     *
     * @return ItemInterface
     * @throws \App\Repositories\Exceptions\ItemNotFoundException
     */
    public function __invoke(array $items): array
    {
        $results = [];
        foreach ($items as $item) {
            $itemId = array_get($item, 'id');
            \Log::debug('here is usecase');
            \Log::debug($itemId);
            \Log::debug($item);
            $result = $this->repository->update(array_get($item, 'id'), [
                'note_id' => array_get($item, 'note_id'),
                'body' => array_get($item, 'body') ?? '',
                'order_index' => array_get($item, 'order_index')
            ]);
            $results[] = $result;
            $this->repository->resetQuery();
        }
        return $results;
    }
}
