<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMissionThemeRequest extends FormRequest
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
        $themeId = $this->route('missiontheme');
        return [
            'title' => ['required','max:255',
                        Rule::unique('mission_themes')->where(function($query){
                            $query->whereNull('deleted_at');
                        })->ignore($themeId,'mission_theme_id')
            ],
            'status' => 'required|in:0,1',
        ];
    }
}
