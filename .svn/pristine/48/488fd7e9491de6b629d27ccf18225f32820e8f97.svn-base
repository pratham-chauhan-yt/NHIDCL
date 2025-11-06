<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsTemplateRequest extends FormRequest
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
            'template_name' => 'required|string|max:255',
            'template_id'   => 'required|string|max:100|unique:sms_templates,template_id',
            'event_id'      => 'required|string|max:100',
            'message'       => 'required|string',
            // 'status'        => 'required|in:0,1',
        ];
    }
}
