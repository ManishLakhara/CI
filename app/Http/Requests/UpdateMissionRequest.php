<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMissionRequest extends FormRequest
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
            'title' => 'required|max:128',
            'short_description' => 'required',
            'description' => 'required',
            'theme_id' => 'required',
            'city_id' => 'required',
            'country_id' => 'required',
            'mission_type' => 'required',
            'status' => 'required',
        ];
    }
}
