<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'user_id' => 'required|exists:users,user_id|numeric',
            'mission_id' => 'required|exists:missions,mission_id|numeric',
            'text' => 'required|max:600',
            'approval_status' => 'required|in:PUBLISHED,PENDING'
        ];
    }
}
