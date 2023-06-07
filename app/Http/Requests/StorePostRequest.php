<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
        // dd($this->request);
        return [
            'url' => 'string',
            'name' => 'required|string|min:3|max:20',
            'description' => 'required|string|min:3|max:500',
            'summary' => 'required|string|min:3|max:100',
        ];
    }
}
