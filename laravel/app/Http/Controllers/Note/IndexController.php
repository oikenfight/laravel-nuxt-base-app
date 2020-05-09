<?php
declare(strict_types=1);

namespace App\Http\Controllers\Note;

use App\Entities\Contracts\NoteInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Services\ResponseDataMakers\Contracts\ResponseNotesMakerInterface;
use Illuminate\Http\Request;

/**
 * Class IndexController
 *
 * @package App\Http\Controllers\Note
 */
final class IndexController extends Controller
{
    /**
     * @param Request $request
     * @param ResponseNotesMakerInterface $responseMaker
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        /** @var UserInterface $user */
        $user = $request->user();

        /** @var NoteInterface[] $notes */
        $notes = $user->notes()->get();

        return response()->json(['notes' => $notes]);
    }
}
