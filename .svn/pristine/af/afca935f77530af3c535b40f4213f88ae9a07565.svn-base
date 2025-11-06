<?php

    namespace App\Http\Requests\DocumentManagement;

    use Illuminate\Foundation\Http\FormRequest;

    class UploadRequest extends FormRequest
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
            'ref_type_of_document_id' => ['required', 'exists:ref_type_of_document,id'],
            'title'                   => ['required', 'string', 'max:255'],
            'file_number'             => ['nullable', 'string', 'max:100'],
            'issue_date'              => ['nullable', 'date'],
            'ref_type_id'             => ['nullable', 'exists:ref_type,id'],
            'ref_department_id'       => ['nullable', 'exists:ref_department,id'],
            'year'                    => ['nullable', 'exists:ref_passing_year,id'],
            'tag_user'                => ['nullable', 'exists:ref_users,id'],
            'upload_doc'              => ['sometimes', 'required', 'file', 'mimetypes:application/pdf', 'max:20480'], // Max size in KB (20MB = 20480)
        ];
    }

    public function withValidator($validator)
    {
        $validator->sometimes('issue_date', 'required|date', function ($input) {
            // Make issue_date is not required if document type is "Other"
            return (int) $input->ref_type_of_document_id !== 5;
        });

        // Make year required if document type is "Other"
        $validator->sometimes('year', 'required|exists:ref_passing_year,id', function ($input) {
            return (int) $input->ref_type_of_document_id === 5;
        });
    }

    public function messages(): array
    {
        return [
            'ref_type_of_document_id.required' => 'Please select a document type.',
            'ref_type_of_document_id.exists'   => 'Invalid document type selected.',

            'title.required'       => 'The title field is required.',
            'title.max'            => 'The title may not be greater than 255 characters.',

            'file_number.max'      => 'The file number may not be greater than 100 characters.',

            'issue_date.required'  => 'The issue date is required.',
            'issue_date.date'      => 'The issue date must be a valid date.',

            'year.required'        => 'The year is required.',
            'year.exists'          => 'The selected year is invalid.',

            'tag_user.exists'          => 'The selected user is not found.',

            'upload_doc.required' => 'Please upload a document.',
            'upload_doc.mimes'    => 'Only PDF files are allowed.',
            'upload_doc.max'      => 'The document must not exceed 20 MB.',
        ];
    }
    }
