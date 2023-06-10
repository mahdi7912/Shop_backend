<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'phone' => 'string|max:11|min:11',
            'email' => 'email',
            'password' => 'min:8|string',
            'firstname' => 'string',
            'lastname' => 'string',
            'premissions.*' => 'exists:premissions,id',
            'roles.*' => 'exists:premissions,id'
        ];
    }
}
