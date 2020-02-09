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
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        // TODO: 認証ユーザを取得。ログイン機能未実装のため、暫定機に user1 とする
        /** @var UserInterface $user */
        $user = User::find(1);

        // TODO: UseCase 作る
        /** @var Collection|ItemInterface[] $items */
        $items = $user->items;
        $items = $items->keyBy('id')->all();

        return response()->json(['items' => $items]);
    }
}
