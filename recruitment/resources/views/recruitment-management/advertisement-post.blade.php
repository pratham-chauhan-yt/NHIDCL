@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Application for the post of {{ $record->post_name }}.</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-0">
                <div class="tab_custom_c mb-[20px]">
                    @if ($recordApplication?->action==="submit")
                    <button class="tablink" id="defaultTabs7">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                        </svg>My Application
                    </button>
                    @else
                    <button class="tablink active" id="defaultTabs1">
                     <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M720-240q25 0 42.5-17.5T780-300q0-25-17.5-42.5T720-360q-25 0-42.5 17.5T660-300q0 25 17.5 42.5T720-240Zm0 120q32 0 57-14t42-39q-20-16-45.5-23.5T720-204q-28 0-53.5 7.5T621-173q17 25 42 39t57 14Zm-520 0q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v268q-19-9-39-15.5t-41-9.5v-243H200v560h242q3 22 9.5 42t15.5 38H200Zm0-120v40-560 243-3 280Zm80-40h163q3-21 9.5-41t14.5-39H280v80Zm0-160h244q32-30 71.5-50t84.5-27v-3H280v80Zm0-160h400v-80H280v80ZM720-40q-83 0-141.5-58.5T520-240q0-83 58.5-141.5T720-440q83 0 141.5 58.5T920-240q0 83-58.5 141.5T720-40Z"/></svg>
                        Personal Details
                    </button>
                    <button class="tablink" id="defaultTabs2">
                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M480-120 200-272v-240L40-600l440-240 440 240v320h-80v-276l-80 44v240L480-120Zm0-332 274-148-274-148-274 148 274 148Zm0 241 200-108v-151L480-360 280-470v151l200 108Zm0-241Zm0 90Zm0 0Z"/></svg>
                        </svg> Educational Details
                    </button>
                    @if ($record?->required_gate_detail == '1' && $record?->post_examination == 'GATE')
                    <button class="tablink" id="defaultTabs3">
                       <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h168q13-36 43.5-58t68.5-22q38 0 68.5 22t43.5 58h168q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm80-80h280v-80H280v80Zm0-160h400v-80H280v80Zm0-160h400v-80H280v80Zm200-190q13 0 21.5-8.5T510-820q0-13-8.5-21.5T480-850q-13 0-21.5 8.5T450-820q0 13 8.5 21.5T480-790ZM200-200v-560 560Z"/></svg>
                        </svg> GATE Score Details
                    </button>
                    @else
                    <button class="tablink" id="defaultTabs3">
                       <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h168q13-36 43.5-58t68.5-22q38 0 68.5 22t43.5 58h168q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm80-80h280v-80H280v80Zm0-160h400v-80H280v80Zm0-160h400v-80H280v80Zm200-190q13 0 21.5-8.5T510-820q0-13-8.5-21.5T480-850q-13 0-21.5 8.5T450-820q0 13 8.5 21.5T480-790ZM200-200v-560 560Z"/></svg>
                        </svg> UPSC 2024 Details
                    </button>
                    @endif
                    <button class="tablink" id="defaultTabs4">
                       <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M480-340q33 0 56.5-23.5T560-420q0-33-23.5-56.5T480-500q-33 0-56.5 23.5T400-420q0 33 23.5 56.5T480-340ZM160-120q-33 0-56.5-23.5T80-200v-440q0-33 23.5-56.5T160-720h160v-80q0-33 23.5-56.5T400-880h160q33 0 56.5 23.5T640-800v80h160q33 0 56.5 23.5T880-640v440q0 33-23.5 56.5T800-120H160Zm0-80h640v-440H160v440Zm240-520h160v-80H400v80ZM160-200v-440 440Z"/></svg>
                        </svg> Work Experience Details
                    </button>
                    <button class="tablink " id="defaultTabs5">
                       <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M120-120v-190l358-358-58-56 58-56 76 76 124-124q5-5 12.5-8t15.5-3q8 0 15 3t13 8l94 94q5 6 8 13t3 15q0 8-3 15.5t-8 12.5L705-555l76 78-57 57-56-58-358 358H120Zm80-80h78l332-334-76-76-334 332v78Zm447-410 96-96-37-37-96 96 37 37Zm0 0-37-37 37 37Z"/></svg>
                        </svg>State Group
                    </button>

                    @if (trim($record?->post_payment_type) == 'Paid')
                    <button class="tablink" id="defaultTabs6">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/></svg>
                        </svg>Payment Details
                    </button>
                    @endif

                    <button class="tablink" id="defaultTabs7">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-480H200v480Zm280-80q-82 0-146.5-44.5T240-440q29-71 93.5-115.5T480-600q82 0 146.5 44.5T720-440q-29 71-93.5 115.5T480-280Zm0-60q56 0 102-26.5t72-73.5q-26-47-72-73.5T480-540q-56 0-102 26.5T306-440q26 47 72 73.5T480-340Zm0-100Zm0 60q25 0 42.5-17.5T540-440q0-25-17.5-42.5T480-500q-25 0-42.5 17.5T420-440q0 25 17.5 42.5T480-380Z"/></svg>
                        </svg>Application Preview
                    </button>
                    @endif
                </div>

                @include('components.alert')
                @if ($recordApplication?->action!="submit")
                <div id="tab-1" class="tabcontent">
                    <form id="personalDetailsForm" method="POST" action="{{ route('recruitment-portal.candidate.personal-details') }}" class="form_grid_cust"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="form-input">
                                <label class="required-label">Full Name <b>(As given in Date of Birth proof)</b></label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $previewData?->name ?? Auth::user()->name ?? '') }}"
                                    class="full_name" placeholder="Your Full Name" required>
                                <span id="full_name_err" class="candidateErr">
                                    @if ($errors->has('full_name'))
                                        {{ $errors->first('full_name') }}
                                    @endif
                                </span>
                            </div>
                            <div class="form-input">
                                <label class="required-label">Father's/Husband's Name</label>
                                <input type="text" id="father_husband_name" name="father_husband_name"
                                    class="father_husband_name" placeholder="Father's/Husband's Name" value="{{ old('father_husband_name') }}" required>
                                <span id="father_husband_name_err" class="candidateErr">
                                    @if ($errors->has('father_husband_name'))
                                        {{ $errors->first('father_husband_name') }}
                                    @endif
                                </span>
                            </div>
                            <div class="form-input">
                                <label class="required-label">Mother's Name</label>
                                <input type="text" id="mother_name" name="mother_name" class="mother_name" placeholder="Mother's Name"
                                    value="{{ old('mother_name', $previewData?->mother_name) }}" required>
                                <span id="mother_name_err" class="candidateErr">
                                    @if ($errors->has('mother_name'))
                                        {{ $errors->first('mother_name') }}
                                    @endif
                                </span>
                            </div>
                            <div class="form-input">
                                <label class="required-label">Email</label>
                                <input type="email" id="email" name="email" class="email" placeholder="Email" value="{{ old('email', $previewData?->email ?? Auth::user()->email ?? '') }}" readonly>
                                <span id="email_err" class="candidateErr">
                                    @if ($errors->has('email'))
                                        {{ $errors->first('email') }}
                                    @endif
                                </span>
                            </div>
                            <div class="form-input">
                                <label class="required-label">Mobile No</label>
                                <input type="text" id="mobile_no" name="mobile_no" class="mobile_no" placeholder="Mobile No" value="{{ old('mobile_no', $previewData?->mobile ?? Auth::user()->mobile ?? '') }}" readonly>
                                <span id="mobile_no_err" class="candidateErr">
                                    @if ($errors->has('mobile_no'))
                                        {{ $errors->first('mobile_no') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-input">
                                <label class="required-label">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" class="date_of_birth" value="{{ old('date_of_birth', $previewData?->date_of_birth ?? Auth::user()->date_of_birth ?? '') }}">
                                <span id="date_of_birth_err" class="candidateErr">
                                    @if ($errors->has('date_of_birth'))
                                        {{ $errors->first('date_of_birth') }}
                                    @endif
                                </span>
                            </div>
                            <div class="form-input">
                                <label class="required-label">Gender</label>
                                <select id="gender" name="gender" class="gender" required>
                                    <option value="">--- Choose your gender ---</option>
                                    <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <span id="gender_err" class="candidateErr">
                                    @if ($errors->has('gender'))
                                        {{ $errors->first('gender') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-input">
                                <label class="required-label">Marital Status</label>
                                <select id="marital_status" name="marital_status" class="marital_status" required>
                                    <option value="">--- Choose your marital status ---</option>
                                    <option value="Single" {{ old('marital_status') === 'Single' ? 'selected' : '' }}> Single</option>
                                    <option value="Married" {{ old('marital_status') === 'Married' ? 'selected' : '' }}> Married</option>
                                </select>
                                <span id="marital_status_err" class="candidateErr">
                                    @if ($errors->has('marital_status'))
                                        {{ $errors->first('marital_status') }}
                                    @endif
                                </span>
                            </div>

                            {{-- Spouse Name (hidden by default) --}}
                            <div class="form-input" id="spouse_name_wrapper" style="display: none;">
                                <label class="required-label">Spouse Name</label>
                                <input type="text" id="spouse_name" name="spouse_name" value="{{ old('spouse_name') }}">
                                <span id="spouse_name_err" class="candidateErr">
                                    @if ($errors->has('spouse_name'))
                                        {{ $errors->first('spouse_name') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-input">
                                <label class="required-label">Citizenship</label>
                                <select id="indian_citizen" name="indian_citizen" class="indian_citizen" required>
                                    <option value="" selected>---- Choose Citizenship ----</option>
                                    <option value="India" {{ old('indian_citizen') === 'India' ? 'selected' : '' }}>India</option>
                                    <option value="Nepal" {{ old('indian_citizen') === 'Nepal' ? 'selected' : '' }}>Nepal</option>
                                    <option value="Bhutan" {{ old('indian_citizen') === 'Bhutan' ? 'selected' : '' }}>Bhutan</option>
                                </select>
                                <div class="flex items-start mt-2">
                                    <div class="flex items-center h-5 inpus_cust_cs">
                                        <input type="hidden" name="citizenship_consent" id="citizenship_consent_hidden" value="0">
                                        <input type="checkbox" class="w-4 h-4" name="citizenship_consent" id="citizenship_consent">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="citizenship_consent" class="dark:text-gray-600 cursor-pointer text-sm">
                                           I hereby undertake to submit the documents regarding citizenship, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                                        </label>
                                    </div>
                                </div>
                                <span id="indian_citizen_err" class="candidateErr">
                                    @if ($errors->has('indian_citizen'))
                                        {{ $errors->first('indian_citizen') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-input">
                                <label class="required-label">Category</label>
                                <select id="category" name="category" data-courses='@json($castes)'
                                    class="category js-single" required>
                                    <option value="">Select category</option>
                                    @foreach ($castes as $caste)
                                        <option value="{{ $caste->id }}"
                                            {{ old('category') === $caste->id ? 'selected' : '' }}>
                                            {{ $caste->caste }}</option>
                                    @endforeach
                                </select>
                                <div class="flex items-start mt-2" id="category_div">
                                    <div class="flex items-center h-5 inpus_cust_cs">
                                        <input type="hidden" name="category_confirm" id="category_confirm_hidden" value="0">
                                        <input type="checkbox" class="w-4 h-4" name="category_confirm" id="category_confirm">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="category_confirm" class="dark:text-gray-600 cursor-pointer text-sm">
                                            I hereby undertake to submit the documents regarding category, as per the prescribed proforma, at the time of document verification, if shortlisted.
                                            I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                                        </label>
                                    </div>
                                </div>
                                
                                <span id="category_err" class="candidateErr">
                                    @if ($errors->has('category'))
                                        {{ $errors->first('category') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-input">
                                <label class="required-label">Aadhaar Number (Last 6 Digits)</label>
                                <input type="text" id="aadhar_number" name="aadhar_number" class="aadhar_number"
                                    placeholder="Aadhaar Number (Last 6 Digits)" value="{{ old('aadhar_number') }}"
                                    maxlength="6" required>
                                <span id="aadhar_number_err" class="candidateErr">
                                    @if ($errors->has('aadhar_number'))
                                        {{ $errors->first('aadhar_number') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-input">
                                <label class="required-label">Ex Service Man</label>
                                <select id="ex_serviceman" name="ex_serviceman" class="ex_serviceman" required>
                                    <option value="">--- Choose Ex service man ---</option>
                                    <option value="0" {{ old('ex_serviceman') === '0' ? 'selected' : '' }}>No
                                    </option>
                                    <option value="1" {{ old('ex_serviceman') === '1' ? 'selected' : '' }}>Yes
                                    </option>
                                </select>
                                <div class="flex items-start mt-2" id="ex_serviceman_div">
                                    <div class="flex items-center h-5 inpus_cust_cs">
                                        <input type="hidden" name="ex_serviceman_consent" id="ex_serviceman_consent_hidden" value="0">
                                        <input type="checkbox" class="w-4 h-4" name="ex_serviceman_consent" id="ex_serviceman_consent">
                                    </div>
                                    <div class="ml-3 text-sm" id="ex_serviceman_div">
                                        <label for="ex_serviceman_consent" class="dark:text-gray-600 cursor-pointer text-sm">
                                            I hereby undertake to submit the documents regarding ex-servicemen, as issued by the appropriate authority, at the time of document verification, if shortlisted.
                                            I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                                        </label>
                                    </div>
                                </div>
                                <span id="ex_serviceman_err" class="candidateErr">
                                    @if ($errors->has('ex_serviceman'))
                                        {{ $errors->first('ex_serviceman') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                            <div>Disability Details</div>
                        </div>

                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="form-input">
                                <label class="required-label">Whether you are PwBD or not</label>
                                <select id="pwbd" name="pwbd" class="pwbd" required>
                                    <option value="">--- Select PwBD or not option ---</option>
                                    <option value="No" {{ old('pwbd') === 'No' ? 'selected' : '' }}>No</option>
                                    <option value="Yes" {{ old('pwbd') === 'Yes' ? 'selected' : '' }}>Yes</option>
                                </select>
                                <span id="pwbd_err" class="candidateErr">
                                    @if ($errors->has('pwbd'))
                                        {{ $errors->first('pwbd') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-input">
                                <label class="">If yes, the nature of disability</label>
                                <select id="disability" name="disability" class="disability"
                                    {{ $previewData?->pwbd === 'No' ? 'disabled' : '' }}>
                                    <option value="" selected>--- Select nature of disability ---</option>
                                    <option value="Deaf(D) / Hard of Hearing(HH)"
                                        {{ old('disability') === 'Deaf(D) / Hard of Hearing(HH)' ? 'selected' : '' }}>i.
                                        Deaf(D) / Hard of Hearing(HH)</option>
                                    <option
                                        value="One Arm(OA)/ One Leg(OL)/ Leprosy Cured(LC)/ Dwarfism (Dw)/ Acid Attack Victims(AAV)"
                                        {{ old('disability') === 'One Arm(OA)/ One Leg(OL)/ Leprosy Cured(LC)/ Dwarfism (Dw)/ Acid Attack Victims(AAV)' ? 'selected' : '' }}>
                                        ii. One Arm(OA)/ One Leg(OL)/ Leprosy Cured(LC)/ Dwarfism (Dw)/
                                        Acid Attack Victims(AAV)</option>
                                    <!-- <option value="iii. Special Learning Disability (SLD)/ Mental Illness (MI)"
                                        {{ old('disability') === 'iii. Special Learning Disability (SLD)/ Mental Illness (MI)' ? 'selected' : '' }}>
                                        iii. Special Learning
                                        Disability (SLD)/ Mental Illness (MI)</option>
                                    <option
                                        value="iv. Multiple disability (MD) involving more than one Benchmark Disability of (i) to (iii) above"
                                        {{ old('disability') === 'iv. Multiple disability (MD) involving more than one Benchmark Disability of (i) to (iii) above' ? 'selected' : '' }}>
                                        iv. Multiple
                                        disability (MD) involving more than one Benchmark Disability of (i) to (iii) above
                                    </option> -->
                                </select>
                                <span id="disability_err" class="candidateErr">
                                    @if ($errors->has('disability'))
                                        {{ $errors->first('disability') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="flex items-start mt-3" id="pwbd_div">
                            <div class="flex items-center h-5 inpus_cust_cs">
                                <input type="hidden" name="disability_consent" id="disability_consent_hidden" value="0">
                                <input type="checkbox" class="w-4 h-4" name="disability_consent" id="disability_consent">
                            </div>
                            <div class="ml-3 text-sm">
                                
                                <label for="disability_consent" class="dark:text-gray-600 cursor-pointer">
                                    I hereby clarify that my disability is not less than 40%. I hereby undertake to submit the documents regarding disability, as per the prescribed proforma, at the time of document verification, if shortlisted.
                                    I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                                </label>
                            </div>
                        </div>

                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                            <div>Correspondence Address</div>
                        </div>

                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="form-input">
                                <label class="required-label">House No./Street No./Sector/Colony</label>
                                <input type="text" id="correspondence_address" name="correspondence_address"
                                    class="correspondence_address" placeholder="Enter House No./Street No./Sector/Colony"
                                    value="{{ old('correspondence_address') }}" maxlength="100" required>
                                <span id="correspondence_address_err" class="candidateErr">
                                    @if ($errors->has('correspondence_address'))
                                        {{ $errors->first('correspondence_address') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-input">
                                <label class="required-label">City</label>
                                <input type="text" id="correspondence_city" name="correspondence_city"
                                    class="correspondence_city" placeholder="Enter your city"
                                    value="{{ old('correspondence_city') }}" required>
                                <span id="correspondence_city_err" class="candidateErr">
                                    @if ($errors->has('correspondence_city'))
                                        {{ $errors->first('correspondence_city') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-input">
                                <label class="required-label">State</label>
                                <select id="correspondence_state" name="correspondence_state"
                                    data-courses='@json($states)' class="js-single" required>
                                    <option value="">Select state</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">
                                            {{ $state->name }}</option>
                                    @endforeach
                                </select>
                                <span id="correspondence_state_err" class="candidateErr">
                                    @if ($errors->has('correspondence_state'))
                                        {{ $errors->first('correspondence_state') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-input">
                                <label class="required-label">Pincode</label>
                                <input type="text" pattern="\d{6}" maxlength="6" id="correspondence_pincode"
                                    name="correspondence_pincode" class="correspondence_pincode"
                                    placeholder="Enter your pincode" value="{{ old('correspondence_pincode') }}"
                                    required>
                                <span id="correspondence_pincode_err" class="candidateErr">
                                    @if ($errors->has('correspondence_pincode'))
                                        {{ $errors->first('correspondence_pincode') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                            <div>Permanent Address</div>
                        </div>

                        <div class="inpus_cust_cs form_grid_dashboard_cust_">

                            <div class="form-input">
                                <label class="required-label">House No./Street No./Sector/Colony</label>
                                <input type="text" id="permanent_address" name="permanent_address"
                                    class="permanent_address" placeholder="Enter House No./Street No./Sector/Colony"
                                    value="{{ old('permanent_address') }}" maxlength="100" required>
                                <div class="flex items-start">
                                    <div class="flex items-center h-5 inpus_cust_cs">
                                        <input type="checkbox" class="w-4 h-4" id="forSame">
                                    </div>
                                    &nbsp;&nbsp;<span style="font-size: 10px;">Same as Correspondence Address</span>
                                </div>
                                <span id="permanent_address_err" class="candidateErr">
                                    @if ($errors->has('permanent_address'))
                                        {{ $errors->first('permanent_address') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-input">
                                <label class="required-label">City</label>
                                <input type="text" id="permanent_city" name="permanent_city" class="permanent_city"
                                    placeholder="Enter your city" value="{{ old('permanent_city') }}" required>
                                <span id="permanent_city_err" class="candidateErr">
                                    @if ($errors->has('permanent_city'))
                                        {{ $errors->first('permanent_city') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-input">
                                <label class="required-label">State</label>
                                <select id="permanent_state" name="permanent_state"
                                    data-courses='@json($states)' class="js-single" required>
                                    <option value="">Select state</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">
                                            {{ $state->name }}</option>
                                    @endforeach
                                </select>
                                <span id="permanent_state_err" class="candidateErr">
                                    @if ($errors->has('permanent_state'))
                                        {{ $errors->first('permanent_state') }}
                                    @endif
                                </span>
                            </div>

                            <div class="form-input">
                                <label class="required-label">Pincode</label>
                                <input type="text" id="permanent_pincode" pattern="\d{6}" maxlength="6" name="permanent_pincode" class="pincode" placeholder="Enter your pincode"
                                    value="{{ old('permanent_pincode') }}" required>
                                <span id="permanent_pincode_err" class="candidateErr">
                                    @if ($errors->has('permanent_pincode'))
                                        {{ $errors->first('permanent_pincode') }}
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                            <div>Documents Upload</div>
                        </div>
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">

                            <div class="attachment_section_photos attachment_preview">
                                <label class="required-label">Upload Passport Size Photo</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="upload_photoss" name="upload_photoss"
                                        class="upload_photoss" placeholder="Upload Photo" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos"> Upload File
                                        <input id="upload_photos" type="file" name="upload_photos"
                                            class="hidden upload_photos">
                                    </label>
                                </div>
                                <p class="text-yellow-message">Only JPG, JPEG, and PNG files are allowed, with a maximum
                                    size of 2 MB</p>
                                <span id="upload_photos_err" class="candidateErr">
                                    @if ($errors->has('upload_photos'))
                                        {{ $errors->first('upload_photos') }}
                                    @endif
                                </span>
                            </div>

                            <div class="attachment_section_sign attachment_preview">
                                <label class="required-label">Upload Signature</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="upload_signaturee" name="upload_signaturee" class=""
                                        placeholder="Upload Signature" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_signature"> Upload File
                                        <input name="upload_signature" id="upload_signature" type="file"
                                            class="hidden upload_signature">

                                    </label>
                                </div>
                                <p class="text-yellow-message">Only JPG, JPEG, and PNG files are allowed, with a maximum
                                    size of 2 MB</p>
                                <span id="upload_signature_err" class="candidateErr">
                                    @if ($errors->has('upload_signature'))
                                        {{ $errors->first('upload_signature') }}
                                    @endif
                                </span>
                            </div>

                            <div class="attachment_section_upload_identity attachment_preview" style="display:none;">
                                <label>Upload Identity Proof </label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="upload_identity" name="upload_identity" placeholder="Upload Identity proof" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_identity_proof"> Upload File
                                        <input name="upload_identity_proof" id="upload_identity_proof" type="file"
                                            class="hidden upload_identity_proof">
                                    </label>
                                </div>
                                <p class="text-yellow-message">(PAN, Voter ID, Passport, Driving License or any valid photo ID issued by the Government.) Only PDF files are allowed, with a maximum size of 2 MB</p>
                                <span id="upload_identity_err" class="candidateErr">
                                    @if ($errors->has('upload_identity_proof'))
                                        {{ $errors->first('upload_identity_proof') }}
                                    @endif
                                </span>
                            </div>

                            @php
                                $selectedCaste = collect($castes)->firstWhere('id', old('category'));
                                $isGeneral = $selectedCaste && strtoupper($selectedCaste->caste) === 'GENERAL';
                                $shouldDisable = $isGeneral || old('category') == '';
                            @endphp

                            <div class="attachment_section_caste_certificate attachment_preview" style="display:none;">
                                <label>Proof of Caste (Category Certification)/ Proof of Income, if
                                    EWS</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="upload_caste_certificatee" name="upload_caste_certificatee" placeholder="Upload caste certificate" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_caste_certificate"> Upload
                                        File
                                        <input name="upload_caste_certificate" id="upload_caste_certificate"
                                            type="file" class="hidden upload_caste_certificate"
                                            {{ $shouldDisable ? 'disabled' : '' }}>
                                    </label>
                                </div>
                                <p class="text-yellow-message">Only PDF files are allowed, with a maximum size of 2 MB</p>
                                <span id="upload_caste_certificate_err" class="candidateErr">
                                    @if ($errors->has('upload_caste_certificate'))
                                        {{ $errors->first('upload_caste_certificate') }}
                                    @endif
                                </span>
                            </div>

                            <div class="attachment_section_disability_proof attachment_preview" style="display:none;">
                                <label>Proof of Physically Disabled</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="upload_disability_prooff" name="upload_disability_prooff"
                                        class="" placeholder="Upload disability proof" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_disability_proof"> Upload
                                        File
                                        <input name="upload_disability_proof" id="upload_disability_proof" type="file"
                                            class="hidden upload_disability_proof"
                                            {{ old('pwbd') !== 'Yes' ? 'disabled' : '' }}>

                                    </label>
                                </div>
                                <p class="text-yellow-message">Only PDF files are allowed, with a maximum size of 2 MB</p>
                                <span id="upload_disability_proof_err" class="candidateErr">
                                    @if ($errors->has('upload_disability_proof'))
                                        {{ $errors->first('upload_disability_proof') }}
                                    @endif
                                </span>
                            </div>
                            <div class="attachment_section_ex_serviceman_proof attachment_preview" style="display:none;">
                                <label class="">Proof of Ex Serviceman</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="upload_ex_serviceman_prooff"
                                        name="upload_ex_serviceman_prooff" class=""
                                        placeholder="Upload ex serviceman proof" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_ex_serviceman_proof">
                                        Upload
                                        File
                                        <input name="upload_ex_serviceman_proof" id="upload_ex_serviceman_proof"
                                            type="file" class="hidden upload_ex_serviceman_proof"
                                            {{ old('ex_serviceman') !== '1' ? 'disabled' : '' }}>
                                    </label>
                                </div>
                                <p class="text-yellow-message">Only PDF files are allowed, with a maximum size of 2 MB</p>
                                <span id="upload_ex_serviceman_proof_err" class="upload_ex_serviceman_proof candidateErr">
                                    @if ($errors->has('upload_ex_serviceman_proof'))
                                        {{ $errors->first('upload_ex_serviceman_proof') }}
                                    @endif
                                </span>
                            </div>
                            <div class="attachment_section_dob_proof attachment_preview">
                                <label class="required-label">Proof of DOB (<small>DOB as recorded in the Matriculation/10th Standard or equivalent certificate. Where Date of Birth is not available in certificate/mark sheets issued by the concerned educational boards, DOB as indicated in School Leaving Certificate will be considered.</small>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="upload_dob_prooff" name="upload_dob_prooff" class=""
                                        placeholder="Upload DOB proof" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_dob_proof"> Upload File
                                        <input name="upload_dob_proof" id="upload_dob_proof" type="file"
                                            class="hidden upload_dob_proof">

                                    </label>
                                </div>
                                <p class="text-yellow-message">Only PDF files are allowed, with a maximum size of 2 MB</p>
                                <div class="flex items-start mt-2">
                                    <div class="flex items-center h-5 inpus_cust_cs">
                                        <input type="hidden" name="dob_consent" id="dob_consent_hidden" value="0">
                                        <input type="checkbox" name="dob_consent" id="dob_consent" {{ old('dob_consent') ? 'checked' : '' }}>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="dob_consent" class="dark:text-gray-600 cursor-pointer text-sm">
                                            I hereby undertake to provide the original documents regarding date of birth, as issued by the appropriate authority, at the time of document verification, if shortlisted.
                                            I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                                        </label>
                                    </div>
                                </div>
                                <span id="upload_dob_proof_err" class="candidateErr">
                                    @if ($errors->has('upload_dob_proof'))
                                        {{ $errors->first('upload_dob_proof') }}
                                    @endif
                                </span>
                                <span id="dob_consent_err" class="error"></span>
                            </div>


                        </div>
                        <div class="button_flex_cust_form">
                            <button id="personalDetailsFormBtn" class="hover-effect-btn border_btn" type="button"> Save </button>
                            <button id="personalDetailsFormBtn1" class="tablink hover-effect-btn fill_btn" type="button">
                                Next
                            </button>
                        </div>
                    </form>
                </div>

                <div id="tab-2" class="tabcontent" style="display: {{ session('active_tab') == 'education' ? 'block' : 'none' }}">
                    <p>The details of educational qualifications should be provided from 10th standard onwards. </p>
                    <form id="educationalDetailsForm" method="POST"
                        action="{{ route('recruitment-portal.candidate.educational-details') }}" class="form_grid_cust"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                        <div id="educationalDetailsFormPrep">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_ applicat_cust-row" id="eduDevAdd_0">
                                <div class="">
                                    <label class="required-label">Examination <b>(10th, 12th, Graduation and Post-Graduation)</b></label>
                                    <input type="text" id="examination" name="examination" class=""
                                        placeholder="Examination">
                                    <span id="examination_err" class="examination_err candidateErr">
                                        @error('examination')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>

                                <div class="">
                                    <label class="required-label">Name of Institute/College</label>
                                    <input type="text" id="institute_name" name="institute_name" class=""
                                        placeholder="Name of Institute/College">
                                    <span id="institute_name_err" class="institute_name_err candidateErr">
                                        @error('institute_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>

                                <div class="">
                                    <label class="required-label">University/Board</label>
                                    <input type="text" id="university_board" name="university_board" class=""
                                        placeholder="University/Board">
                                    <span id="university_board_err" class="university_board_err candidateErr">
                                        @error('university_board')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>

                                <div class="">
                                    <label class="required-label">Passing Year</label>
                                    <select id="passing_year" name="passing_year"
                                        data-courses='@json($passing_years)' class="passing_year js-single"
                                        required>
                                        <option value="">Select passing year</option>
                                        @foreach ($passing_years as $passing_year)
                                            <option value="{{ $passing_year->id }}">
                                                {{ $passing_year->passing_year }}</option>
                                        @endforeach
                                    </select>
                                    <span id="passing_year_err" class="passing_year_err candidateErr">
                                        @error('passing_year')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>

                                <div class="">
                                    <label class="required-label">Percentage of marks/CGPA obtained</label>
                                    <input type="text" id="percentage_cgpa" name="percentage_cgpa" class=""
                                        placeholder="Percentage of marks/CGPA obtained">
                                    <span class="percentage_cgpa_err candidateErr">
                                        @error('percentage_cgpa')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>
                                <div class="attachment_section_marksheet_degree attachment_preview" style="display: none;">
                                    <label class="required-label">Marksheet / Degree </label>
                                    <div class="flex gap-[10px]">
                                        <input type="text" id="marksheet_degreee0" name="marksheet_degreee"
                                            class="marksheet_degreee" placeholder="Upload Marksheet / Degree" readonly>
                                        <label class="upload_cust mb-0 hover-effect-btn hide_marksheet_degree"> Upload File
                                            <input type="file" id="marksheet_degree" name="marksheet_degree" class="hidden marksheet_degree">
                                            <input type="hidden" id="eduClickedFrom" name="eduClickedFrom" value="">
                                        </label>
                                    </div>
                                    <p class="text-yellow-message">Only PDF files are allowed, with a maximum size of 2 MB
                                    </p>
                                    <span class="marksheet_degree_err candidateErr">
                                        @error('marksheet_degree')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-start mt-3">
                                <div class="flex items-center h-5 inpus_cust_cs">
                                    <input type="hidden" name="edu_confirm" id="edu_confirm_hidden" value="0">
                                    <input type="checkbox" class="w-4 h-4" name="edu_confirm" id="edu_confirm">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="edu_confirm" class="dark:text-gray-600 cursor-pointer">
                                        I hereby undertake to submit the documents regarding education qualification at the time of document verification, if shortlisted.
                                        I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                                    </label>
                                </div>
                            </div>
                            <span class="edu_confirm_err candidateErr">
                                @error('edu_confirm_err')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </span>
                        </div>
                        <div class="button_flex_cust_form">
                            <button id="educationalDetailsBtn1" class="hover-effect-btn border_btn" type="button"> Save & Add </button>
                            <button id="educationalDetailsBtn" class="tablink hover-effect-btn fill_btn" type="submit"> Next </button>
                        </div>
                    </form>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead class=" ">
                                <tr>
                                    <th scope="col" class=" ">
                                        #
                                    </th>
                                    <th scope="col">
                                        Examination
                                    </th>
                                    <th scope="col">
                                        Name of Institute/College
                                    </th>
                                    <th scope="col">
                                        University/Board
                                    </th>
                                    <th scope="col">
                                        Passing Year
                                    </th>
                                    <th scope="col">
                                        Percentage/CGPA
                                    </th>
                                    <!-- <th scope="col">
                                        Marksheet/Degree
                                    </th> -->
                                    <th scope="col" class="">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="eduTbody"></tbody>
                        </table>
                    </div>
                </div>

                @if ($record?->required_gate_detail == '1' && $record?->post_examination == 'GATE')
                <div id="tab-3" class="tabcontent" style="display: {{ session('active_tab') == 'gateScore' ? 'block' : 'none' }}">
                    <form id="gateScoreDataForm" action="{{ route('recruitment-portal.candidate.gate.score') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                        <input type="hidden" id="gateClickedFrom" name="gateClickedFrom" value="">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="form-input">
                                <label class="required-label">Year of GATE Exam</label>
                                <select name="gate_exam_year" id="gate_exam_year" data-validate="number" data-error="Please select gate exam year.">
                                    <option value="">--- Select year of GATE exam ---</option>
                                    @php
                                        $currentYear = date('Y');
                                        $filteredYears = $passing_years->filter(function ($year) use (
                                            $currentYear,
                                        ) {
                                            return $year->passing_year >= $currentYear - 2;
                                        });
                                        $filteredYears = $filteredYears->sortByDesc('passing_year');
                                    @endphp

                                    @foreach ($filteredYears as $passing_year)
                                        <option value="{{ $passing_year->id }}"
                                            {{ optional($gateScoreData)->ref_passing_year_id === $passing_year->id ? 'selected' : '' }}>
                                            {{ $passing_year->passing_year }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-input">
                                <label class="required-label">GATE Discipline</label>
                                <select name="gate_discpline" id="gate_discpline" data-validate="required" data-error="Please select gate discipline.">
                                    <option value="" disabled>--- Select GATE discipline ---</option>
                                    @forelse ($discipline as $disciplinesVal)
                                        <option value="{{ $disciplinesVal->id }}"
                                            {{ $disciplinesVal->id === 1 ? 'selected' : 'disabled' }}>
                                            {{ $disciplinesVal->discipline_name }}
                                        </option>
                                    @empty
                                        <option value="">No GATE discipline found</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-input">
                                <label class="required-label">GATE Registration Number</label>
                                <input type="text" id="gate_registration_number" name="gate_registration_number" data-validate="required" data-error="Please enter registration number."
                                    value="{{ optional($gateScoreData)->gate_registration_number ?? '' }}" pattern="^[A-Za-z0-9/]+$" placeholder="Enter GATE registration number">
                            </div>
                            <div class="form-input">
                                <label class="required-label">GATE Score</label>
                                <input type="text" name="gate_score" id="gate_score"
                                    value="{{ optional($gateScoreData)->gate_score ?? '' }}" class="gate_score" pattern="^\d+(\.\d{1,2})?$"
                                    placeholder="Enter your GATE score" data-validate="number" data-error="Please enter valid GATE score.">
                                <p class="fs-14"><b>Please enter your highest GATE score obtained as specified in Advertisement. For
                                    reference, you may <a href="{{ url('public/images/gate-score.png') }}"
                                        class="text-hover" target="_blank">Click Here</a> to view a sample scorecard indicating the location of the GATE Score.</b></p>
                            </div>
                            <!-- <div class="form-input" style="display:none;">
                                <label class="required-label">All India Rank</label>
                                <input type="text" id="all_india_rank" name="all_india_rank" value="{{ optional($gateScoreData)->all_india_rank ?? '' }}" pattern="^[0-9]+(\.[0-9]{1,2})?$"
                                    placeholder="Enter all india rank in test paper" data-validate="required" data-error="Please enter your all india rank.">
                            </div>
                            <div class="form-input" style="display:none;">
                                <label class="required-label">Total Number of Candidates</label>
                                <input type="text" id="number_of_candidate" name="number_of_candidate" value="{{ optional($gateScoreData)->number_of_candidate ?? '' }}" pattern="[0-9]+"
                                    placeholder="Enter number of candidate appeared for the test paper" data-validate="required" data-error="Please enter total number of candidate.">
                            </div>
                            <div class="form-input" style="display:none;">
                                <label class="required-label">Percentile</label>
                                <input type="text" id="gate_percentile" name="gate_percentile" value="{{ optional($gateScoreData)->gate_percentile ?? '' }}" placeholder="0.00"
                                    data-validate="required" data-error="Please enter total gate percetile." readonly>
                            </div> -->
                            <div class="attachment_section_gate_scorecard attachment_preview">
                                <label class="required-label">Upload GATE Scorecard</label>
                                @php
                                    $file = '';
                                    if (
                                        !empty($gateScoreData->gatescore_certificate_filepath) &&
                                        !empty($gateScoreData->gatescore_certificate)
                                    ) {
                                        $fileFullPath = $gateScoreData->gatescore_certificate_filepath;
                                        $fileName = $gateScoreData->gatescore_certificate;
                                        $file =
                                            url('recruitment-portal/candidate/advertisement/view/files') .
                                            '?pathName=' .
                                            urlencode($fileFullPath) .
                                            '&fileName=' .
                                            urlencode($fileName);
                                    }
                                @endphp
                                <div class="flex gap-[10px]">
                                    <input type="text" id="upload_gate_scorecardd" name="upload_gate_scorecardd" value="{{ old('upload_gate_scorecardd', $file) }}"
                                        placeholder="Upload GATE Scorecard poof" data-validate="required" data-error="Please upload GATE scorecard." readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_gate_scorecard"
                                        style="{{ $file ? 'display:none;' : '' }}"> Upload File
                                        <input name="upload_gate_scorecard" id="upload_gate_scorecard" type="file"
                                            class="hidden upload_gate_scorecard">
                                    </label>
                                </div>
                                <p class="text-yellow-message">Only PDF files are allowed, with a maximum size of 2 MB</p>
                                <div class="flex items-start mt-3">
                                    <div class="flex items-center h-5 inpus_cust_cs">
                                        <input type="hidden" name="gate_consent" id="gate_consent_hidden" value="0">
                                        <input type="checkbox" class="w-4 h-4" name="gate_consent" id="gate_consent" data-validate="required" data-error="Please choose gate consent." {{ $gateScoreData?->gate_consent == true ? 'checked' : '' }}>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="gate_consent" class="dark:text-gray-600 cursor-pointer text-sm">
                                            I hereby undertake to submit my GATE Score card at the time of document verification ,if shortlisted and give my consent for use of my GATE login credentials for verification/re-verification of my GATE Score by NHIDCL.
                                            I do understand that my documents are liable for scrutiny/verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/offer of appointment/ appointment at any time.
                                        </label>
                                    </div>
                                </div>
                                @if ($file)
                                    <div id="temp_120" class="my-3">
                                        <a target="_blank" href="{{ $file }}"
                                            class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80">
                                            View Document
                                        </a>
                                        &nbsp;
                                        <a href="javascript:void(0);"
                                            class="focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_gate_scorecard"
                                            data-id="0" data-name="{{ $fileName }}">
                                            Remove
                                        </a>
                                    </div>
                                @endif
                                <span id="upload_gate_scorecard_err" class="candidateErr">
                                    @if ($errors->has('upload_gate_scorecard'))
                                        {{ $errors->first('upload_gate_scorecard') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="button_flex_cust_form">
                            <button type="button" id="gateScoreDataBtn" class="hover-effect-btn border_btn"> Save </button>
                            <button type="button" id="gateScoreDataBtnNext" class="tablink hover-effect-btn fill_btn"> Next</button>
                        </div>
                    </form>
                    <div class="table_over" style="display:none">
                        <table class="cust_table__ table_sparated" id="gateScoreTableData">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Registration Number</th>
                                    <th>Exam Year</th>
                                    <th>GATE Discpline</th>
                                    <th>GATE Score</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                @else
                <div id="tab-3" class="tabcontent" style="display: {{ session('active_tab') == 'upscScore' ? 'block' : 'none' }}">
                    <form id="upscExamDataForm" action="{{ route('recruitment-portal.candidate.upsc.score') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="postids" value="{{ $record->id }}">
                        <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                        <input type="hidden" id="gateClickedFrom" name="gateClickedFrom" value="">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="form-input">
                                <label class="required-label">Year of UPSC CSE</label>
                                <select name="upsc_exam_year" id="upsc_exam_year" data-validate="number" data-error="Please select upsc exam year.">
                                    <option value="">--- Select year of UPSC CSE exam ---</option>
                                    @php
                                        $currentYear = date('Y');
                                        $filteredYears = $passing_years->filter(function ($year) use (
                                            $currentYear,
                                        ) {
                                            return $year->passing_year >= $currentYear - 1;
                                        });
                                        $filteredYears = $filteredYears->sortByDesc('passing_year');
                                    @endphp

                                    @foreach ($filteredYears as $passing_year)
                                    @if($passing_year->passing_year != $currentYear)
                                        <option value="{{ $passing_year->id }}"
                                            {{ optional($upscScoreData)->ref_passing_year_id === $passing_year->id ? 'selected' : '' }}>
                                            {{ $passing_year->passing_year }}
                                        </option>
                                    @endif
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-input">
                                <label class="required-label">UPSC CSE Roll Number</label>
                                <input type="text" id="upsc_cse_roll_number" name="upsc_cse_roll_number" data-validate="required" data-error="Please enter UPSC CSE roll number."
                                    value="{{ optional($upscScoreData)->upsc_cse_roll_number ?? '' }}" pattern="^[A-Za-z0-9/]+$" placeholder="Enter UPSC CSE roll number">
                            </div>
                            <div class="form-input">
                                <label class="required-label">UPSC CSE Mains Score</label>
                                <input type="text" id="upsc_cse_mains_marks" name="upsc_cse_mains_marks" data-validate="required" data-error="Please enter UPSC CSE mains score."
                                    value="{{ optional($upscScoreData)->upsc_cse_mains_marks ?? '' }}" pattern="^[A-Za-z0-9/]+$" placeholder="Enter UPSC CSE mains score">
                            </div>
                            <div class="form-input">
                                <label class="required-label">UPSC CSE Interview Score</label>
                                <input type="text" id="upsc_cse_interview_marks" name="upsc_cse_interview_marks" data-validate="required" data-error="Please enter UPSE interview score."
                                    value="{{ optional($upscScoreData)->upsc_cse_interview_marks ?? '' }}" pattern="^[A-Za-z0-9/]+$" placeholder="Enter UPSE CSE interview score">
                            </div>
                            <div class="form-input">
                                <label class="required-label">UPSC CSE Mains Percentile Score (as per UPSC Pratibha Setu portal)</label>
                                <input type="text" id="upsc_cse_mains_percentile" name="upsc_cse_mains_percentile" data-validate="required" data-error="Please enter UPSE CSE Mains Percentile Score."
                                    value="{{ optional($upscScoreData)->upsc_cse_mains_percentile ?? '' }}" pattern="^[A-Za-z0-9/]+$" placeholder="Enter UPSE CSE CSE Mains Percentile Score">
                            </div>

                            <div class="attachment_advertisement attachment_section_advertisement">
                                <label class="required-label">Upload UPSC CSE Interview/ Call Letter (<small>Max size 2MB & file should be pdf only</small>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="interview_call_letter_file_txt" name="interview_call_letter_file_txt" 
                                    value="{{ !empty($upscScoreData->interview_call_letter_filepath) && !empty($upscScoreData->interview_call_letter_file) 
                                    ? route('users.view.files', ['pathName' => $upscScoreData->interview_call_letter_filepath, 'fileName' => $upscScoreData->interview_call_letter_file]) 
                                    : '' }}"
                                    class="interview_call_letter_file_txt" placeholder="Upload UPSC CSE interview call letter" data-validate="required" data-error="Please upload UPSC CSE interview call letter." readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($upscScoreData->interview_call_letter_file ?? '') && !empty($upscScoreData->interview_call_letter_filepath ?? '')) style="display:none" @endif>
                                        Upload File
                                        <input type="file"
                                            name="upload_interview_call_letter_file"
                                            id="upload_interview_call_letter_file"
                                            class="hidden file-uploader"
                                            accept=".pdf"
                                            data-type="pdf"
                                            data-max-size="2000000"
                                            data-input-id="interview_call_letter_file_txt"
                                            data-preview-wrapper="interview_call_letter_file_preview"
                                            data-hidden-input="upload_interview_call_letter_file_hidden"
                                            data-upload-url="/users/upload/files/"
                                            data-view-url="/users/view/files/"
                                            data-file-path="/uploads/recruitment/applicant/">
                                    </label>
                                    <input type="hidden" name="upload_interview_call_letter_file_hidden" id="upload_interview_call_letter_file_hidden">
                                </div>
                                <div id="interview_call_letter_file_preview">
                                    @if(!is_null($upscScoreData) && !is_null($upscScoreData?->interview_call_letter_file) && !is_null($upscScoreData?->interview_call_letter_filepath))
                                    <a target="_blank" href="{{ route('users.view.files', ['pathName' => $upscScoreData->interview_call_letter_filepath, 'fileName' => $upscScoreData->interview_call_letter_file]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                    <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                    data-input-id="interview_call_letter_file_txt" data-wrapper-id="interview_call_letter_file_preview" data-hidden-input="upload_interview_call_letter_file_hidden">
                                    Remove
                                    </a>
                                    @endif
                                </div>
                            </div>

                            <div class="attachment_advertisement attachment_section_advertisement">
                                <label class="required-label">Upload UPSC CSE Mains Score Card (<small>Max size 2MB & file should be pdf only</small>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="upsc_cse_mains_score_file_txt" name="upsc_cse_mains_score_file_txt" 
                                    value="{{ !empty($upscScoreData->upsc_cse_mains_score_filepath) && !empty($upscScoreData->upsc_cse_mains_score_file) 
                                    ? route('users.view.files', ['pathName' => $upscScoreData->upsc_cse_mains_score_filepath, 'fileName' => $upscScoreData->upsc_cse_mains_score_file]) 
                                    : '' }}"
                                    class="upsc_cse_mains_score_file_txt" placeholder="Upload UPSC CSE mains score card" data-validate="required" data-error="Please Upload UPSC CSE mains score card." readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($upscScoreData->upsc_cse_mains_score_file ?? '') && !empty($upscScoreData->upsc_cse_mains_score_filepath ?? '')) style="display:none" @endif>
                                        Upload File
                                        <input type="file"
                                            name="upload_upsc_cse_mains_score_file"
                                            id="upload_upsc_cse_mains_score_file"
                                            class="hidden file-uploader"
                                            accept=".pdf"
                                            data-type="pdf"
                                            data-max-size="2000000"
                                            data-input-id="upsc_cse_mains_score_file_txt"
                                            data-preview-wrapper="upsc_cse_mains_score_file_preview"
                                            data-hidden-input="upload_upsc_cse_mains_score_file_hidden"
                                            data-upload-url="/users/upload/files/"
                                            data-view-url="/users/view/files/"
                                            data-file-path="/uploads/recruitment/applicant/">
                                    </label>
                                    <input type="hidden" name="upload_upsc_cse_mains_score_file_hidden" id="upload_upsc_cse_mains_score_file_hidden">
                                </div>
                                <div id="upsc_cse_mains_score_file_preview">
                                    @if(!is_null($upscScoreData) && !empty($upscScoreData->upsc_cse_mains_score_file) && !empty($upscScoreData->upsc_cse_mains_score_filepath))
                                    <a target="_blank" href="{{ route('users.view.files', ['pathName' => $upscScoreData->upsc_cse_mains_score_filepath, 'fileName' => $upscScoreData->upsc_cse_mains_score_file]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                    <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                    data-input-id="upsc_cse_mains_score_file_txt" data-wrapper-id="upsc_cse_mains_score_file_preview" data-hidden-input="upload_upsc_cse_mains_score_file_hidden">
                                    Remove
                                    </a>
                                    @endif
                                </div>
                            </div>

                            <div class="flex items-start mt-3">
                                <div class="flex items-center h-5 inpus_cust_cs">
                                    <input type="hidden" name="upsc_consent" id="upsc_consent_hidden" value="0">
                                    <input type="checkbox" class="w-4 h-4" name="upsc_consent" id="upsc_consent" data-validate="required" data-error="Please choose gate consent." {{ $upscScoreData?->upsc_consent == true ? 'checked' : '' }}>
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="upsc_consent" class="dark:text-gray-600 cursor-pointer text-sm">
                                        I hereby undertake to submit all necessary documents regarding UPSC CSE 2024 at the time of document verification, if shortlisted. I also confirm that I have appeared for UPSC CSE 2024 interview and I do understand that selection shall be based on the percentile score obtained in the UPSC CSE 2024 and verification with UPSC Pratibha Setu portal. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment at any time.
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="button_flex_cust_form">
                            <button type="button" id="upscScoreDataBtn" class="hover-effect-btn border_btn"> Save </button>
                            <button type="button" id="upscScoreDataBtnNext" class="tablink hover-effect-btn fill_btn"> Next</button>
                        </div>
                    </form>
                </div>
                @endif

                <div id="tab-4" class="tabcontent" style="display: {{ session('active_tab') == 'work' ? 'block' : 'none' }}">
                    <label>Whether you want to submit your work experience details: </label>
                    @php
                        $experience = $previewData?->experience ?? [];
                    @endphp
                    <div class="form-input">
                        <input type="radio" name="submit_experience" id="submit_experience1" value="1" @if(count($experience) > 0) checked @endif> Yes
                        <input type="radio" name="submit_experience" id="submit_experience2" value="2"
                            @if($previewData?->submit_experience==2) checked @endif> No
                    </div>
                    <div class="experience-data" id="experience-data" @if(count($experience)<=0 || $previewData?->submit_experience ===2) style="display: none;" @endif>
                        <form id="workExperienceDetailsForm" method="POST"
                            action="{{ route('recruitment-portal.candidate.work-experience-details') }}"
                            class="form_grid_cust" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                            <div class="workExperienceDetailsRow">
                                <div class="inpus_cust_cs form_grid_dashboard_cust_ workExpAdDev applicat_cust-row">
                                    <div class="">
                                        <label class="required-label">Employer Name / Department / Organisation Name</label>
                                        <input id="employer_name" name="employer_name" type="text" class=""
                                            placeholder="Employer name" value="{{ old('employer_name') ?? '' }}">
                                        <span id="employer_name_err" class="candidateErr employer_name_err">
                                            @error('employer_name')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="">
                                        <label class="required-label">Post Held</label>
                                        <input id="post_held" name="post_held" required maxlength="500" type="text"
                                            class="" placeholder="Post Held"
                                            value="{{ old('post_held') ?? '' }}">
                                        <span id="post_held_err" class="candidateErr post_held_err">
                                            @error('post_held')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label class="required-label">From Date</label>
                                        <input type="date" id="from_date" name="from_date" class="">
                                        <span id="from_date_err" class="candidateErr from_date_err">
                                            @error('from_date')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label class="required-label">To Date</label>
                                        <input type="date" id="to_date" name="to_date" class="">
                                        <span id="to_date_err" class="candidateErr to_date_err"
                                            value="{{ old('to_date') }}">
                                            @error('to_date')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label class="required-label">Brief Job Description(Max.500 Characters)</label>
                                        <textarea rows="3" class="" maxlength="500" id="job_description" name="job_description"
                                            placeholder="Brief Job Description">{{ old('job_description') }}</textarea>
                                        <span id="job_description_err" class="candidateErr job_description_err">
                                            @error('job_description')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="attachment_section_experience_certificate attachment_preview" style="display:none;">
                                        <label class="required-label">Upload Work Experience Certificate or any other Proof
                                            of
                                            Employment</label>
                                        <div class="flex gap-[10px]">
                                            <input type="text" id="experience_certificatee"
                                                name="experience_certificatee" class="experience_certificatee"
                                                placeholder="Upload Experience Certificate" readonly>
                                            <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                                <input id="experience_certificate" name="experience_certificate"
                                                    type="file" class="hidden experience_certificate">
                                                <input type="hidden" id="workClickedFrom" name="workClickedFrom"
                                                    value="">
                                            </label>
                                        </div>
                                        <p class="text-yellow-message">Only PDF files are allowed, with a maximum size of 2
                                            MB
                                        </p>
                                        <span id="experience_certificate_err"
                                            class="candidateErr experience_certificate_err">
                                            @error('experience_certificatee')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="flex items-start mb-4">
                                        <div class="flex items-center h-5 inpus_cust_cs">
                                            <input type="hidden" name="experience_consent" value="0">
                                            <input type="checkbox" name="experience_consent" id="experience_consent" value="1"  data-validate="required" data-error="You must accept experience consent." {{ old('experience_consent') ? 'checked' : '' }} required>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="experience_consent" class="dark:text-gray-600 cursor-pointer text-sm">
                                                I hereby undertake to submit the documents regarding work experience, at the time of document verification, if shortlisted.
                                                I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                                            </label>
                                        </div>
                                        <span id="experience_consent_err" class="candidateErr experience_consent_err">
                                            @error('experience_consent_err')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="button_flex_cust_form">
                                <button type="button" id="workExperienceDetailsBtn1" class="hover-effect-btn border_btn">Save & Add</button>
                                <button type="button" id="workExperienceSkipBtn" class="tablink hover-effect-btn fill_btn"> Next </button>
                                <!-- <button type="button" id="workExperienceSkipBtn" class="tablink hover-effect-btn fill_btn" >Skip</button> -->
                            </div>
                        </form>
                        @if(isset($previewData) && sizeof($previewData?->experience)>0)
                        <div class="table_over">
                            <table class="cust_table__ table_sparated">
                                <thead class=" ">
                                    <tr>
                                        <th>#</th>
                                        <th>Employer Name</th>
                                        <th>Post Held</th>
                                        <th>From - To Date</th>
                                        <th>Experience</th>
                                        <th>Brief Job Description</th>
                                        <!-- <th>Experience Certificate</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($previewData?->experience ?? [] as $experienceData)
                                        @php
                                            $from = \Carbon\Carbon::parse($experienceData->from_date);
                                            $to = $experienceData->to_date
                                                ? \Carbon\Carbon::parse($experienceData->to_date)
                                                : now();

                                            $diff = $from->diff($to); // gives DateInterval (years, months, days)

                                            $experience = [];
                                            if ($diff->y > 0) {
                                                $experience[] = $diff->y . ' Year' . ($diff->y > 1 ? 's' : '');
                                            }
                                            if ($diff->m > 0) {
                                                $experience[] = $diff->m . ' Month' . ($diff->m > 1 ? 's' : '');
                                            }
                                            //if ($diff->d > 0) $experience[] = $diff->d . ' Day' . ($diff->d > 1 ? 's' : '');

                                            $experienceText = count($experience)
                                                ? implode(' ', $experience)
                                                : 'less than 1 Month';
                                        @endphp
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $experienceData->employer_name }}</td>
                                            <td>{{ $experienceData->post_held }}</td>
                                            <td>{{ $from->format('d M Y') }} -
                                                {{ $experienceData->to_date ? $to->format('d M Y') : 'Present' }}</td>
                                            <td>{{ $experienceText }}</td>
                                            <td>{{ $experienceData->job_description }}</td>
                                            <!-- <td>
                                                <a href="{{ route('recruitment-portal.candidate.advertisement.viewfiles', [
                                                    'pathName' => $experienceData->experience_certificate_filepath,
                                                    'fileName' => $experienceData->experience_certificate,
                                                ]) }}"
                                                    class="btn btn-default btn-sm" target="_blank">
                                                    View Certificate
                                                </a>
                                            </td> -->
                                            <td>
                                                <button type="button"
                                                        onclick="confirmDelete({{ $experienceData->id }})"
                                                        class="btn btn-danger btn-sm">
                                                    Delete
                                                </button>

                                                <form id="delete-form-{{ $experienceData->id }}"
                                                    action="{{ route('recruitment-portal.candidate.work-experience-details.delete', Crypt::encrypt($experienceData->id)) }}"
                                                    method="POST"
                                                    style="display: none;">
                                                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>


                                        </tr>
                                    @empty
                                        <tr>
                                            <th colspan="6">No Records found</th>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                    <div class="skip-button mt-4 text-right" id="skip-button" @if($previewData?->submit_experience!=2) style="display: none;" @endif>
                        <form id="experienceChoiceForm" method="POST" action="{{ route('recruitment-portal.candidate.work-experience-choice') }}">
                            @csrf
                            <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                            <input type="hidden" name="submit_experience" value="2">

                            <button type="submit" name="actiontype" value="save" class="hover-effect-btn border_btn">Save</button>
                            <button type="submit" id="workExperienceSkipBtn" class="tablink hover-effect-btn fill_btn">Next</button>
                        </form>
                    </div>
                </div>

                <div id="tab-5" class="tabcontent" style="display: {{ session('active_tab') == 'stateGroup' ? 'block' : 'none' }}">
                    <p>NHIDCL operates into 14 different States /Union Territories ,which are grouped into 4 State groups as under:- </p>
                    <form id="stateGroupDataForm" action="{{ route('recruitment-portal.candidate.state.group.choice') }}" method="POST"
                        class="form_grid_cust" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                        <div class="workExperienceDetailsRow">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_ workExpAdDev candidat_cust-container">
                                <div class="form-input">
                                    <label><strong>Group 1</strong></label>
                                    <div class="group-cards">
                                        <label class="group-card group-card-custom">
                                            Assam, Manipur, Nagaland
                                        </label>
                                    </div>
                                </div>
                                <div class="form-input">
                                    <label><strong>Group 2</strong></label>
                                    <div class="group-cards">
                                        <label class="group-card group-card-custom">
                                            Arunachal Pradesh, Meghalaya, Mizoram
                                        </label>
                                    </div>
                                </div>
                                <div class="form-input">
                                    <label><strong>Group 3</strong></label>
                                    <div class="group-cards">
                                        <label class="group-card group-card-custom">
                                            Tripura, Sikkim, West Bengal (North Bengal), Andaman & Nicobar Islands
                                        </label>
                                    </div>
                                </div>
                                <div class="form-input">
                                    <label><strong>Group 4</strong></label>
                                    <div class="group-cards">
                                        <label class="group-card group-card-custom">
                                            Jammu & Kashmir, Ladakh, Uttarakhand, Himachal Pradesh
                                        </label>
                                    </div>
                                </div>

                                <!-- <input type="hidden" name="priority_choice_first_states" id="priority_choice_first_states" value="{{ implode(',', json_decode(optional($previewData)->ref_priority_first_state_id ?? '[]', true)) }}">
                                <input type="hidden" name="priority_choice_second_states" id="priority_choice_second_states" value="{{ implode(',', json_decode(optional($previewData)->ref_priority_second_state_id ?? '[]', true)) }}">
                                <input type="hidden" name="priority_choice_three_states" id="priority_choice_three_states" value="{{ implode(',', json_decode(optional($previewData)->ref_priority_third_state_id ?? '[]', true)) }}"> -->

                                {{-- <div class="form-input">
                                    <label class="required-label">Priority 1 Choice</label>
                                    <div class="group-cards">
                                        <label class="group-card">
                                            <input type="radio" name="priority_choice_first" value="1"
                                                data-state-id="4,19,22"
                                                {{ $previewData?->priority_choice_first === 1 ? 'checked' : '' }}
                                                required>
                                            <b>Group 1</b><br>
                                            Assam, Manipur, Nagaland
                                        </label>
                                        <label class="group-card">
                                            <input type="radio" name="priority_choice_first" value="2"
                                                data-state-id="3,20,21"
                                                {{ $previewData?->priority_choice_first === 2 ? 'checked' : '' }}>
                                            <b>Group 2</b><br>
                                            Arunachal Pradesh, Meghalaya, Mizoram
                                        </label>
                                        <label class="group-card">
                                            <input type="radio" name="priority_choice_first" value="3"
                                                data-state-id="30,27,33,1"
                                                {{ $previewData?->priority_choice_first === 3 ? 'checked' : '' }}>
                                            <b>Group 3</b><br>
                                            Tripura, Sikkim, West Bengal (North Bengal), Andaman & Nicobar Islands
                                        </label>
                                        <label class="group-card">
                                            <input type="radio" name="priority_choice_first" value="4"
                                                data-state-id="13,35,32,12"
                                                {{ $previewData?->priority_choice_first === 4 ? 'checked' : '' }}>
                                            <b>Group 4</b><br>
                                            Jammu & Kashmir, Ladakh, Uttarakhand, Himachal Pradesh
                                        </label>
                                    </div>
                                    <input type="hidden" name="priority_choice_first_states"
                                        id="priority_choice_first_states"
                                        value="{{ implode(',', json_decode(optional($previewData)->ref_priority_first_state_id ?? '[]', true)) }}">
                                </div>
                                <div class="form-input">
                                    <label class="required-label">Priority 2 Choice</label>
                                    <div class="group-cards">
                                        <label class="group-card">
                                            <input type="radio" name="priority_choice_second" value="1"
                                                data-state-id="4,19,22"
                                                {{ $previewData?->priority_choice_second === 1 ? 'checked' : '' }}
                                                required>
                                            <b>Group 1</b><br>
                                            Assam, Manipur, Nagaland
                                        </label>
                                        <label class="group-card">
                                            <input type="radio" name="priority_choice_second" value="2"
                                                data-state-id="3,20,21"
                                                {{ $previewData?->priority_choice_second === 2 ? 'checked' : '' }}>
                                            <b>Group 2</b><br>
                                            Arunachal Pradesh, Meghalaya, Mizoram
                                        </label>
                                        <label class="group-card">
                                            <input type="radio" name="priority_choice_second" value="3"
                                                data-state-id="30,27,33,1"
                                                {{ $previewData?->priority_choice_second === 3 ? 'checked' : '' }}>
                                            <b>Group 3</b><br>
                                            Tripura, Sikkim, West Bengal (North Bengal), Andaman & Nicobar Islands
                                        </label>
                                        <label class="group-card">
                                            <input type="radio" name="priority_choice_second" value="4"
                                                data-state-id="13,35,32,12"
                                                {{ $previewData?->priority_choice_second === 4 ? 'checked' : '' }}>
                                            <b>Group 4</b><br>
                                            Jammu & Kashmir, Ladakh, Uttarakhand, Himachal Pradesh
                                        </label>
                                    </div>
                                    <input type="hidden" name="priority_choice_second_states"
                                        id="priority_choice_second_states"
                                        value="{{ implode(',', json_decode(optional($previewData)->ref_priority_second_state_id ?? '[]', true)) }}">
                                </div>
                                <div class="form-input">
                                    <label class="required-label">Priority 3 Choice</label>
                                    <div class="group-cards">
                                        <label class="group-card">
                                            <input type="radio" name="priority_choice_three" value="1"
                                                data-state-id="4,19,22"
                                                {{ $previewData?->priority_choice_third === 1 ? 'checked' : '' }}
                                                required>
                                            <b>Group 1</b><br>
                                            Assam, Manipur, Nagaland
                                        </label>
                                        <label class="group-card">
                                            <input type="radio" name="priority_choice_three" value="2"
                                                data-state-id="3,20,21"
                                                {{ $previewData?->priority_choice_third === 2 ? 'checked' : '' }}>
                                            <b>Group 2</b><br>
                                            Arunachal Pradesh, Meghalaya, Mizoram
                                        </label>
                                        <label class="group-card">
                                            <input type="radio" name="priority_choice_three" value="3"
                                                data-state-id="30,27,33,1"
                                                {{ $previewData?->priority_choice_third === 3 ? 'checked' : '' }}>
                                            <b>Group 3</b><br>
                                            Tripura, Sikkim, West Bengal (North Bengal), Andaman & Nicobar Islands
                                        </label>
                                        <label class="group-card">
                                            <input type="radio" name="priority_choice_three" value="4"
                                                data-state-id="13,35,32,12"
                                                {{ $previewData?->priority_choice_third === 4 ? 'checked' : '' }}>
                                            <b>Group 4</b><br>
                                            Jammu & Kashmir, Ladakh, Uttarakhand, Himachal Pradesh
                                        </label>
                                    </div>
                                    <input type="hidden" name="priority_choice_three_states" id="priority_choice_three_states"
                                        value="{{ implode(',', json_decode(optional($previewData)->ref_priority_third_state_id ?? '[]', true)) }}">
                                </div> --}}

                            </div>
                        </div>

                        <br/>

                        <label>
                            <input type="hidden" name="state_group_confirm" id="state_group_confirm_hidden" value="0">
                            <input type="checkbox" name="state_group_confirm" id="state_group_confirm" {{ $previewData?->state_group_confirm === 1 ? 'checked' : '' }} data-validate="checkbox" data-error="Please checked state group form consent.">
                            <span>I hereby confirm that, if selected, I may be allocated to a particular State Group on the basis of principle of Merit-cum-Choice through a counselling session. NHIDCL Cadre Rules, 2025; specifically Rule 6.5 and Rule 6.6 shall be referred for more details.</span>
                        </label>

                        <br>

                        {{-- <p><small>Note 1:- Candidate may be posted in any of the state groups irrespective of the choice given.</small></p>
                        <p><small class="text-muted">Note 2:- For more details about the State Groups please refer to the <a href="https://www.nhidcl.com/sites/default/files/Circular/nhidcl_rectt._seniority_and_promotion_rules-2025_1.pdf" target="_blank" class="text-hover">NHIDCL Cadre Rules</a>.</small></p> --}}
                        <div class="button_flex_cust_form">
                            <button type="submit" id="stateGroupDataSaveBtn" class="hover-effect-btn border_btn">Save</button>
                            <button type="submit" id="stateGroupDataBtn" class="tablink hover-effect-btn fill_btn">Next</button>
                        </div>
                    </form>
                </div>

                @if (trim($record?->post_payment_type) == 'Paid')
                <div id="tab-6" class="tabcontent" style="display: {{ session('active_tab') == 'payment' ? 'block' : 'none' }}">
                    @include('payment.from', ['from' => 'advertisement', 'id' => $record?->id])
                </div>
                @endif
                @endif
                
                <div id="tab-7" class="previewBorder {{ $recordApplication?->action === 'submit' ? 'preview' : 'tabcontent' }}">

                    @if ($recordApplication?->action==="submit")
                        <div class="text-right">
                            <button type="button" class="hover-effect-btn fill_btn"
                                onclick="event.preventDefault(); document.getElementById('downloadProfileForm').submit();">Download
                                Application</button>
                            <form id="downloadProfileForm"
                                action="{{ route('recruitment-portal.candidate.profile.download') }}" method="POST"
                                style="display: none;">
                                @csrf
                                <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                                <input type="hidden" name="postid" value="{{ $record->id ?? '0' }}">
                            </form>
                        </div>
                    @endif
                    <!-- <div class="flex flex-row items-end" style="justify-content: space-around;">
                        @if (!empty($previewData?->upload_photos))
                        <div class="p-5">
                            <img class="img-responsive" src="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_photos_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_photos) }}" alt="" width="100" height="100">
                            <h4 class="applicat_cust-title text-center">Photo</h4>
                        </div>
                        @endif
                        @if (!empty($previewData?->upload_signature))
                        <div class="p-5">
                            <img class="img-responsive" src="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_signature_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_signature) }}" alt="" width="100" height="100">
                            <h4 class="applicat_cust-title text-center">Signature</h4>
                        </div>
                        @endif
                    </div> -->

                    <div class="applicat_cust-container mt-3">
                        <div class="applicat_cust-row">
                            @if (!empty($previewData?->upload_photos))
                            <div class="applicat_cust-label">
                                <div class="w-fit text-center">
                                    <img class="img-responsive" src="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_photos_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_photos) }}" alt="" width="100" height="100">
                                    <h4 class="applicat_cust-title text-center">Passport Size Photo</h4>
                                </div>
                            </div>
                            @endif
                            @if (!empty($previewData?->upload_signature))
                            <div class="applicat_cust-value">
                                <div class="w-fit text-center">
                                    <img class="img-responsive" src="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_signature_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_signature) }}" alt="" width="100" height="100">
                                    <h4 class="applicat_cust-title text-center">Signature</h4>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="download_prive_cust">
                        <h4 class="applicat_cust-title">Personal Details</h4>
                    </div>
                    <div class="applicat_cust-container">
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Application ID</div>
                            <div class="applicat_cust-value" id="previewId">
                                {{ 
                                $recordApplication?->action === 'draft'
                                    ? ($recordApplication?->id ?? '')
                                    : (
                                        $recordApplication?->action
                                            ? 'NHIDCL/' . date('Y') . '/' . ($record->id ?? '') . '/' . ($previewData?->user?->id ?? '')
                                            : ($recordApplication?->id ?? $previewData?->user?->id)
                                    )
                                }}
                            </div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Post Name</div>
                            <div class="applicat_cust-value" id="previewName">{{ $record?->post_name ?? '' }}
                            </div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Full Name</div>
                            <div class="applicat_cust-value" id="previewName">{{ $previewData?->name ?? $previewData?->user?->name ?? '' }}
                            </div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Father’s/Husband’s Name</div>
                            <div class="applicat_cust-value" id="previewFnameHname">
                                {{ $previewData?->father_husband_name ?? '' }}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Mother Name</div>
                            <div class="applicat_cust-value" id="previewFnameHname">
                                {{ $previewData?->mother_name ?? '' }}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Email</div>
                            <div class="applicat_cust-value" id="previewEmail">
                                {{ $previewData?->email ?? $previewData?->user?->email ?? '' }}
                            </div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Mobile No</div>
                            <div class="applicat_cust-value" id="previewMobileNo">
                                {{ $previewData?->mobile ?? $previewData?->user?->mobile ?? '' }}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Date of Birth</div>
                            <div class="applicat_cust-value" id="previewDob">
                                @php
                                    $dob = $previewData?->date_of_birth ?? $previewData?->user?->date_of_birth;
                                @endphp
                                {{ $dob ? \Carbon\Carbon::parse($dob)->format('d-m-Y') : '' }}
                            </div>
                        </div>
                        {{-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">
                                I hereby undertake to provide the original documents regarding date of birth, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.    
                            </div>
                            <div class="applicat_cust-value" id="previewGender">
                                {{ $previewData?->dob_consent == 1 ? 'Yes' : 'No' }}
                            </div>
                        </div> --}}
                        <div class="mt-2 p-4">
                            <label>
                                <input type="checkbox"  {{ $previewData?->dob_consent == 1 ? 'checked' : '' }} disabled>
                                I hereby undertake to provide the original documents regarding date of birth, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.  
                            </label>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Gender</div>
                            <div class="applicat_cust-value" id="previewGender">{{ $previewData?->gender ?? '' }}
                            </div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Marital Status</div>
                            <div class="applicat_cust-value">{{ $previewData?->marital_status ?? '' }}</div>
                        </div>
                        @if($previewData?->marital_status=="Married")
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Spouse Name</div>
                            <div class="applicat_cust-value">{{ $previewData?->spouse_name ?? '' }}</div>
                        </div>
                        @endif
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Citizenship</div>
                            <div class="applicat_cust-value" id="previewGender">
                                {{ $previewData?->indian_citizen ?? '' }}</div>
                        </div>
                        {{-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">
                                I hereby undertake to submit the documents regarding citizenship, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </div>
                            <div class="applicat_cust-value" id="previewGender">
                                {{ $previewData?->citizenship_consent == 1 ? 'Yes' : 'No' }}
                            </div>
                             </div> --}}

                        <div class="mt-2 p-4">
                            <label>
                                <input type="checkbox"  {{ $previewData?->citizenship_consent == 1 ? 'checked' : '' }} disabled>
                                I hereby undertake to submit the documents regarding citizenship, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </label>
                        </div>
                       
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Category</div>
                            <div class="applicat_cust-value">{{ optional($previewData)->caste->caste ?? '' }}
                                @if (!empty($previewData?->upload_caste_proof))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_caste_proof_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_caste_proof) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank">
                                        <small>View Certificate</small>
                                    </a>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">
                                I hereby undertake to submit the documents regarding category, as per the prescribed proforma, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </div>
                            <div class="applicat_cust-value" id="previewGender">
                                {{ $previewData?->category_confirm == 1 ? 'Yes' : 'No' }}
                            </div>
                        </div> --}}
                        @if (strtolower(optional($previewData)->caste->caste ?? '') !== 'general')
                        <div class="mt-2 p-4">
                            <label>
                                <input type="checkbox"  {{ $previewData?->category_confirm == 1 ? 'checked' : '' }} disabled>
                                   I hereby undertake to submit the documents regarding category, as per the prescribed proforma, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </label>
                        </div>
                        @endif
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Aadhaar Number</div>
                            <div class="applicat_cust-value">{{ optional($previewData)->aadhar_number ?? '' }}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Ex Service Man</div>
                            <div class="applicat_cust-value">
                                {{ is_null(optional($previewData)->ex_serviceman) ? '' : (optional($previewData)->ex_serviceman ? 'Yes' : 'No') }}
                            </div>
                        </div>
                        {{-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">
                                I hereby undertake to submit the documents regarding ex-servicemen, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.    
                            </div>
                            <div class="applicat_cust-value" id="previewGender">
                                {{ $previewData?->ex_serviceman_consent == 1 ? 'Yes' : 'No' }}
                            </div>
                        </div> --}}
                        @if (optional($previewData)->ex_serviceman)
                        <div class="mt-2 p-4">
                            <label>
                                <input type="checkbox"  {{ $previewData?->ex_serviceman_consent == 1 ? 'checked' : '' }} disabled>
                                 I hereby undertake to submit the documents regarding ex-servicemen, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.   
                            </label>
                        </div>
                        @endif
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Whether you are PwBD or not</div>
                            <div class="applicat_cust-value">
                                {{ $previewData?->pwbd ?? '' }}
                            </div>
                        </div>
                        @if($previewData?->pwbd==="Yes")
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Nature of disability</div>
                            <div class="applicat_cust-value">
                                {{ $previewData?->disability ?? '' }}
                            </div>
                        </div>
                        @endif
                        @if (strtolower(optional($previewData)->pwbd) === "yes")
                        <div class="mt-2 p-4">
                            <label>
                                <input type="checkbox"  {{ $previewData?->disability_consent == 1 ? 'checked' : '' }} disabled>
                                I hereby clarify that my disability is not less than 40%. I hereby undertake to submit the documents regarding disability, as per the prescribed proforma, at the time of document verification, if shortlisted.
                                I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </label>
                        </div>
                        @endif
                        {{-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">
                                I hereby clarify that my disability is not less than 40%. I hereby undertake to submit the documents regarding disability, as per the prescribed proforma, at the time of document verification, if shortlisted.
                                I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </div>
                            <div class="applicat_cust-value" id="previewGender">
                                {{ $previewData?->disability_consent == 1 ? 'Yes' : 'No' }}
                            </div>
                        </div>
                         --}}

                        {{-- <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Religion</div>
                        <div class="applicat_cust-value">{{ optional($previewData)->religion ?? ''  }}</div>
                        </div> --}}
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Correspondence Address</div>
                            <div class="applicat_cust-value" id="previewCaddress">
                                {{ implode(
                                    ', ',
                                    array_filter([
                                        $previewData?->correspondence_address,
                                        $previewData?->correspondence_city,
                                        $previewData?->correspondenceState?->name . ', ' . $previewData?->correspondence_pincode,
                                    ]),
                                ) }}
                            </div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Permanent Address</div>
                            <div class="applicat_cust-value" id="previewPaddress">
                                {{ implode(
                                    ', ',
                                    array_filter([
                                        $previewData?->permanent_address,
                                        $previewData?->permanent_city,
                                        $previewData?->permanentState?->name . ', ' . $previewData?->permanent_pincode,
                                    ]),
                                ) }}
                            </div>
                        </div>
                        @if (!empty($previewData?->upload_photos_filepath) && !empty($previewData?->upload_photos))
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Candidate Photo</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_photos))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_photos_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_photos) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Photo</small></a>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if (!empty($previewData?->upload_signature_filepath) && !empty($previewData?->upload_signature))
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Candidate Signature</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_signature))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_signature_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_signature) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Signature</small></a>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if (!empty($previewData?->upload_identity_proof_filepath) && !empty($previewData?->upload_identity_proof))
                        <!-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Identity Proof</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_identity_proof))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_identity_proof_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_identity_proof) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Identity Proof</small></a>
                                @endif
                            </div>
                        </div> -->
                        @endif
                        @if (!empty($previewData?->upload_identity_caste_certificate_filepath) && !empty($previewData?->upload_caste_certificate))
                        <!-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Caste/Category Proof</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_caste_certificate))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_caste_certificate_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_caste_certificate) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Caste Certificate</small></a>
                                @endif
                            </div>
                        </div> -->
                        @endif
                        @if (optional($previewData)->pwbd === 'Yes' && !empty($previewData?->upload_disability_proof_filepath) && !empty($previewData?->upload_disability_proof))
                        <!-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Proof of Physically Disabled</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_disability_proof))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_disability_proof_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_disability_proof) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Certificate</small></a>
                                @endif
                            </div>
                        </div> -->
                        @endif
                        @if (optional($previewData)->ex_serviceman && !empty($previewData?->upload_ex_serviceman_proof_filepath) && !empty($previewData?->upload_ex_serviceman_proof))
                        <!-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Proof of Ex Serviceman</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_ex_serviceman_proof))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_ex_serviceman_proof_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_ex_serviceman_proof) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Certificate</small></a>
                                @endif
                            </div>
                        </div> -->
                        @endif
                        @if (!empty($previewData?->upload_dob_proof_filepath) && !empty($previewData?->upload_dob_proof))
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Proof Of DOB</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_dob_proof))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_dob_proof_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_dob_proof) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Certificate</small></a>
                                @endif
                            </div>
                        </div>
                         <div class="mt-2 p-4">
                                <label>
                                    <input type="checkbox" checked="" disabled="">
                                   I hereby undertake to provide the original documents regarding date of birth, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                                </label>
                            </div>
                        @endif
                    </div>
                    <h4 class="applicat_cust-title mt-3">Education Qualification</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Examination</th>
                                    <th>Name of Institute/College</th>
                                    <th>University/Board</th>
                                    <th>Passing Year</th>
                                    <th>Percentage/CGPA</th>
                                    <!-- <th>Marksheet/Degree</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($previewData?->education ?? [] as $educationData)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $educationData?->examination }}</td>
                                        <td>{{ $educationData?->institute_name }}</td>
                                        <td>{{ $educationData?->university_board }}</td>
                                        <td>{{ $educationData?->passingYear?->passing_year }}</td>
                                        <td>{{ $educationData?->percentage_cgpa }}</td>

                                        <!-- <td>
                                            <a href="{{ route('recruitment-portal.candidate.advertisement.viewfiles', [
                                                'pathName' => $educationData->marksheet_filepath,
                                                'fileName' => $educationData->marksheet,
                                            ]) }}"
                                                class="btn btn-default btn-sm" target="_blank">
                                                View Marksheet
                                            </a>
                                        </td> -->
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="6">No Records found</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-2 text-sm">
                            <label><input type="checkbox" checked disabled> I hereby undertake to submit the documents regarding education qualification at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.</label>
                        </div>
                    </div>
                    @if ($record?->required_gate_detail == '1' && $record?->post_examination == 'GATE')
                    <h4 class="applicat_cust-title mt-3">GATE Score Details</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead class=" ">
                                <tr>
                                    <th>#</th>
                                    <th>Registration Number</th>
                                    <th>Exam Year</th>
                                    <th>GATE Discpline</th>
                                    <th>GATE Score</th>
                                    <th>GATE Scorecard Certificate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($previewData->gatescore ?? [] as $gatescoreData)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $gatescoreData->gate_registration_number }}</td>
                                        <td>{{ optional($gatescoreData->passingYear)->passing_year }}
                                        </td>
                                        <td>{{ optional($gatescoreData->gateDiscpline)->discipline_name }}
                                        </td>
                                        <td>{{ $gatescoreData->gate_score }}</td>
                                        <td><a href="{{ route('recruitment-portal.candidate.advertisement.viewfiles', [
                                            'pathName' => $gatescoreData->gatescore_certificate_filepath,
                                            'fileName' => $gatescoreData->gatescore_certificate,
                                        ]) }}"
                                                class="btn btn-default btn-sm" target="_blank">
                                                View Certificate
                                            </a></td>
                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="5">No Records found</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-2 text-sm">
                            <label>
                                <input type="checkbox" checked disabled>
                                I hereby undertake to submit my GATE Score card at the time of document verification, if shortlisted and give my consent for use of my GATE login credentials for verification/re-verification of my GATE Score by NHIDCL. I do understand that my documents are liable for scrutiny/verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/offer of appointment/ appointment at any time.
                            </label>
                        </div>
                    </div>
                    @else
                    <h4 class="applicat_cust-title mt-3">UPSC CSE Details</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead class=" ">
                                <tr>
                                    <th>#</th>
                                    <th>Exam Year</th>
                                    <th>Roll Number</th>
                                    <th>Mains Score</th>
                                    <th>Interview Score</th>
                                    <th>Interview Call Letter</th>
                                    <th>Mains Score Card</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($previewData->upscscore ?? [] as $upscscoreData)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ optional($upscscoreData->passingYear)->passing_year }}</td>
                                        <td>{{ $upscscoreData->upsc_cse_roll_number }}</td>
                                        <td>{{ $upscscoreData->upsc_cse_mains_marks }}</td>
                                        <td>{{ $upscscoreData->upsc_cse_interview_marks }}</td>
                                        <td><a href="{{ route('users.view.files', [
                                            'pathName' => $upscscoreData->interview_call_letter_filepath,
                                            'fileName' => $upscscoreData->interview_call_letter_file,
                                        ]) }}"
                                                class="btn btn-default btn-sm" target="_blank">
                                                View Call Letter
                                            </a></td>
                                        <td><a href="{{ route('users.view.files', [
                                            'pathName' => $upscscoreData->upsc_cse_mains_score_filepath,
                                            'fileName' => $upscscoreData->upsc_cse_mains_score_file,
                                        ]) }}"
                                                class="btn btn-default btn-sm" target="_blank">
                                                View Mains Score Card
                                            </a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="6">No Records found</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-2 text-sm">
                            <label>
                                <input type="checkbox" checked disabled>
                                I hereby undertake to submit all necessary documents regarding UPSC CSE 2024 at the time of document verification, if shortlisted. I also confirm that I have appeared for UPSC CSE 2024 interview and I do understand that selection shall be based on the percentile score obtained in the UPSC CSE 2024 and verification with UPSC Pratibha Setu portal. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment at any time.
                            </label>
                        </div>
                    </div>
                    @endif
                    @if($previewData?->submit_experience!=2)
                    <h4 class="applicat_cust-title mt-3">Work Experience</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employer Name</th>
                                    <th>Post Held</th>
                                    <th>From - To Date</th>
                                    <th>Experience</th>
                                    <th>Brief Job Description</th>
                                    <!-- <th>Work Experience Certificate</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($previewData?->experience ?? [] as $experienceData)
                                    @php
                                        $from = \Carbon\Carbon::parse(
                                            $experienceData->from_date,
                                        );
                                        $to = $experienceData->to_date
                                            ? \Carbon\Carbon::parse($experienceData->to_date)
                                            : now();

                                        $diff = $from->diff($to); // gives DateInterval (years, months, days)

                                        $experience = [];
                                        if ($diff->y > 0) {
                                            $experience[] =
                                                $diff->y . ' Year' . ($diff->y > 1 ? 's' : '');
                                        }
                                        if ($diff->m > 0) {
                                            $experience[] =
                                                $diff->m . ' Month' . ($diff->m > 1 ? 's' : '');
                                        }
                                        //if ($diff->d > 0) $experience[] = $diff->d . ' Day' . ($diff->d > 1 ? 's' : '');

                                        $experienceText = count($experience)
                                            ? implode(' ', $experience)
                                            : 'less than 1 Month';
                                    @endphp
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $experienceData->employer_name }}</td>
                                        <td>{{ $experienceData->post_held }}</td>
                                        <td>{{ $from->format('d M Y') }} -
                                            {{ $experienceData->to_date ? $to->format('d M Y') : 'Present' }}
                                        </td>
                                        <td>{{ $experienceText }}</td>
                                        <td>{{ $experienceData->job_description }}</td>
                                        <!-- <td>
                                            <a href="{{ route('recruitment-portal.candidate.advertisement.viewfiles', [
                                                'pathName' => $experienceData->experience_certificate_filepath,
                                                'fileName' => $experienceData->experience_certificate,
                                            ]) }}"
                                                class="btn btn-default btn-sm" target="_blank">
                                                View Certificate
                                            </a>
                                        </td> -->
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="6">No Records found</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-2 text-sm">
                            <label for="experience_consent" class="dark:text-gray-600 cursor-pointer text-sm"><input type="checkbox" checked disabled>
                                I hereby undertake to submit the documents regarding work experience, at the time of document verification, if shortlisted.
                                I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </label>
                        </div>
                    </div>
                    @else
                    <h4 class="applicat_cust-title mt-3">Work Experience</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employer Name</th>
                                    <th>Post Held</th>
                                    <th>From - To Date</th>
                                    <th>Experience</th>
                                    <th>Brief Job Description</th>
                                    <!-- <th>Work Experience Certificate</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="6">No</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <h4 class="applicat_cust-title mt-3">State Group</h4>
                    <div class="p-4">
                        <label for="experience_consent" class="dark:text-gray-600 cursor-pointer text-sm"><input type="checkbox" checked disabled>
                            I hereby confirm that, if selected, I may be allocated to a particular State Group on the basis of principle of Merit-cum-Choice through a counselling session. NHIDCL Cadre Rules, 2025; specifically Rule 6.5 and Rule 6.6 shall be referred for more details.
                        </label>
                    </div>

                    <form id="draftDataForm"
                        action="{{ route('recruitment-portal.candidate.advertisement.post.application') }}"
                        method="post">
                        @csrf
                        <input type="hidden" name="redirect_url"
                            value="{{ url()->current() }}">
                        <input type="hidden" name="action" value="disclouser">
                        <input type="hidden" name="advertisementid"
                            value="{{ $record->nhidcl_recruitment_advertisement_id }}">
                        <input type="hidden" name="postid" value="{{ $record->id }}">
                        <input type="hidden" name="applicationid" value="{{ $previewData?->id ?? 0 }}">
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <h4 class="applicat_cust-title mt-3">Declaration:- </h4>
                        <p class="mb-4 fs-14">I hereby undertake to submit the following documents at the time of document verification, if shortlisted:</p>
                        <label for="consent_one">
                            <input type="hidden" name="consent_one" id="consent_one_hidden" value="{{ $recordApplication?->consent_one == 1 ? '1' : '0' }}">
                            <input type="checkbox" name="consent_one" id="consent_one" data-validate="required" data-error="You must accept consent one of application."
                                {{ $recordApplication?->consent_one == 1 ? 'checked' : '' }}
                                {{ !$recordApplication || $recordApplication?->action === 'draft' ? '' : 'disabled' }} required>
                            Medical Examination Certificate by the Medical Board in the prescribed proforma.
                        </label><br>
                        <label for="consent_two">
                            <input type="hidden" name="consent_two" id="consent_two_hidden" value="{{ $recordApplication?->consent_two == 1 ? '1' : '0' }}">
                            <input type="checkbox" name="consent_two" id="consent_two" data-validate="required" data-error="You must accept consent two of application."
                                {{ $recordApplication?->consent_two == 1 ? 'checked' : '' }}
                                {{ !$recordApplication || $recordApplication?->action === 'draft' ? '' : 'disabled' }} required>
                            I am willing to serve anywhere in India/Outside.
                        </label><br>
                        <label for="consent_three">
                            <input type="hidden" name="consent_three" id="consent_three_hidden" value="{{ $recordApplication?->consent_three == 1 ? '1' : '0' }}">
                            <input type="checkbox" name="consent_three" id="consent_three" data-validate="required" data-error="You must accept consent three of application."
                                {{ $recordApplication?->consent_three == 1 ? 'checked' : '' }}
                                {{ !$recordApplication || $recordApplication?->action === 'draft' ? '' : 'disabled' }} required>
                            I have carefully gone through the vacancy advertisement and I solemnly
                                declare and undertake that all the information furnished by me is true, correct and complete to
                                the best of my knowledge and belief. I undertake that, if at any stage of the
                                selection or even after selection, any of the information furnished by me is found to be
                                false, incorrect or misleading, then my candidature/appointment/service will stand
                                cancelled / terminated without assigning any reason. I will produce the original documents
                                in support of the information furnished when so ever required by the National Highways
                                & Infrastructure Development Corporation Ltd. (NHIDCL).
                        </label><br>
                        {{-- <label for="consent_four">
                            <input type="checkbox" name="consent_four" id="consent_four"
                                {{ $recordApplication?->consent_four == 1 ? 'checked' : '' }}
                                {{ !$recordApplication || $recordApplication?->action === 'draft' ? '' : 'disabled' }}>
                            I have read NHIDCL Cadre Rules, 2025 & FAQs given at the NHIDCL Recruitment Portal.
                        </label><br> --}}
                        @if(empty($recordApplication?->place_of_application) || $recordApplication?->action === 'draft')
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="form-group">
                            <label>Place</label>
                            <input type="text" name="place_of_application" id="place_of_application" data-validate="required" data-error="You must accept consent one of application." value="{{ $recordApplication?->place_of_application }}" placeholder="Enter your location" required>
                        </div>
                        </div>
                        @else
                        <input type="hidden" name="place_of_application" value="{{ $recordApplication?->place_of_application }}">
                        <p><small>Place: <b>{{ $recordApplication?->place_of_application }}</b></small></p>
                        <p><small>Date And Time: <b>{{ \Carbon\Carbon::parse($recordApplication?->applied_at)->format('d-m-Y h:i:s A') }}</b></small></p>
                        @endif
                        <!-- <div class="button_flex_cust_form finalBtnDev">
                            @php
                                $isUpdate = $previewData?->terms_agreement == 1;
                                $message = $isUpdate
                                    ? 'Are you sure you want to update your details?'
                                    : 'After submission of this application, no changes are permitted.';
                                $actionType = $isUpdate ? 'update' : 'submit';
                            @endphp
                            @if (!$step4Completed)
                            <button class="hover-effect-btn fill_btn" type="submit"
                                onclick="event.preventDefault(); confirmSwal({{ $previewData?->id ?? 0 }}, '{{ $message }}', '{{ $actionType }}');">
                                {{ $isUpdate ? 'FINAL SUBMIT' : 'FINAL SUBMIT' }}
                            </button>
                            @endif
                        </div> -->
                        @if($recordApplication?->action=="" || $recordApplication?->action!="submit")
                        <div class="button_flex_cust_form finalBtnDev">
                            <button type="submit" name="actiontype" id="draftBtnData" class="hover-effect-btn btn-blue p-2" value="draft">
                                Save As Draft
                            </button>
                            @if($recordApplication?->action==="draft")
                                <button type="button" class="hover-effect-btn btn-blue p-2"
                                onclick="event.preventDefault(); document.getElementById('downloadProfileForm').submit();">Download Draft Application</button>
                            @endif
                            @php
                                $isUpdate = $previewData?->terms_agreement == 1;
                                $message = 'After submission of this application, no changes are permitted.';
                                $actionType = 'submit';
                            @endphp
                            <button type="submit" name="actiontype" class="btn-green p-2" value="submit"
                                onclick="event.preventDefault(); confirmSwal({{ $previewData?->id ?? 0 }}, '{{ $message }}', '{{ $actionType }}');">
                                Approve & Submit
                            </button>
                        </div>
                        @endif
                    </form>
                    @if($recordApplication?->action==="draft")
                        <form id="downloadProfileForm"
                            action="{{ route('recruitment-portal.candidate.profile.download') }}" method="POST"
                            style="display: none;">
                            @csrf
                            <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                            <input type="hidden" name="postid" value="{{ $record->id ?? '0' }}">
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        // Call only on initial page load
        function getInitialGeolocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        window.hasLatitude = position.coords.latitude;
                        window.hasLongitude = position.coords.longitude;
                        document.getElementById("latitude").value = window.hasLatitude;
                        document.getElementById("longitude").value = window.hasLongitude;
                        //console.log('Latitude:', window.hasLatitude, 'Longitude:', window.hasLongitude);
                    },
                    function(error) {
                        // User denied or blocked
                        window.hasLatitude = null;
                        window.hasLongitude = null;
                        console.log('Geolocation not available, fallback to null');
                    }
                );
            } else {
                console.log('Geolocation not supported by browser');
            }
        }
        getInitialGeolocation();
    </script>
    <script>
        window.hasPostExam = "{{ $record?->post_examination == 'UPSC' ? 'UPSC' : 'GATE' }}";
        window.hasPersonalDetail = {{ $previewData?->count() > 0 ? 'true' : 'false' }};
        window.hasGateDetails = "{{ $record?->required_gate_detail == 1 ? 'Yes' : 'No' }}";
        window.hasGateCount = {{ $gateScoreData ? 'true' : 'false' }};
        window.hasPayment = "{{ trim($record?->post_payment_type) ?? 'Unpaid' }}";
        window.hasEducation = {{ $previewData?->education->count() > 0 ? 'true' : 'false' }};
        window.hasExperience = {{ $previewData?->experience->count() > 0 ? 'true' : 'false' }};
    </script>
    <script src="{{ asset('public/js/recruitment-management/candidate/candidate.js') }}"></script>
    <script src="{{ asset('public/js/recruitment-management/candidate/candidate-tab.js') }}"></script>
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/js/recruitment-portal.js') }}"></script>
@endpush