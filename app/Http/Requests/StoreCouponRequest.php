<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequest
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
            'product_id' => 'bail|required|numeric|exists:products,id',
            'code' => 'nullable|alpha_num:ascii|unique:coupons|max:20|min:6',
            'expiration_date' => 'bail|required|date|after:today',
            'discount' => 'bail|required|integer|between:1,100',
            'usage_limit' => 'bail|required|integer|min:1|max:1000000'
        ];
    }

    public function messages()
    {
        return [
            "product_id.required" => "The product field is required.",
            'expiration_date.after' => 'your coupon should be valid at least for 1 day'
        ];
    }
}
