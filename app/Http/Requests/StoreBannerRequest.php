<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBannerRequest extends FormRequest
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
            'text' => 'required',
            'photo' => 'bail|required|mimes:jpeg,jpg,png|max:4086',
            'sort_order' => ['required',Rule::unique('banners','sort_order')->whereNull('deleted_at'),'gt:0']
        ];
    }
}
