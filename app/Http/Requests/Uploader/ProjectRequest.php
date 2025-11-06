<?php

namespace App\Http\Requests\Uploader;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'job_no' => 'required|string|max:100',
            'upc_no' => 'required|string|max:100',
            'project_name' => 'required|string|max:200',
            'ref_project_type_id' => 'required|integer|exists:ref_project_type,id',
            'ref_project_state_id' => 'required|integer|exists:ref_project_state,id',
            'sap_id' => 'required|string|max:100',
        ];
    }
}
