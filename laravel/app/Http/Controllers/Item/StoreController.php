<?php
declare(strict_types=1);

namespace App\Http\Controllers\Item;

use App\Entities\Contracts\ItemInterface;
use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Item\StoreUseCaseInterface;
use App\Http\UseCases\Contracts\Note\FindUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class StoreController
 *
 * @package App\Http\Controllers\Item
 */
final class StoreController extends Controller
{
    /**
     * @param Request $request
     * @param StoreUseCaseInterface $useCase
     * @param FindUseCaseInterface $findUseCase
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, StoreUseCaseInterface $useCase, FindUseCaseInterface $findUseCase)
    {
        /** @var UserInterface $user */
        $user = $request->user();

        /** @var NoteInterface $note */
        $note = $findUseCase((int) $request->get('noteId'));

        /** @var ItemInterface $item */
        $item = $useCase($user->id, $note->id);

        return response()->json([
            'item' => $item
        ]);
    }
}
