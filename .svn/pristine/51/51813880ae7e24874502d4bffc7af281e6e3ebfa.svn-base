<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskManagementRequest extends FormRequest
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
            'task_name' => 'required|max:255|nospecialchar',
            'ref_bucket_id' => 'required',
            'division' => 'required|max:255|nospecialchar',
            'ref_priority_id' => 'required',
            'start_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:start_date',
            'ref_task_repeat_id' => 'nullable',
            'note' => 'required|max:500|nospecialchar',
            // 'ref_task_source_id' => 'required',
            'assigned_to' => 'required',
            // 'attachment' => ['required', 'mimes:jpeg,jpg,png,webp,gif,pdf,doc,docx,xls,xlsx|max:5120''],
            'attachment' => ['nullable', 'regex:/\.(jpeg|jpg|png|webp|gif|pdf|doc|docx|xls|xlsx|kml|kmz)$/i'],
        ];
    }
}
