<?php
declare(strict_types=1);

namespace App\Http\Controllers\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Folder\StoreUseCaseInterface;
use App\Http\UseCases\Contracts\Rack\FindUseCaseInterface;
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
     * @param FindUseCaseInterface $findUseCase
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, StoreUseCaseInterface $useCase, FindUseCaseInterface $findUseCase)
    {
        /** @var UserInterface $user */
        $user = $request->user();

        /** @var RackInterface $rack */
        $rack = $findUseCase((int) $request->get('rackId'));

        /** @var FolderInterface $folder */
        $folder = $useCase($user->id, $rack->id);

        return response()->json([
            'folder' => $folder
        ]);
    }
}
