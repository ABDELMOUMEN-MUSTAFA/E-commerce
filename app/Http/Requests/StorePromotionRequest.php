<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class StorePromotionRequest extends FormRequest
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
            'discount' => 'required|integer|min:1|max:100',
            'start_date' => [
                'required', 
                'date', 
                'after:yesterday',
                function($attribute, $value, $fail) {
                    $inputStartDate = new \Carbon\Carbon($value);
                    $lastPromotionEndDate = $this->route('product')->promotions->max('end_date');

                    if($lastPromotionEndDate > $inputStartDate){
                        $fail("There is already promotion running in that date, please choose a day after {$lastPromotionEndDate->format('m/d/Y')}");
                    }
                }
            ],
            'end_date' => [
                'bail',
                'required',
                'date',
                'after:start_date'
            ],

        ];
    }
}
