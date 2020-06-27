<?php
declare(strict_types=1);

namespace App\Http\Controllers\View\Note;

use App\Entities\Contracts\NoteInterface;
use App\Entities\Note;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\NoteRepositoryInterface;
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
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, NoteRepositoryInterface $repository)
    {
        // TODO: create UseCase
        /** @var NoteInterface[] $notes */
        $notes = $repository->all()->where('status', Note::STATUS_RELEASE);

        return response()->json(['notes' => $notes]);
    }
}
