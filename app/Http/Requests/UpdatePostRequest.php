<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'name' => 'string|min:3|max:20',
            'description' => 'string|min:3|max:1000',
            'summary' => 'string|min:3|max:300',
            'category_id' => 'exists:categories,id',
            'user_id' => 'exists:users,id',

        ];
    }
}
