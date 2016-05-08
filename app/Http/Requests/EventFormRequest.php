<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EventFormRequest extends Request
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
            'event_date' => 'required|after:today',
            'event_time' => 'required|max:255',
            'description' => 'required',
            'title' => 'required|max:255',
            'event_location' => 'required'
        ];
    }
}
