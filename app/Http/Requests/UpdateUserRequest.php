<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $userId = $this->route('user');
        return [
            'first_name' => 'required|max:16|alpha',
            'last_name' => 'required|max:16|alpha',
            'email' => ['required','email','max:128',
                        Rule::unique('users')->where(function($query){
                            $query->whereNull('deleted_at');
                        })->ignore($userId,'user_id')],
            'phone_number' => ['required','numeric','digits:10',
                                Rule::unique('users')->where(function($query){
                                    $query->whereNull('deleted_at');
                                })->ignore($userId,'user_id')],
            'employee_id' => ['nullable','numeric',
                                Rule::unique('users')->where(function($query){
                                    $query->whereNull('deleted_at');
                                })->ignore($userId,'user_id')],
            'avatar' => 'nullable',
            'department' => 'required',
            'profile_text' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'status' => 'required|in:0,1',
        ];
    }
}
