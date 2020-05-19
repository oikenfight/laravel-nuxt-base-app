<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    protected function create(Request $request)
    {
        // TODO: UseCaseを作る
        // TODO: UserRepositoryの実装サボってたのでちゃんとやる
        return User::create([
            'name' => $request->input('user.name'),
            'email' => $request->input('user.email'),
            'password' => Hash::make($request->input('user.password')),
        ]);
    }
}
