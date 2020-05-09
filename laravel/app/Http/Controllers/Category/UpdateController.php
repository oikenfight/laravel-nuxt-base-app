<?php
declare(strict_types=1);

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Category\UpdateUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class UpdateController
 *
 * @package App\Http\Controllers\Category
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
        $category = $useCase((int) $request->route('Category'), $request->get('category'));

        return response()->json([
            'category' => $category,
        ]);
    }
}
