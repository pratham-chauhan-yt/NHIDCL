<?php

namespace App\Http\Requests\Recruitment;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementPostRequest extends FormRequest
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
        $rules = [
            'mode_of_requirement'   => 'required', 
            'mode_of_requirement.*' => 'numeric|min:1|max:5',
            'advertisement_year' => 'required',
            'post_examination' => 'required',
            'recruitment_advertisement_id' => 'required',
            'post_name' => 'required|min:10|max:250|unique:nhidcl_recruitment_posts,post_name',
            'is_active' => 'required|in:0,1,2',
            'total_vacancy' => 'required|numeric|min:1',
            'last_datetime' => 'sometimes|required|date|after_or_equal:now',
            'min_age_limit' => 'required',
            'max_age_limit' => 'required',
            'required_experience' => 'required',
            'required_gate_exam_year' => ['required_if:required_gate_detail,1', 'array'],
            'required_gate_discipline' => ['required_if:required_gate_detail,1', 'array'],
            'required_gate_detail' => ['sometimes', 'required_if:post_examination,GATE', 'array'],
        ];
        return $rules;
    }

    public function messages(): array
    {
        return [
            'required_gate_exam_year.required_if' => 'The Year of Gate Exam field is required when gate details are required.',
            'required_gate_discipline.required_if' => 'The Gate Discipline field is required when gate details are required.',
            'total_vacancy.min' => 'Total No of Vacancy must be at least 1.',
        ];
    }
}
