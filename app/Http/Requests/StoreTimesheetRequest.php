<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimesheetRequest extends FormRequest
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
            'action' => 'integer',
            'date_volunteered' => 'required|date',
            'hour' => 'integer|min:0',
            'minute' => 'integer|max:59|min:0',
            'notes' => 'nullable|string',
            'action' => 'integer'
        ];
    }
}
