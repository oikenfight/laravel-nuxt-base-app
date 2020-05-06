<?php
declare(strict_types=1);

namespace App\Http\Controllers\Category;

use App\Entities\Contracts\CategoryInterface;
use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Category\StoreUseCaseInterface;
use App\Http\UseCases\Contracts\Rack\FindUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class StoreController
 *
 * @package App\Http\Controllers\Category
 */
final class StoreController extends Controller
{
    /**
     * @param Request $request
     * @param StoreUseCaseInterface $useCase
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, StoreUseCaseInterface $useCase)
    {
        /** @var UserInterface $user */
        $user = $request->user();

        /** @var CategoryInterface $category */
        $category = $useCase($user->id);

        return response()->json([
            'category' => $category
        ]);
    }
}
