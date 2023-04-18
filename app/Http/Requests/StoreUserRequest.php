<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'password' => 'bail|required|min:8|string',
            'phone_number' => 'required|max:25|regex:/^\([0-9]{3}\)\s[0-9]{9}$/',
            'email' => 'required|email|max:255|unique:users',
            'country_id' => 'required|integer|exists:countries,id'
        ];
    }

    public function messages()
    {
        return [
            'country_id.required' => 'The country is required.'
        ];
    }
}
