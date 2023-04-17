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
            'theme_id' => 'required|exists:mission_themes,mission_theme_id',
            'city_id' => 'required|exists:cities,city_id',
            'country_id' => 'required|exists:countries,country_id',
            'mission_type' => 'required',
            'status' => 'required',
            'document_name.*' => 'mimes:pdf,doc,docx',
            'media_name.*' => 'image|max:2048|mimes:jpg,jpeg,png,',
            'media_names' => [
                function ($attribute, $value, $fail) {
                    $videoUrl = $this->input('media_names');
                    if ($videoUrl && !preg_match('/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/i', $videoUrl)) {
                        $fail($attribute . ' must be a valid YouTube URL.');
                    }
                },
            ],
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
            'total_seats'=>'integer',
            'registration_deadline'=>'date|after:start_date|before:end_date',
            'goal_objective_text'=>'max:255|string',
            'goal_value'=>'integer',
            'skill_id' => 'required_without_all:skill_id.*|array|min:1',
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
