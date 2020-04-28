<?php
declare(strict_types=1);

namespace App\Http\Controllers\Item;

use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Services\ResponseDataMakers\Contracts\ResponseItemsMakerInterface;
use Illuminate\Http\Request;

/**
 * Class IndexController
 *
 * @package App\Http\Controllers\Item
 */
final class IndexController extends Controller
{
    /**
     * @param Request $request
     * @param ResponseItemsMakerInterface $responseMaker
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        /** @var UserInterface $user */
        $user = $request->user();

        /** @var ItemInterface[] $items */
        $items = $user->items()->get();

        return response()->json(['items' => $items]);
    }
}
