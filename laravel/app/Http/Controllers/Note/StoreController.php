<?php
declare(strict_types=1);

namespace App\Http\Controllers\Note;

use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Note\StoreUseCaseInterface;
use App\Http\UseCases\Contracts\Folder\FindUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class StoreController
 *
 * @package App\Http\Controllers\Note
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

        /** @var FolderInterface $folder */
        $folder = $findUseCase((int) $request->get('folderId'));

        /** @var NoteInterface $note */
        $note = $useCase($user->id, $folder->id);

        return response()->json([
            'note' => $note
        ]);
    }
}
