<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantRequest extends FormRequest
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
            'event_id'=>'required',
            'orginizer_id'=>'required',
            'category'=>'nullable',
            'name'=>'required',
            'participant_details'=>'nullable',
            'participant_gaurdian'=>'nullable',
            'gender'=>'required',
            'pp_image'=>'required',
            'details'=>'required',
            'payment_method'=>'required',
            'qrcode_payment'=>'nullable',
            'payment_reg'=>'nullable',
            'payment_conformation'=>'required|boolean',
            'reference'=>'nullable',
            'conformation'=>'required',
            'social_media'=>'nullable',
            'extra'=>'nullable',
        ];
    }
}
