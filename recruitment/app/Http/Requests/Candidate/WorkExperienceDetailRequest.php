<?php
namespace App\Http\Requests\Candidate;
use Illuminate\Foundation\Http\FormRequest;

class WorkExperienceDetailRequest extends FormRequest
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
            "employer_name.*" => 'required',
            "post_held.*" => 'required|string',
            "area_of_expertise.*" => 'required|string',
            'from_date.*' => [
                'required',
                'before_or_equal:' . now()->format('d-m-Y'),
            ],
            'to_date.*' => [
                'required',
                'before_or_equal:' . now()->format('d-m-Y'),
            ],
            "nature_of_duties.*" => 'required',
            //"employer_details.*" => 'required',
            "job_type.*" => 'required',
            "experience_certificate.*" => 'required|mimes:pdf,doc,docx',
        ];
    }
}
