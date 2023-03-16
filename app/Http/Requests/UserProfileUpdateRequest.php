<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileUpdateRequest extends FormRequest
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
            'employee_id' => 'max:16',
            'title' => 'max:255',
            'department' => 'max:16',
            'country_id' => 'required',
            'city_id' => 'required',

        ];
    }
}
