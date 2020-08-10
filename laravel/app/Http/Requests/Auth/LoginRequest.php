<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user.email' => 'required|email',
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
