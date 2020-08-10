<?php
declare(strict_types=1);

namespace App\Http\Controllers\View\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class IndexController
 *
 * @package App\Http\Controllers\Category
 */
final class IndexController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, CategoryRepositoryInterface $repository)
    {
        // TODO: create UseCase
        /** @var CategoryInterface[] $categories */
        $categories = $repository->all();

        return response()->json(['categories' => $categories]);
    }
}
