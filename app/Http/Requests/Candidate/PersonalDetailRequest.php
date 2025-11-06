<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class PersonalDetailRequest extends FormRequest
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
            "full_name" => 'required',
            "father_husband_name" => 'required',
            "email" => 'required|email',
            "mobile_no" => 'required|numeric|digits:10', // Corrected mobile number validation
            "date_of_birth" => 'required|date', // Added date validation
            "gender" => 'required',
            "pincode" => 'required',
            "correspondence_address" => 'required',
            "permanent_address" => 'required',
            "upload_photos" => 'image|mimes:jpeg,png,jpg,gif', // Assuming upload_photos is an image
            "upload_signature" => 'image|mimes:jpeg,png,jpg,gif', //'image|mimes:jpeg,png,jpg,gif',
            "upload_resume" => 'mimes:pdf,doc,docx',
        ];
    }
}
