<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrievanceRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'employee_no' => ['required', 'string', 'max:50'],
            'ref_designation_id' => ['required', 'integer', 'exists:ref_designation,id'],
            'grievance_reason' => ['required', 'string', 'max:1000'],
            'pay_scale' => ['required', 'numeric', 'between:0,99999999.99'],
            'ref_department_id' => ['required', 'integer', 'exists:ref_department,id'],
            'permanent_address' => ['nullable', 'string', 'max:1000'],
            'date' => ['required', 'date']
        ];
    }
}
