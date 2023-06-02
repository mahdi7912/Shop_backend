<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string|min:5|max:200',
            'image' => 'file|mimes:png,jpg',
            'price' => 'numeric|required',
            'remaining' => 'integer|required|min:0',
            'category_id' => 'required'
        ];
    }
}
