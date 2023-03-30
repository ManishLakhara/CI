<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Mission;

class UpdateTimesheetRequest extends FormRequest
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


        $mission = Mission::findOrFail($this->mission_id);

        return [

            'mission_id' => 'required',


            'notes' => 'required|string',

            'action' => [
                Rule::requiredIf(function () use ($mission) {
                    return $mission->mission_type === 'GOAL';
                })
            ],

            'hour' => [

                Rule::requiredIf(function () use ($mission) {
                    return $mission->mission_type === 'TIME';
                }),
                'numeric',
                'min:0',
                'max:23',
            ],

            'minute' => [
                Rule::requiredIf(function () use ($mission) {
                    return $mission->mission_type === 'TIME';
                }),
                'numeric',
                'min:0',
                'max:59',
            ],

            // 'date_volunteered' => [
            //     'required',

            //     'before_or_equal:today',
            //     Rule::exists('missions', 'start_date')->where(function ($query) {
            //         $query->where('mission_id', $this->input('mission_id'));
            //     }),

            // ],

            'date_volunteered' => [
                'required',
                'date',
                'after_or_equal:' . $mission->start_date,
                'before_or_equal:' . $mission->end_date,
                'before:tomorrow',
            ],

        ];
    }

    public function messages()
    {
        return [

            'date_volunteered.required' => 'Please select the date when you volunteered.',

            'date_volunteered.after_or_equal' => 'The date must be equal to or after the start date of the mission.',
            'date_volunteered.before_or_equal' => 'The date must be equal to or before the end date of the mission.',
            'date_volunteered.before' => 'You cannot add a volunteer time in the future.',
        ];
    }
}
