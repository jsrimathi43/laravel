<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'billing_street' => 'string|required',
            'delivery_time' => 'string|required',
            'billing_country_id' => 'string|required',
            'billing_zip_code' => 'string|required',
            'billing_phone_number' => 'numeric|required',
            'status' => 'string|required'
        ];
    }
}
