<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliveryPartnerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string', // Example: String validation
            'available_status' => '', // Add your specific validation rules
            'contact_number' => 'required|numeric', // Example: Numeric validation
            'role_id' => 'required|exists:role,id', // Assuming roles table with 'id'
            'email' => 'required|email', // Assuming delivery_partners table with 'email'
            'vechicle_name' => 'required',
            'vechicle_number' => 'required'
            // 'new_password' => 'required|min:8', // Example: Minimum length of 8 characters
        ];
    }
}
