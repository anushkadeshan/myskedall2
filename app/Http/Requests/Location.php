<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Location extends FormRequest
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
            "address"=>'required',
            "contact"=>'required',
            "telephone"=>'required',
            "period"=>'required',
            "size"=>'required',
            "area_type"=>'required',
            "air_conditioner"=>'required',
            "parking"=>'required',
			"price"=>'required',
			"budget"=>'required',
            "total_people"=>'required|numeric',
            "total_chair"=>'required|numeric',
            "total_table"=>'required|numeric',
            "date"=>'required|date',
            "photos"=>'mimes:png,jpg,jpeg',
            "documents"=>'mimes:pdf,doc,csv,xlsx,xls,docx'
        ];
    }
}
