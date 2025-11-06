<?php

namespace App\Http\Requests\Recruitment\CandidateProfile;

use Illuminate\Foundation\Http\FormRequest;

class RpEducationalDetailRequest extends FormRequest
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
            'examination.*' => ['required', 'string'],
            'institute_name.*' => ['required', 'string'],
            'university_board.*' => ['required', 'string'],
            'passing_year.*' => ['required'],
            'percentage_cgpa.*' => ['required', 'numeric', 'between:1,100'],
            //'marksheet_degree.*' => ['required', 'file', 'mimetypes:application/pdf', 'max:2048'],
        ];
    }

    /**
     * Get custom error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'examination.*.required' => 'Please enter examination name.',
            'institute_name.*.required' => 'Please enter institute/college name.',
            'university_board.*.required' => 'Please enter university/board name.',

            'passing_year.*.required' => 'Please select passing year.',
            'passing_year.*.digits' => 'Please enter a valid passing year.',
            'passing_year.*.integer' => 'Passing year must be a valid number.',
            'passing_year.*.min' => 'Passing year seems too old.',
            'passing_year.*.max' => 'Passing year cannot be in the future.',

            'percentage_cgpa.*.required' => 'Please enter the percentage/CGPA.',
            'percentage_cgpa.*.numeric' => 'Percentage/CGPA should have a numeric value.',
            'percentage_cgpa.*.between' => 'Percentage/CGPA must be between 1 and 100.',

            // 'marksheet_degree.*.required' => 'Please choose the marksheet/degree.',
            // 'marksheet_degree.*.file' => 'Uploaded file must be a valid file.',
            // 'marksheet_degree.*.mimetypes' => 'File must be a PDF.',
            // 'marksheet_degree.*.max' => 'File size must not exceed 2MB.',
        ];
    }
}
