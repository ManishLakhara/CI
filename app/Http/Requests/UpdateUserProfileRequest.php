<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class UpdateUserProfileRequest extends FormRequest
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
        $id = Auth::user()->user_id;
        $user = Auth::user();
        // dd($id);
        return [
            'first_name' => 'required|max:16',
            'last_name' => 'required|max:16',
            // 'employee_id' => 'max:16',
            'employee_id' => [
                'required',
                Rule::unique('users')->ignore($user->employee_id, 'employee_id')
            ],
            'title' => 'max:255',
            'department' => 'max:16',
            'country_id' => 'required',
            'city_id' => 'required',

            // 'linked_in_url'=>'max:255',
            'linked_in_url' => ['nullable','max:255', 'regex:/^(https?:\/\/)?(www\.)?linkedin\.com\/(in|pub|company)\/[a-zA-Z0-9-_.]+$/'],

            'avatar'=>'max:2048',
        ];
    }
}
