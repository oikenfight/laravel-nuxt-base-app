<?php
declare(strict_types=1);

namespace Tests\Unit\app\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User;
use Mockery;
use Tests\Unit\TestCase;

/**
 * Class OAuthControllerTest
 *
 * @package Tests\Unit\app\Http\Controllers\Auth
 */
final class OAuthControllerTest extends TestCase
{
    // TODO 他のプロバイダもテストする
    const PROVIDER_NAME = 'google';

    private $provider;

    /**
     * @var string
     */
    private $providerName;

    /**
     * set up
     */
    public function setUp(): void
    {
        parent::setUp();
        // 存在しないメソッドを shouldReceive するとエラー（ライブラリのメソッド変更を検知するため）
        Mockery::getConfiguration()->allowMockingNonExistentMethods(false);
    }

    /**
     * tear down
     */
    public static function tearDownAfterClass(): void
    {
        // 設定をもとに戻す
        Mockery::getConfiguration()->allowMockingNonExistentMethods(true);
    }

    /**
     * 認証画面を表示することを確認
     *
     * @return void
     */
    public function testSocialOAuthGetValidStatus()
    {
//        // スタータスコードが 302（リダイレクト）であることを確認
//        $response = $this->get(route('socialOAuth', ['provider' => self::PROVIDER_NAME]));
//        $response->assertStatus(302);
//
//        $target = parse_url($response->headers->get(('location')));
//        // リダイレクト先のドメインが期待したものであるかどうか
//        $this->assertEquals('accounts.google.com', $target['host']);
//
//        // リダイレクトURLやクライアントIDは期待通りの設定がされているか
//        $query = explode('&', $target['query']);
//        $this->assertContains('redirect_uri=' . urlencode(config('services.google.redirect')), $query);
//        $this->assertContains('client_id=' . config('services.google.client_id'), $query);
        $this->assertTrue(false);
    }

    /**
     * 取得したアカウントでユーザ登録できることを確認
     *
     * @return void
     */
    public function testHandleProviderCallback()
    {
//        Socialite::shouldReceive('driver')->with($this->providerName)->andReturn($this->provider);
//
//        // URLをコール
//        $this->get(route('oauthCallback', ['provider' => self::PROVIDER_NAME]))->assertStatus(200);
//
//        /** @var Mockery\Mock|User $user */
//        $user = Mockery::mock(User::class);
//        $user->shouldReceive('getId')->andReturn(uniqid());
//        $user->shouldReceive('getEmail')->andReturn(uniqid() . '@test.com');
//        $user->shouldReceive('getNickname')->andReturn('test');
//
//        $this->provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
//        $this->provider->shouldReceive('user')->andReturn($user);
//
//        $user->shouldReceive('save')->once()->with();
//
//        // 認証チェック
//        $this->assertAuthenticated();
        $this->assertTrue(false);
    }
}
