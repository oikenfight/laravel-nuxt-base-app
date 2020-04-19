<?php
declare(strict_types=1);

namespace App\Http\Controllers\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Folder\StoreUseCaseInterface;
use Illuminate\Http\Request;

/**
 * Class StoreController
 *
 * @package App\Http\Controllers\Folder
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

        /** @var FolderInterface $folder */
        $folder = $useCase($user);

        return response()->json([
            'folder' => $folder
        ]);
    }
}
