<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules() : array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'bail|required|email',
            'phone_number' => 'bail|required|numeric',
            'password' => 'required',
            'confirm_password' => 'bail|required|same:password',
            'employee_id' => 'numeric',
            'avatar' => 'required',
            'department' => 'required',
            'profile_text' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'status'=>'required',
        ];
    }
}