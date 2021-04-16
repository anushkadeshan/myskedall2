<?php

namespace App\Http\Requests\Space;

use Illuminate\Foundation\Http\FormRequest;

class NewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "events"=>'required',
            "space_manager"=>'required',
            "reason"=>'required',
            "total_people"=>'required|numeric',
            "location"=>'required',
            "initial_date"=>'required|date',
            "initial_time"=>'required|date_format:H:i',
            "final_date"=>'required|date|after_or_equal:initial_date',
            "final_time"=>'required|date_format:H:i',
            "agreement" => 'required'
        ];
    }
}
