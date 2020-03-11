<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User;

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
        $redirectURL = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
        \Log::debug($redirectURL);

        return response()->json([
            'redirect_url' => $redirectURL,
        ]);
    }

    /**
     * 各サイトからのコールバック
     *
     * @param string $provider サービス名
     * @return mixed
     */
    public function handleProviderCallback(string $provider)
    {
        /** @var User $socialUser */
        $socialUser = Socialite::driver($provider)->stateless()->user();

        /** @var UserInterface $user */
        $user = $this->user->firstOrNew(['email' => $socialUser->getEmail()]);

        // 新規ユーザの場合
        if (!$user->exists) {
            $user->name = $socialUser->getName();
            $user->provider_id = $socialUser->getId();
            $user->provider_name = $provider;
            $user->save();
        }

        $token = $user->createToken('access_token')->accessToken;

        \Log::debug($socialUser->getName());
        \Log::debug($token);

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
