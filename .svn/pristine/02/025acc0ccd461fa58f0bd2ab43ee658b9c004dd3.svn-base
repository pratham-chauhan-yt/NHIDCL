<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class EducationalDetailRequest extends FormRequest
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
            "qualification" => 'required|string',
            "course" => 'required|string',
            "board_university_collage" => 'required|string',
            "main_subject" => 'required|string',
            "course_mode" => 'required|string',
            "passing_year" => 'required',
            //    "other_course" => 'string', // required if course=='Others'
            //    "other_board_university_collage" => 'string',
            "percentage" => 'required',
            'marksheet_degree' => 'mimes:jpeg,png,jpg,gif,pdf,doc,docx',
        ];
    }
}
