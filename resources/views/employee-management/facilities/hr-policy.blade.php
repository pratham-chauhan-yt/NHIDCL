@extends('layouts.dashboard')
@section('dashboard_content')
    <style>*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style: }/* ! tailwindcss v3.4.16 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;letter-spacing:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}button,input:where([type=button]),input:where([type=reset]),input:where([type=submit]){-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]:where(:not([hidden=until-found])){display:none}.container{width:100%}@media (min-width: 640px){.container{max-width:640px}}@media (min-width: 768px){.container{max-width:768px}}@media (min-width: 1024px){.container{max-width:1024px}}@media (min-width: 1280px){.container{max-width:1280px}}@media (min-width: 1536px){.container{max-width:1536px}}.relative{position:relative}.z-10{z-index:10}.my-4{margin-top:1rem;margin-bottom:1rem}.mb-\[10px\]{margin-bottom:10px}.flex{display:flex}.inline-flex{display:inline-flex}.grid{display:grid}.hidden{display:none}.w-44{width:11rem}.grid-cols-1{grid-template-columns:repeat(1, minmax(0, 1fr))}.gap-4{gap:1rem}.divide-y > :not([hidden]) ~ :not([hidden]){--tw-divide-y-reverse:0;border-top-width:calc(1px * calc(1 - var(--tw-divide-y-reverse)));border-bottom-width:calc(1px * var(--tw-divide-y-reverse))}.divide-gray-100 > :not([hidden]) ~ :not([hidden]){--tw-divide-opacity:1;border-color:rgb(243 244 246 / var(--tw-divide-opacity, 1))}.overflow-hidden{overflow:hidden}.fill-indigo-600{fill:#4f46e5}.p-4{padding:1rem}.pt-\[8px\]{padding-top:8px}.shadow-xl{--tw-shadow:0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);--tw-shadow-colored:0 20px 25px -5px var(--tw-shadow-color), 0 8px 10px -6px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}@media (min-width: 640px){.sm\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}}@media (min-width: 768px){.md\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.md\:p-0{padding:0px}}@media (min-width: 1024px){.lg\:grid-cols-3{grid-template-columns:repeat(3, minmax(0, 1fr))}}@media (min-width: 1280px){.xl\:grid-cols-4{grid-template-columns:repeat(4, minmax(0, 1fr))}}</style>
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">HR Policies</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4">
            <div class="tab_custom_c">
                @if(!Auth::user()->hasRole('Employee'))
                    <button class="tablink active" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                        Add Policy {{ auth()->user()->role }}
                    </button>
                @endif

                <button class="tablink {{ !Auth::user()->hasRole('Employee') ? 'active' : '' }}" onclick="openPage('PolicyView', this, '#373737')" {{ Auth::user()->role === 'Employee' ? 'id=defaultOpen' : '' }}>
                    Policies
                </button>
            </div>
            @include('components.alert')
            @if(!Auth::user()->hasRole('Employee'))
            <div id="Home" class="tabcontent" style="display: block;">
                <form action="{{ route('employee-management.hr.policies.store') }}" method="post" id="hrAssignAssetForms" enctype="multipart/form-data" class="form_grid_cust">
                    @csrf
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="form-input">
                            <label class="required-label">Title</label>
                            <input type="text" name="title" id="title" placeholder="Enter hr policy title" data-validate="required" data-error="Please enter HR policy title.">
                        </div>
                        <div class="form-input">
                            <label class="required-label">Department</label>
                            <select name="ref_department_id" id="ref_department_id" data-validate="required" data-error="Please choose policy department.">
                                <option value="">---- Choose department ----</option>
                                @forelse($department as $departData)
                                <option value="{{$departData->id}}">{{$departData->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-input">
                            <label class="required-label">Policy Date</label>
                            <input type="date" name="date" id="date" min="{{ date('Y-m-d') }}" placeholder="Policy Date" data-validate="required" data-error="Please choose policy date.">
                        </div>
                        <div class="form-input attachment_payment_proof">
                            <label class="required-label">Policy File</label>
                            <div class="flex gap-[10px]">
                                <input id="payment_proof_txt" name="payment_proof_txt" type="text" class="payment_proof_txt" placeholder="Upload policy file" readonly data-validate="required" data-error="Please upload policy attachment files.">
                                <label class="upload_cust mb-0 hover-effect-btn hide_payment_proof cursor-pointer"> Upload File
                                    <input id="payment_proof_file" name="payment_proof_file" type="file" class="hidden payment_proof_file">
                                </label>
                                <input type="hidden" name="policy_file" id="payment_proof">
                            </div>
                            <small class="form-text text-muted text-red">
                                Max size: 2MB | Allowed types: PDF, JPG, PNG, MP4, DOC, DOCX. Files containing scripts (e.g. script, php tags) will be rejected.
                            </small>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button type="submit" class="hover-effect-btn fill_btn" id="savehrAssignAsset" name="submit" value="Submit">
                            Add Policy
                        </button>
                    </div>
                </form>
            </div>
            @endif
            <div id="PolicyView" class="tabcontent" style="{{ Auth::user()->hasRole('Employee') ? 'display: block;' : 'display: none;' }}">
                <div class="table_over">
                    <table class="cust_table__ table_sparated table-auto" id="hrPolicyDataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Department</th>
                                <th>Date</th>
                                <th>Uploaded by</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    const policyDataUrl = "{{ route('employee-management.hr.policies') }}";
</script>
<script src="{{asset('public/js/employee-management.js')}}"></script>
@endpush