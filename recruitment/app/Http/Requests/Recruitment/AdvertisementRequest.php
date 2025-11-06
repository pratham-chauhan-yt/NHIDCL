<?php

namespace App\Http\Requests\Recruitment;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementRequest extends FormRequest
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
        if(isset($this->advertisement)){

            $rules = [
                'advertisement_title' => 'required|min:10|max:250|unique:nhidcl_recruitment_advertisement,advertisement_title',
                'as_on_date' => 'required|date',
                'start_datetime' => 'required|date',
                'expiry_datetime' => 'required|date',
                'advertisement_file' => 'file|mimes:jpg,png,pdf,svg,pdf,docx|max:10240',
                'notes' => 'array|min:1',
                'notes.*.note_instruction' => 'required|max:2000',
              ];

        }else{

            $rules = [
                'advertisement_title' => 'required|min:10|max:250|unique:nhidcl_recruitment_advertisement,advertisement_title',
                'as_on_date' => 'required|date',
                'start_datetime' => 'required|date',
                'expiry_datetime' => 'required|date',
                'advertisement_file' => 'required|file|mimes:jpg,png,pdf,svg,pdf,docx|max:10240',
                'notes' => 'array|min:1',
                'notes.*.note_instruction' => 'required|max:2000',
              ];

        }

        return $rules;
    }

    public function messages()
    {
        return [
            'notes.array' => 'Please fill other faq value',
            'notes.*.note_instruction.required' => 'Please fill note / instruction',
        ];
    }


}
