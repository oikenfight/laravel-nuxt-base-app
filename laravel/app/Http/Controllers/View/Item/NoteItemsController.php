<?php
declare(strict_types=1);

namespace App\Http\Controllers\View\Item;

use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\NoteInterface;
use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Note\FindUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class NoteItemsController
 * @package App\Http\Controllers\View\Item
 */
final class NoteItemsController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, FindUseCaseInterface $findUseCase)
    {
        /** @var NoteInterface $note */
        $note = $findUseCase((int)$request->route('Note'));

        /** @var ItemInterface[] $items */
        $items = $note->items()->get();

        return response()->json(['items' => $items]);
    }
}
