<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CandidateRegstrationRequest extends FormRequest
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
        $moduleName = session('moduleName') ?? 'Resource Pool Portal';
        return [
            "name" => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s\-\'\.]+$/'
            ],
            "mobile" => [
                'required',
                'digits:10',
                Rule::unique('ref_users', 'mobile')
                    ->where(fn ($q) => $q->where('module_name', $moduleName)),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('ref_users', 'email')
                    ->where(fn ($q) => $q->where('module_name', $moduleName)),
            ],
            'date_of_birth' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d')
            ],
            'captcha' => 'required|captcha'
        ];
    }

    public function messages(): array
    {
        return [
            'captcha.required' => 'The captcha field is required.',
            'captcha.captcha' => 'The captcha entered is incorrect.',
        ];
    }
}
