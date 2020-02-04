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
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        // TODO: 認証ユーザを取得。ログイン機能未実装のため、暫定機に user1 とする
        /** @var UserInterface $user */
        $user = User::find(1);

        // TODO: UseCase を作成する
        /** @var RackInterface[] $racks */
        $racks = $user->racks;
        foreach ($racks as $key => $rack) {
            $rack['folderIds'] = $rack->folders->pluck('id');
        }

        return response()->json(['racks' => $racks]);
    }
}
