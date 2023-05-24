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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone' => 'required|string|max:11|min:11|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',

        ];
    }
}
