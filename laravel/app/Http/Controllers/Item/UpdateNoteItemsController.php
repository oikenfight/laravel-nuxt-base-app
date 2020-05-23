<?php
declare(strict_types=1);

namespace App\Http\Controllers\Item;

use App\Entities\Contracts\ItemInterface;
use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Item\UpdateNoteItemsUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class UpdateNoteItemsController
 *
 * @package App\Http\Controllers\Item
 */
final class UpdateNoteItemsController extends Controller
{
    public function __invoke(Request $request, UpdateNoteItemsUseCaseInterface $useCase)
    {
        /** @var array $items */
        $items = $request->get('items');

        $useCase($items);

        return response()->json([
            'status' => 200,
            'message' => 'success'
        ]);
    }
}
