<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:16',
            'last_name' => 'required|max:16',
            'email' => 'bail|required|email|max:128',
            'phone_number' => 'bail|required|numeric|size:10',
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
