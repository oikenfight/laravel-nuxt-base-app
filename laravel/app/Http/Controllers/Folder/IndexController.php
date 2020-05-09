<?php
declare(strict_types=1);

namespace App\Http\Controllers\Folder;

use App\Entities\Contracts\FolderInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Services\ResponseDataMakers\Contracts\ResponseFoldersMakerInterface;
use Illuminate\Http\Request;

/**
 * Class IndexController
 *
 * @package App\Http\Controllers\Folder
 */
final class IndexController extends Controller
{
    /**
     * @param Request $request
     * @param ResponseFoldersMakerInterface $responseMaker
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        /** @var UserInterface $user */
        $user = $request->user();

        /** @var FolderInterface[] $folders */
        $folders = $user->folders()->get();

        return response()->json(['folders' => $folders]);
    }
}
