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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|between:3,100',
            'price' => 'bail|required|numeric|max:2000000',
            'quantity_in_stock' => 'bail|required|integer|max:200000000|gt:0',
            'type_product' => 'bail|required|in:digital,physical',
            'description' => 'required|max:9000',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'required|image|between:2,10000'
        ];
    }
}
