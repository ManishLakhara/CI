<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSkillRequest extends FormRequest
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
        $skillId = $this->route('skill');
        return [
            'skill_name' => ['required','max:64',
                                Rule::unique('skills')->where(function($query){
                                    $query->whereNull('deleted_at');
                                })->ignore($skillId,'skill_id')
        ],
            'status' => 'required|in:0,1',
        ];
    }
}
