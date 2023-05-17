<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMissionRequest extends FormRequest
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
            'city_id' => 'required|exists:cities,city_id',
            'country_id' => 'required|exists:countries,country_id',
            'mission_type' => 'required|in:TIME,GOAL',
            'status' => 'required|in:0,1',
            'document_name.*' => 'required|mimes:pdf,doc,docx',
            'media_name.*' => 'image|max:2048|mimes:jpg,jpeg,png,',
            'media_names' => [
                function ($attribute, $value, $fail) {
                    $videoUrl = $this->input('media_names');
                    if ($videoUrl && !preg_match('/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/i', $videoUrl)) {
                        $fail($attribute . ' must be a valid YouTube URL.');
                    }
                },
            ],
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            // 'total_seats'=>'integer',
            // 'registration_deadline'=>'date|after:start_date|before:end_date',
            // 'goal_objective_text'=>'max:255|string',
            // 'goal_value'=>'integer',
            'total_seats' => [
                Rule::when($this->input('mission_type') === 'TIME', [
                    'required',
                    'numeric',
                    'gt:0',
                ]),
                Rule::when($this->input('mission_type') === 'GOAL', [

                    function ($attribute, $value, $fail) {
                        $fail('The ' . $attribute . ' field should not be filled when the mission type is GOAL.');
                    },
                ]),
            ],

            'registration_deadline' => [
                Rule::when($this->input('mission_type') === 'TIME', [
                    'required', 'date', 'after:start_date', 'before:end_date',
                ]),
                Rule::when($this->input('mission_type') === 'GOAL', [

                    function ($attribute, $value, $fail) {
                        $fail('The ' . $attribute . ' field should not be filled when the mission type is GOAL.');
                    },
                ]),
            ],
            'goal_objective_text' => [
                Rule::when($this->input('mission_type') === 'GOAL', [
                    'required', 'max:255', 'string',
                ]),
                Rule::when($this->input('mission_type') === 'TIME', [

                    function ($attribute, $value, $fail) {
                        $fail('The ' . $attribute . ' field should not be filled when the mission type is TIME.');
                    },
                ]),
            ],
            'goal_value' => [
                Rule::when($this->input('mission_type') === 'GOAL', [
                    'required', 'integer',
                ]),
                Rule::when($this->input('mission_type') === 'TIME', [

                    function ($attribute, $value, $fail) {
                        $fail('The ' . $attribute . ' field should not be filled when the mission type is TIME.');
                    },
                ]),
            ],
            'skill_id' => 'required_without_all:skill_id.*|array|min:1',
            'availability' => 'in:daily,weekly,week-end,monthly',
        ];
    }

    public function messages()
    {
        return [

            'media_name.*.max' => 'The media file size must be less than 2 MB',
            'media_name.*.mimes' => 'The media file must be a JPG, JPEG, PNG',

        ];
    }
}
