<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'account' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z]+$/'],
            'password' => ['required', 'between:5,20', 'regex:/^[0-9a-zA-Z!@]+$/'],
        ];

        if($this->routeIs('auth.login')) {
            $rules['account'][] = 'exists:users,account';
        } else if($this->routeIs('user.store')) {
            $rules['account'][] = 'unique:users,account';
            $rules['password_chk'] = ['same:password'];
            $rules['name'] = ['required', 'between:1, 20', 'regex:/^[가-힣]+$/u'];
            $rules['gender'] = ['required', 'regex:/^[0-1]{1}$/'];
            $rules['profile'] = ['required', 'image'];
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator) {
        $response = response()->json([
            'success' => false,
            'msg' => '유효성 체크 오류',
            'data' => $validator->errors()
        ], 422);

        throw new HttpResponseException($response);
    }
}
