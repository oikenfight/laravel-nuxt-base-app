<?php
declare(strict_types=1);

namespace App\Http\Controllers\Folder;

use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Folder\DeleteUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class DestroyController
 *
 * @package App\Http\Controllers\Folder
 */
final class DestroyController extends Controller
{
    /**
     * @param Request $request
     * @param DeleteUseCaseInterface $useCase
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, DeleteUseCaseInterface $useCase)
    {
        $useCase((int) $request->route('Folder'));

        return response()->json([
            'result' => 'success',
        ]);
    }
}
