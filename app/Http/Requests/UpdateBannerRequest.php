<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBannerRequest extends FormRequest
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
        $bannerId = $this->route('banner') ? $this->route('banner') : null;

        return [
            'text' => 'required',
            'sort_order' => 'required','integer','gt:0',
                            Rule::unique('banners')->where(function($query){
                                $query->where('deleted_at','!=',Null);
                            })->ignore($bannerId),
        ];
    }
}
