<?php
declare(strict_types=1);

namespace App\Http\Controllers\Item;

use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\UserInterface;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class IndexController
 * @package App\Http\Controllers\Item
 */
final class IndexController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        /** @var UserInterface $user */
        $user = $request->user();

        // TODO: UseCase 作る
        /** @var Collection|ItemInterface[] $items */
        $items = $user->items;
        $items = $items->keyBy('id')->all();

        return response()->json(['items' => $items]);
    }
}
