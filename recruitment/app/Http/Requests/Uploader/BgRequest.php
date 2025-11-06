<?php

namespace App\Http\Requests\Uploader;

use Illuminate\Foundation\Http\FormRequest;

class BgRequest extends FormRequest
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
            'nhidcl_bgm_project_details_id' => ['required', 'integer', 'exists:nhidcl_bgm_project_details,id'],
            'ref_guarantee_type_id'         => ['required', 'integer', 'exists:ref_guarantee_type,id'],
            'agency_name'       => ['required', 'string', 'max:255'],
            'agency_mob_no'     => ['required', 'digits:10'],
            'agency_email'      => ['required', 'email', 'max:255'],
            'agency_address'    => ['required', 'string'],
            'bg_no'             => ['required', 'string', 'max:100'],
            'bank_name'         => ['required', 'string', 'max:255'],
            'issuing_bank_branch'   => ['required', 'string', 'max:255'],
            'issuing_bank_mob_no'   => ['required', 'digits:10'],
            'issuing_bank_email'    => ['required', 'email', 'max:255'],
            'issuing_bank_address'  => ['required', 'string'],
            'operable_bank_mob_no'  => ['required', 'digits:10'],
            'operable_bank_email'   => ['required', 'email', 'max:255'],
            'operable_bank_address' => ['required', 'string'],
            'operable_bank_branch'  => ['required', 'string', 'max:255'],
            'bg_amount'         => ['required', 'numeric'],
            'issue_date'        => ['required', 'date'],
            'bg_valid_upto'     => ['required', 'date'],
            'claim_expiry_date' => ['required', 'date'],
            // 'bg_file'           => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ];
    }
}
