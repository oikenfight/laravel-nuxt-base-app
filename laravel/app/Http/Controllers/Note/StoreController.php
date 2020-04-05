<?php
declare(strict_types=1);

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\UseCases\Folder\FindUseCase;
use App\Http\UseCases\Note\StoreUseCase;
use Illuminate\Http\Request;

/**
 * Class StoreController
 * @package App\Http\Controllers\Note
 */
final class StoreController extends Controller
{
    /**
     * @param Request $request
     * @param StoreUseCase $useCase
     * @param FindUseCase $findUseCase
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Repositories\Exceptions\FolderNotFoundException
     */
    public function __invoke(Request $request, StoreUseCase $useCase, FindUseCase $findUseCase)
    {
        /** UserInterface $user */
        $user = $request->user();

        /** FolderInterface $folder */
        $folder = $findUseCase($request->input('folder_id'));

        /** NoteInterface $note */
        $note = $useCase($user, $folder);

        return response()->json([
            'note' => $note
        ]);
    }
}
