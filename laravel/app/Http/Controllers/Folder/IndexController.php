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
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        // TODO: 認証ユーザを取得。ログイン機能未実装のため、暫定機に user1 とする
        /** @var UserInterface $user */
        $user = User::find(1);

        // TODO: UseCase 作る
        /** @var FolderInterface[] $folders */
        $folders = $user->folders;
        foreach ($folders as $key => $folder) {
            $folder['noteIds'] = $folder->notes->pluck('id');
        }

        return response()->json(['racks' => $folders]);
    }
}
