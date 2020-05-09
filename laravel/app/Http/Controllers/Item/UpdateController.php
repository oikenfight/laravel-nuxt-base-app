<?php
declare(strict_types=1);

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Item\UpdateUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class UpdateController
 *
 * @package App\Http\Controllers\Item
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
        $item = $useCase((int) $request->route('Item'), $request->get('item'));

        return response()->json([
            'item' => $item,
        ]);
    }
}
