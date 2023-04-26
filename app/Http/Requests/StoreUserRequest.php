<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $userId = $this->route('user') ? $this->route('user'): null;
        return [
            'first_name' => 'required|max:16|alpha',
            'last_name' => 'required|max:16|alpha',
            'email' => 'bail|required|email|max:128|unique:users',
            'phone_number' => 'required|numeric|digits:10|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'bail|required|same:password',
            'employee_id' => 'numeric|unique:users',
            'avatar' => 'required',
            'department' => 'required',
            'profile_text' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'status' => 'required|in:0,1',
        ];
    }
}
