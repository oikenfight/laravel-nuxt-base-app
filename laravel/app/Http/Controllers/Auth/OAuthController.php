<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Entities\Contracts\RackInterface;
use App\Entities\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\UseCases\Contracts\Rack\StoreUseCaseInterface;
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
     * @param StoreUseCaseInterface $useCase
     * @param string $provider
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleProviderCallback(StoreUseCaseInterface $useCase, string $provider)
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

            // create default rack
            /** @var RackInterface $rack */
            $rack = $useCase($user, [
                'name' => 'sample'
            ]);
            // TODO: create default folder
        }

        $token = $user->createToken('access_token')->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
