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
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        /** @var UserInterface $user */
        $user = $request->user();

        // TODO: UseCase 作る
        /** @var NoteInterface[] $notes */
        $notes = $user->notes;
        foreach ($notes as $key => $note) {
            $note['itemIds'] = $note->items->sortBy('order_index')->pluck('id');
        }

        return response()->json(['notes' => $notes]);
    }
}
