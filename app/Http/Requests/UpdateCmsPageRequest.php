<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateCmsPageRequest extends FormRequest
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
        $id = $this->route('cmspage');
        return [
            'title' => 'required|max:255',
            'text' => 'required',
            'slug' => [
                'required',
                Rule::unique('cms_pages')->ignore($id, 'cms_page_id')
            ],
            'status' => 'required|in:0,1',
        ];
    }
}

