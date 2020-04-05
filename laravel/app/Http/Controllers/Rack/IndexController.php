<?php
declare(strict_types=1);

namespace App\Http\Controllers\Rack;

use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class IndexController
 * @package App\Http\Controllers\Rack
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

        // TODO: UseCase を作成する
        /** @var RackInterface[] $racks */
        $racks = $user->racks;
        foreach ($racks as $key => $rack) {
            $rack['folderIds'] = $rack->folders->pluck('id');
        }
        return response()->json(['racks' => $racks]);
    }
}
