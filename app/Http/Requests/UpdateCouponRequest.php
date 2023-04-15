<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCouponRequest extends FormRequest
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
            'expiration_date' => 'bail|required|date|after:today',
            'discount' => 'bail|required|integer|between:1,100',
            'usage_limit' => 'bail|required|integer|min:1|max:1000000'
        ];
    }

    public function messages()
    {
        return [
            'expiration_date.after' => 'your coupon should be valid at least for 1 day'
        ];
    }
}
