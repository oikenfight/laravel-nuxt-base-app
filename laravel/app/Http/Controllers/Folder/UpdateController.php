<?php
declare(strict_types=1);

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Folder\UpdateUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class UpdateController
 *
 * @package App\Http\Controllers\Folder
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
        $folder = $useCase((int) $request->route('Folder'), $request->get('folder'));

        return response()->json([
            'folder' => $folder,
        ]);
    }
}
