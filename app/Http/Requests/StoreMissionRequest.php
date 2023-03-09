<?php

namespace App\Http\Requests;

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
             'city_id' => 'required',
             'country_id' => 'required',
             'mission_type' => 'required',
             'status' => 'required',
             'document_name.*' => 'required|mimes:pdf,doc,docx',
             'media_name.*' => 'required|file|max:2048|mimes:jpg,jpeg,png,mp4',
        ];
    }

    public function messages()
    {
        return [
            'media_name.*.required' => 'The media file is required',
            'media_name.*.file' => 'The media file must be a file',
            'media_name.*.max' => 'The media file size must be less than 2 MB',
            'media_name.*.mimes' => 'The media file must be a JPG, JPEG, PNG, or MP4',
        ];
    }
}
