<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequestValidation extends FormRequest
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
            'user_id'=>'required|unique:vendor_requests,user_id',
            'orginazation'=>'sometimes|unique:vendor_requests,orginazation',
            'address'=>'sometimes',
            'contact'=>'sometimes|digits:10|numeric'
        ];
    }


}
