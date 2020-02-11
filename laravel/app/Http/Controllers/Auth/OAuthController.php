<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Entities\Contracts\UserInterface;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class OAuthController
 * @package App\Http\Controllers\Auth
 */
final class OAuthController extends Controller
{
    /**
     * @var UserInterface
     */
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * 各SNSのOAuth認証画面にリダイレクトして認証
     *
     * @param string $provider serviceName
     * @return mixed
     */
    public function socialOAuth(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * 各サイトからのコールバック
     *
     * @param string $provider サービス名
     * @return mixed
     */
    public function handleProviderCallback(string $provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        $user = $this->user->firstOrNew(['email' => $socialUser->getEmail()]);

        if ($user->exists) {
            abort(403);
        }

        $user->name = $socialUser->getName();
        $user->provider_id = $socialUser->getId();
        $user->provider_name = $provider;
        $user->save();

        dd($user);

        return redirect()->route('http://localhost');
    }
}
