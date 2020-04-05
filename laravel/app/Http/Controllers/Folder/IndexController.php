<?php
declare(strict_types=1);

namespace App\Http\Controllers\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\UserInterface;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class IndexController
 * @package App\Http\Controllers\Folder
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

        // TODO: UseCase 作る
        /** @var FolderInterface[] $folders */
        $folders = $user->folders;
        foreach ($folders as $key => $folder) {
            $folder['noteIds'] = $folder->notes->pluck('id');
        }

        return response()->json(['folders' => $folders]);
    }
}
