<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateUserRequest extends FormRequest
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
            'first_name' => 'nullable|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'password' => 'bail|nullable|confirmed|min:8|string',
            'current_password' => [
                function($attribute, $value, $fail){
                    if(!empty(request()->password)){
                        if(!Hash::check($value, auth()->user()->password)){
                            $fail('current password incorrent.');
                        }
                    } 
                }
            ],
            'phone_number' => 'nullable|max:25|regex:/^\([0-9]{3}\)\s[0-9]{9}$/',
            'email' => 'nullable|email|max:255|unique:users',
            'avatar' => 'nullable|image'
        ];
    }
}
