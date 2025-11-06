<?php

namespace App\Http\Requests\Recruitment\CandidateProfile;

use Illuminate\Foundation\Http\FormRequest;

class RpPersonalDetailRequest extends FormRequest
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
            'father_husband_name' => ['required', 'string', 'between:1,250', 'regex:/^[A-Za-z .]+$/'],
            'mother_name' => ['required', 'string', 'between:1,250', 'regex:/^[A-Za-z .]+$/'],
            'marital_status' => ['required', 'in:Single,Married'],
            'spouse_name' => ['nullable', 'string', 'max:100', 'required_if:marital_status,Married'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'category' => ['required'],
            'aadhar_number' => ['required', 'string'],
            'pwbd' => ['required', 'in:Yes,No'],
            'indian_citizen' => ['required', 'in:India,Nepal,Bhutan'],
            'disability' => ['required_if:pwbd,Yes', 'nullable', 'string'],
            'ex_serviceman' => ['required'],
            'correspondence_address' => ['required', 'string', 'not_regex:/<.*?>/', 'between:2,100'],
            'correspondence_city' => ['required', 'string', 'between:2,500', 'regex:/^[A-Za-z .]+$/'],
            'correspondence_state' => ['required'],
            'correspondence_pincode' => ['required', 'digits:6'],
            'permanent_address' => ['required', 'string', 'not_regex:/<.*?>/', 'between:2,100'],
            'permanent_city' => ['required', 'string', 'between:2,500', 'regex:/^[A-Za-z .]+$/'],
            'permanent_state' => ['required'],
            'permanent_pincode' => ['required', 'digits:6'],
            'dob_consent' => ['accepted'],

            // File uploads validation: you can also validate file types here
            'upload_photos' => ['sometimes', 'required', 'file', 'mimetypes:image/jpeg,image/jpg,image/png', 'max:2048'],
            'upload_signature' => ['sometimes', 'required', 'file', 'mimetypes:image/jpeg,image/jpg,image/png', 'max:2048'],
            //'upload_caste_certificate' => ['sometimes', 'required_if:category,EWS', 'file', 'mimetypes:application/pdf', 'max:2048'],
            //'upload_disability_proof' => ['sometimes', 'required_if:pwbd,Yes', 'file', 'mimetypes:application/pdf', 'max:2048'],
            //'upload_ex_serviceman' => ['sometimes', 'required_if:ex_serviceman,Yes', 'file', 'mimetypes:application/pdf', 'max:2048'],
            'upload_dob_proof' => ['sometimes', 'required', 'file', 'mimetypes:application/pdf', 'max:2048'],
        ];
    }

     /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Full name field is required',
            'full_name.between' => 'Full name should be of 2 to 50 characters',
            'full_name.regex' => 'Full name must only contain letters and spaces (no HTML tags).',

            'father_husband_name.required' => 'Father/Husband name field is required',
            'father_husband_name.between' => 'Father/Husband name should be of 2 to 50 characters',
            'father_husband_name.regex' => 'Numeric and special characters should not be allowed.',

            'mother_name.required' => 'Mother name field is required',
            'mother_name.between' => 'Mother name should be of 2 to 50 characters',
            'mother_name.regex' => 'Numeric and special characters should not be allowed.',

            'marital_status.required' => 'Marital status field is required',

            'indian_citizen.required' => 'Citizenship field is required',

            'email.required' => 'Email field is required',
            'email.email' => 'Invalid email!',

            'mobile_no.required' => 'Mobile number field is required',
            'mobile_no.digits_between' => 'Mobile number should be of 7 to 15 digits',

            'date_of_birth.required' => 'Date of birth field is required',

            'gender.required' => 'Gender field is required',

            'category.required' => 'Category field is required',

            'pwbd.required' => 'PWBD field is required',

            'disability.required_if' => 'Disability field is required, If PWBD.',

            'correspondence_address.required' => 'Correspondence address field is required',
            'correspondence_address.not_regex' => 'Numeric and special characters should not be allowed',

            'correspondence_city.required' => 'Correspondence city field is required',
            'correspondence_city.between' => 'Correspondence city should be of 2 to 250 characters',
            'correspondence_city.regex' => 'Numeric and special characters should not be allowed',

            'correspondence_state.required' => 'Correspondence state field is required',

            'correspondence_pincode.required' => 'Correspondence pincode field is required',
            'correspondence_pincode.digits' => 'Numeric and special characters should not be allowed',

            'permanent_address.required' => 'Permanent address field is required',
            'permanent_address.not_regex' => 'Numeric and special characters should not be allowed',

            'permanent_city.required' => 'Permanent city field is required',
            'permanent_city.between' => 'Permanent city should be of 2 to 250 characters',
            'permanent_city.regex' => 'Numeric and special characters should not be allowed',

            'permanent_state.required' => 'Permanent state field is required',

            'permanent_pincode.required' => 'Permanent pincode field is required',
            'permanent_pincode.digits' => 'Permanent pincode must be exactly 6 digits.',

            'upload_photos.required' => 'Upload photo field is required',
            'upload_signature.required' => 'Upload signature field is required',
            'upload_caste_certificate.required_if' => 'Caste certificate or Income proof is required, If EWS.',
            'upload_disability_proof.required_if' => 'Disability proof is required, If PwBD.',
            'upload_ex_serviceman.required_if' => 'Ex-serviceman proof is required, If Ex-serviceman.',
            'upload_dob_proof.required' => 'Date of birth proof is required',
        ];
    }
}
