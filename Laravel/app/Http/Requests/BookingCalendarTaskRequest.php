<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingCalendarTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cal_name'=>'string|required|regex:/^[\pL\s\-]+$/u|max:50',
            'cal_email'=>'string|required|max:50',
            'cal_contact'=>'required',
            // 'start_date_' => 'date',
            'cal_from_time' => 'required|date_format:H:i',
            'cal_to_time' => 'required|date_format:H:i|after:cal_from_time',
            'cal_guest' => 'numeric|required',
            'cal_message' => 'required',
        ];
    }
    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'cal_name.required' => __('Name is required'),
            'cal_name.regex' =>  __('Only alphabet is acceptable'),
            'cal_email.required' =>  __('Email is required'),
            'cal_contact.required' => __('Contact number is required'),
            'cal_from_time.required' => __('Please choose a date and select from time'),
            'cal_to_time.required' => __('To time is required'),
            'cal_guest.required' => __('No.of person is required'),
            'cal_message.required' => __('Comments is required'),
        ];
    }
}
