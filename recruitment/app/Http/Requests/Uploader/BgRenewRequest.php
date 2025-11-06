<?php

namespace App\Http\Requests\Uploader;

use Illuminate\Foundation\Http\FormRequest;

class BgRenewRequest extends FormRequest
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
            'issue_date' => ['required', 'date'],
            'valid_upto' => ['required', 'date', 'after_or_equal:issue_date'],
            'claim_expiry_date' => ['required', 'date', 'after_or_equal:valid_upto'],
            // 'renew_bg_file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'], // max 2MB
            'is_renew' => ['required', 'in:YES,NO'],
        ];
    }
}
