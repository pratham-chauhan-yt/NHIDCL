<?php

namespace App\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CompetitiveDetailRequest extends FormRequest
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
            "name_of_exam.*" => 'required',
            "appearing_year.*" => 'required',
            "source.*" => 'required',
            "certificate.*" => 'required|mimes:pdf,doc,docx',
            "conducting_agency.*" => 'required',
        ];
    }
}
