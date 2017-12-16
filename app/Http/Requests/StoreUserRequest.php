<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'github_id' => 'unique:users',
            'github_name' => 'string',
            'name' => 'alpha_num|required|unique:users',
            'email' => 'email|required|unique:users',
            'github_url' => 'url',
            'avatar' => 'url',
            'password' => 'required|confirmed|min:6'
        ];
    }
}
