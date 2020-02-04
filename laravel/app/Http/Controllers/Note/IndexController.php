<?php
declare(strict_types=1);

namespace App\Http\Controllers\Note;

use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class IndexController
 * @package App\Http\Controllers\Note
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
        /** @var NoteInterface[] $notes */
        $notes = $user->notes;
        foreach ($notes as $key => $note) {
            $note['itemsIds'] = $note->items->sortBy('order_index')->pluck('id');
        }

        return response()->json(['notes' => $notes]);
    }
}
