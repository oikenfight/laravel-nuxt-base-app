<?php
declare(strict_types=1);

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Note\UpdateUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class UpdateController
 *
 * @package App\Http\Controllers\Note
 */
final class UpdateController extends Controller
{
    /**
     * @param Request $request
     * @param UpdateUseCaseInterface $useCase
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, UpdateUseCaseInterface $useCase)
    {
        $note = $useCase((int) $request->route('Note'), $request->get('note'));

        return response()->json([
            'note' => $note,
        ]);
    }
}
