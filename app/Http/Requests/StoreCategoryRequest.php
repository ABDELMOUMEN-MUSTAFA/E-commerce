<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            "description" => "nullable|between:10,250",
            "photo" => "nullable|image|between:2,512",
        ];
    }

    public function messages()
    {
        return [
            "name.regex" => "Category name except only alphanumeric and spaces.",
            "photo.image" => "Please provide a valid image (jpg, jpeg, png, bmp, gif, svg, or webp)."
        ];
    }
}
