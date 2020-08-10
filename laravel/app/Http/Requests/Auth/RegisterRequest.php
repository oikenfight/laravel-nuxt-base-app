<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Entities\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

final class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user.name' => 'required|string|min:1|max:255',
            'user.email' => 'required|email|unique:'.User::class.',email',
            'user.password' => 'required|min:4|max:255',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $res = response()->json([
            'messages' => $validator->errors(),
            'status' => 400
        ]);

        throw new HttpResponseException($res);
    }
}
