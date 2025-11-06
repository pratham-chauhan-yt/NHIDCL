<?php

    namespace App\Http\Requests\DocumentManagement;

    use Illuminate\Foundation\Http\FormRequest;

    class ShareRequest extends FormRequest
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
            'title'                   => ['required', 'string', 'max:255'],
            'remark'                  => ['nullable', 'string', 'max:255'],
            'share_type'              => ['required', 'string'],
            'ref_users_id'            => ['required', 'exists:ref_users,id'],
            'upload_doc'              => ['sometimes', 'required', 'file', 'mimetypes:application/pdf', 'max:40960'], // Max size in KB (40MB = 40960)
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'The title field is required.',
            'title.max'            => 'The title may not be greater than 255 characters.',

            'remark.required'       => 'The remark field is required.',
            'remark.max'            => 'The remark may not be greater than 255 characters.',

            'share_type.required'       => 'The title field is required.',

            'ref_users_id.required'          => 'The user field is required.',
            'ref_users_id.exists'          => 'The selected user is not found.',

            'upload_doc.required' => 'Please upload a document.',
            'upload_doc.mimes'    => 'Only PDF files are allowed.',
            'upload_doc.max'      => 'The document must not exceed 40 MB.',
        ];
    }
    }
