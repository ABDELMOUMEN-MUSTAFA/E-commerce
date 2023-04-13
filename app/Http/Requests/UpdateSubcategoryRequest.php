<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubcategoryRequest extends FormRequest
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
            "name" => "bail|required|between:3,70|regex:/^[a-zA-Z0-9\s]+$/",
            "category_id" => "required|exists:categories,id",
        ];
    }

    public function messages()
    {
        return [
            "name.regex" => "Subcategory name except only alphanumeric and spaces.",
        ];
    }
}
