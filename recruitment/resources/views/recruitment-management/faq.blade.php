@extends('layouts.app')
@section('content')
    <div class="cutom_flex_p">

        @include('shared.header2')

        <div class="flex flex-col justify-between md:h-[100%] xl:h-[100vh]">
            <div class="bg_main_dash cust_corl_bg">
                <div class="container">
                    <div class="heading__regist">
                        <h1 class="text-3xl font-bold">Frequently Asked Questions</h1>
                    </div>
                    <div class="banner_cust_m">
                        <div class="regis_cust">
                            <div class="form_bg_inner">
                            </div>
                            <div class="reg_cust_bg">
                                <div class="container mb-8">
                                    <section class="mx-auto px-4 faq-div">
                                        <h2 class="font-bold">General FAQs</h2>
                                        <div id="accordion-color" data-accordion="collapse"
                                            data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
                                            @php
                                                $faqs = [
                                                    [
                                                        'question' =>
                                                            'How can I register and apply on the NHIDCL recruitment portal?',
                                                        'answer' =>
                                                            'Candidates must register first on the NHIDCL recruitment portal by providing the required personal details, a valid email ID, and mobile number. After successful registration, candidates can log in to fill out the application form, upload documents, and submit the application as per the instructions provided on the portal.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'How will I know if my application has been successfully submitted?',
                                                        'answer' =>
                                                            'A confirmation message will be displayed on the portal upon successful submission. Candidates will also receive a confirmation email and/or SMS at their registered contact details.',
                                                    ],
                                                    [
                                                        'question' => 'Can I edit my application after submission?',
                                                        'answer' =>
                                                            'No, once submitted, applications cannot be edited. Candidates are advised to carefully review all details before final submission. However, applications can be saved and edited multiple times before submission, up until the last date of application.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'Do I need to create a new account for every recruitment cycle?',
                                                        'answer' =>
                                                            'No. Candidates who have already registered on the recruitment portal can use their existing account to apply for future vacancies.',
                                                    ],
                                                    [
                                                        'question' => 'Can I withdraw my application after submission?',
                                                        'answer' =>
                                                            'No. Once submitted, an application cannot be withdrawn.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'I forgot my portal login password. How can I reset it?',
                                                        'answer' =>
                                                            'Use the ‘Forgot Password’ link on the login page to reset your password by following the instructions sent to your registered email ID or mobile number.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'I am unable to upload documents due to file size or format issues. What should I do?',
                                                        'answer' =>
                                                            'Ensure that the documents meet the specified size and format requirements mentioned on the portal. If the issue persists, compress or convert the files in required format accordingly before uploading.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'Whom can I contact for help regarding my application?',
                                                        'answer' =>
                                                            'Candidates can contact the recruitment helpdesk via the email address or helpline number provided in the recruitment notification and on the recruitment portal.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'I am not receiving the OTP during registration. What should I do?',
                                                        'answer' =>
                                                            'Verify that the mobile number and email ID entered are correct and active. Check your spam/junk folder for the OTP email. If the problem persists, contact the recruitment helpdesk.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'The website is not loading or is showing an error. What should I do?',
                                                        'answer' =>
                                                            'Check your internet connection, try clearing your browser cache, or use a different browser. If the problem continues, report it to the recruitment helpdesk.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'My application status shows “Incomplete” even after filling all sections. How can I resolve this?',
                                                        'answer' =>
                                                            'Verify that all mandatory fields are filled and required documents are uploaded. Review each section for errors and re-save before attempting final submission.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'The portal is not accepting my email ID or phone number. How do I proceed?',
                                                        'answer' =>
                                                            'Ensure that your email ID and phone number are in the correct format and not already registered. If the issue persists, contact the recruitment helpdesk.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'I accidentally logged out while filling the form. Will my data be saved?',
                                                        'answer' =>
                                                            'If you have saved your progress before logging out, your data will be retained. If not, you may need to re-enter the information.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'Whom should I contact for technical issues with the portal?',
                                                        'answer' =>
                                                            'For technical assistance, candidates should contact the recruitment helpdesk through the official contact details provided on the recruitment portal.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'I have done some mistake in filling up of online application and submitted the application. Can I resubmit a fresh application?',
                                                        'answer' =>
                                                            'Candidates can raise a request on the recruitment helpdesk via the email address or helpline number provided in the recruitment notification and on the recruitment portal.',
                                                    ],
                                                ];
                                            @endphp
                                            @foreach ($faqs as $index => $faq)
                                                <h2 id="accordion-color-heading-{{ $index }}">
                                                    <button type="button"
                                                        class="mt-2 flex items-start justify-between w-full p-3 font-medium rtl:text-right text-gray-500 border border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800 gap-3"
                                                        data-accordion-target="#accordion-color-body-{{ $index }}"
                                                        aria-expanded="true"
                                                        aria-controls="accordion-color-body-{{ $index }}"
                                                        style="text-align-last: left;">
                                                        {{ $index + 1 . '. ' . $faq['question'] }}
                                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </button>
                                                </h2>
                                                <div id="accordion-color-body-{{ $index }}" class="mb-2 hidden"
                                                    aria-labelledby="accordion-color-heading-{{ $index }}">
                                                    <div
                                                        class="p-5 border rounded-b-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                                        <p class="text-gray-500 dark:text-gray-400">{!! $faq['answer'] !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </section>
                                    <section class="mx-auto px-4 mt-3">
                                        <h2 class=" font-bold">Technical FAQs</h2>
                                        <div id="accordion-technical-color" data-accordion="collapse"
                                            data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
                                            @php
                                                $technicalFaqs = [
                                                    [
                                                        'question' =>
                                                            'Can candidates currently employed in other Government departments apply?',
                                                        'answer' =>
                                                            'Yes. Candidates serving in Central or State Government departments, autonomous bodies, or public sector undertakings may apply, subject to fulfilling the prescribed eligibility criteria and submitting the required No Objection Certificate (NOC) from their current employer at the time of application or as specified in the recruitment notice (advertisement).',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'Can candidates from the private sector apply for NHIDCL posts?',
                                                        'answer' =>
                                                            'Yes. Candidates from the private sector are eligible to apply, provided they meet the prescribed qualifications, experience, and other eligibility conditions as specified for the post.',
                                                    ],
                                                    [
                                                        'question' => 'Is there an age limit for applying?',
                                                        'answer' =>
                                                            'Yes. The upper age limit for each post will be specified in the recruitment notification. The age will be calculated as on the closing date for receipt of applications.',
                                                    ],
                                                    [
                                                        'question' =>'Are there relaxations in age or qualifications for candidates belonging to reserved categories?',
                                                        'answer' =>'Yes. Relaxations in age and other conditions will be applicable as per the rules and instructions issued by the Government of India from time to time.',
                                                    ],
                                                    [
                                                        'question' => 'Can I apply for more than one post at a time?',
                                                        'answer' =>
                                                            'Yes. Eligible candidates may apply for more than one post, subject to meeting the eligibility criteria for each post. Separate applications must be submitted for each post.',
                                                    ],
                                                    [
                                                        'question' =>'What documents are required to be uploaded during the application process?',
                                                        'answer' => 'Scanned copies of the following documents are generally required:
                                                            i.Recent passport-size photograph
                                                            ii.Signature
                                                            iii.Proof of date of birth
                                                            iv.GATE score card
                                                            Additional documents, if any, will be specified in the recruitment notification.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'What is the selection process for direct recruitment?',
                                                        'answer' =>
                                                            'The selection process for direct recruitment will be as specified in the recruitment notification and may include a written examination, skill test, and/or interview, depending on the post.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'Will there be a written test, interview, or both?',
                                                        'answer' =>
                                                            'The mode of selection, including whether a written test, interview, or both will be conducted, will be detailed in the recruitment notification.',
                                                    ],
                                                    [
                                                        'question' => 'How will shortlisted candidates be informed?',
                                                        'answer' =>
                                                            'Shortlisted candidates will be notified through the recruitment portal, email, and/or SMS using the contact details provided during registration.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'Are there medical or physical fitness requirements?',
                                                        'answer' =>
                                                            'Yes. Selected candidates may be required to undergo a medical examination to ensure they meet the prescribed medical and physical fitness standards before appointment.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'Is there an application fee, and how can it be paid?',
                                                        'answer' =>
                                                            'No, there is no application fee for applying to NHIDCL vacancies. Candidates can complete and submit their applications on the recruitment portal free of cost.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'What is the last date and time to submit the application?',
                                                        'answer' =>
                                                            'The last date and time for submission of applications will be clearly mentioned in the recruitment notification. Applications submitted after the deadline will not be accepted.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'What should be the degree (percentage) of disability for claiming the benefit of reservation?',
                                                        'answer' =>
                                                            'Only those person will be eligible for availing reservation benefits whose degree of disability is not less than 40 percent as per RPwD Act 2016.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'What is the age relaxation granted to Persons with Benchmark disabilities?',
                                                        'answer' =>
                                                            'For PwBD candidates, the upper age limit is relaxable. For exact details, refer specific recruitment notice for that post.',
                                                    ],
                                                    [
                                                        'question' =>
                                                            'Can foreign national apply for the post in NHIDCL?',
                                                        'answer' =>
                                                            'No, only Indian citizen or subject of Nepal/ Bhutan can apply.',
                                                    ],
                                                ];
                                            @endphp
                                            @foreach ($technicalFaqs as $index => $faq)
                                                <h2 id="accordion-technical-color-heading-{{ $index }}">
                                                    <button type="button"
                                                        class="mt-2 flex items-start justify-between w-full p-3 font-medium rtl:text-right text-gray-500 border border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800 gap-3"
                                                        data-accordion-target="#accordion-technical-color-body-{{ $index }}"
                                                        aria-expanded="true"
                                                        aria-controls="accordion-technical-color-body-{{ $index }}">
                                                        {{ $index + 1 . '. ' . $faq['question'] }}
                                                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </button>
                                                </h2>
                                                <div id="accordion-technical-color-body-{{ $index }}"
                                                    class="mb-2 hidden"
                                                    aria-labelledby="accordion-technical-color-heading-{{ $index }}">
                                                    <div
                                                        class="p-5 border rounded-b-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                                        <p class="text-gray-500 dark:text-gray-400">{!! $faq['answer'] !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="bg-footer-color p-4">
                <div class="container">
                    <p>@ {{ now()->year }} NHIDCL </p>
                </div>
            </footer>
        </div>
    </div>
@endsection
