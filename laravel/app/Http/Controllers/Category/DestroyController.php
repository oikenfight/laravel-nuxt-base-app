<?php
declare(strict_types=1);

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Category\DeleteUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class DestroyController
 *
 * @package App\Http\Controllers\Category
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
        $useCase((int) $request->route('Category'));

        return response()->json([
            'result' => 'success',
        ]);
    }
}
