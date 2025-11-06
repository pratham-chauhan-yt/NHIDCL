<?php
namespace App\Http\Requests\Recruitment\CandidateProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Carbon\Carbon;

class RPWorkExperienceDetailRequest extends FormRequest
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
    public function rules()
    {
        return [
            'employer_name' => 'required|string|max:255',
            'post_held' => 'required|string|max:255',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'job_description' => 'required|string|max:500',
            'experience_certificate' => 'required|file|mimes:pdf|max:2048', // 2MB
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $from = $this->input('from_date');
            $to = $this->input('to_date');
            $today = \Carbon\Carbon::today();

            if (!$from || !$to) {
                return;
            }

            try {
                $fromDate = \Carbon\Carbon::parse($from);
                $toDate = \Carbon\Carbon::parse($to);
            } catch (\Exception $e) {
                $validator->errors()->add('from_date', 'Invalid date format.');
                return;
            }

            if ($fromDate->gt($toDate)) {
                $validator->errors()->add('from_date', 'From Date cannot be after To Date.');
                $validator->errors()->add('to_date', 'To Date cannot be before From Date.');
            }

            if ($fromDate->eq($toDate)) {
                $validator->errors()->add('from_date', 'From Date and To Date cannot be the same.');
                $validator->errors()->add('to_date', 'From Date and To Date cannot be the same.');
            }

            if ($fromDate->gt($today)) {
                $validator->errors()->add('from_date', 'From Date cannot be in the future.');
            }

            if ($toDate->gt($today)) {
                $validator->errors()->add('to_date', 'To Date cannot be in the future.');
            }
        });
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'employer_name.required' => 'Please enter the employer name.',
            'employer_name.not_regex' => 'Employer name must not contain HTML tags.',

            'post_held.required' => 'Please enter the post held name.',
            'post_held.not_regex' => 'Post held must not contain HTML tags.',

            'from_date.required' => 'Please enter the From Date.',
            'from_date.date' => 'Invalid From Date format.',

            'to_date.required' => 'Please enter the To Date.',
            'to_date.date' => 'Invalid To Date format.',

            'job_description.required' => 'Please enter the nature of duties.',
            'job_description.not_regex' => 'Nature of duties must not contain HTML tags.',

            'experience_certificate.required' => 'Please choose the experience certificate.',
            'experience_certificate.file' => 'Experience certificate must be a file.',
            'experience_certificate.mimetypes' => 'Experience certificate must be a PDF.',
            'experience_certificate.max' => 'Experience certificate size must not exceed 2MB.',
        ];
    }
}
