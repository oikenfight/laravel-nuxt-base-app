<?php
declare(strict_types=1);

namespace App\Http\Controllers\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Services\ResponseDataMakers\Contracts\ResponseCategorysMakerInterface;
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
    public function __invoke(Request $request)
    {
        /** @var UserInterface $user */
        $user = $request->user();

        /** @var CategoryInterface[] $categories */
        $categories = $user->categories()->get();

        return response()->json(['categories' => $categories]);
    }
}
