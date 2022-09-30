<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id'=>'required',
            'title'=>'required',
            'slug'=>'sometimes',
            'thumbnail'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'start_date'=>'required',
            'end_date'=>'required',
            'ticket_price'=>'sometimes',
            'category'=>'sometimes',
            'form_fee'=>'sometimes',
            'address'=>'required',
        ];
    }
}
