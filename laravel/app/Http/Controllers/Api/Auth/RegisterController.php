<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Hash;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Api\Auth
 */
final class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function create(RegisterRequest $request)
    {
        // TODO: UseCaseを作る
        // TODO: UserRepositoryの実装サボってたのでちゃんとやる
        $user = User::create([
            'name' => $request->input('user.name'),
            'email' => $request->input('user.email'),
            'password' => Hash::make($request->input('user.password')),
        ]);

        return response()->json([
            'user' => $user,
            'status' => 200
        ]);
    }
}
