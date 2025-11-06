@extends('layouts.dashboard')
@php
    use App\Models\TaskManagement\{Bucket, TaskSource, Priority, TaskRepeat};
@endphp

@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Create Task</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div class="tab_custom_c mb-[20px]">
                    <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                        </svg>
                        Task Details
                    </button>

                </div>

                <div id="Home" class="tabcontent">
                    <form class="form_grid_cust" action="{{ route('task-management.store') }}" method="POST"
                        id="add-task-management">
                        @csrf
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="">
                                <label class="required-label">Task Name</label>
                                <input type="text" name="task_name" id="task_name" value="{{ old('task_name') }}"
                                    placeholder="Enter task name" required>
                                @error('task_name')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label class="required-label">Bucket</label>
                                <select name="ref_bucket_id" id="ref_bucket_id" required>
                                    @foreach (Bucket::all() as $buket)
                                        <option value="{{ $buket->id }}"
                                            {{ old('ref_bucket_id') == $buket->id ? 'selected' : '' }}>
                                            {{ $buket->bucket_type }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ref_bucket_id')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label class="required-label">Division</label>
                                <input type="text" name="division" id="division" value="{{ old('division') }}" placeholder="Enter division name" required>
                                @error('division')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label>Priority</label>
                                <select name="ref_priority_id" class="">
                                    @foreach (Priority::all() as $priority)
                                        <option value="{{ $priority->id }}"
                                            {{ old('ref_priority_id') == $priority->id ? 'selected' : '' }}>
                                            {{ $priority->priority_name }}</option>
                                    @endforeach
                                </select>
                                @error('ref_priority_id')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label class="required-label">Start Date</label>
                                <input type="date" name="start_date" value="{{ old('start_date') }}"
                                    min="{{ now()->toDateString() }}" required>
                                @error('start_date')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label class="required-label">Due Date</label>
                                <input type="date" name="due_date" value="{{ old('due_date') }}"
                                    min="{{ now()->toDateString() }}" required>
                                @error('due_date')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label class="required-label">Frequency</label>
                                <select name="frequency" class="">
                                    <option value="">Select task repeat frequency</option>
                                    @foreach (TaskRepeat::all() as $repeat)
                                        <option value="{{ $repeat->id }}|{{ $repeat->repeat_interval }}"
                                            {{ old('frequency_combined') == $repeat->id . '|' . $repeat->repeat_interval ? 'selected' : '' }}>
                                            {{ $repeat->repeat_interval }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('frequency')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label  class="required-label">Remarks</label>
                                <textarea name="note" rows="3" placeholder="Leave task remarks here..." required>{{ old('note') }}</textarea>
                                @error('note')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="attachment_section_upload_attachment attachment_preview">
                                <label>Upload Attachment (<span style="font-size: 10px;">Max 1MB & file should be PDF,
                                        Excel, JPEG, PNG, JPG, DOC, KML, KMZ</span>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="uploaded_attachment" name="uploaded_attachment"
                                        placeholder="Upload Image" class="uploaded_attachment" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input type="file" id="upload_attachment" name="upload_attachment"
                                            class="hidden upload_attachment">
                                        <input type="hidden" id="attachment" name="attachment" value="">
                                    </label>
                                </div>
                                @error('attachment')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label>Source Of the Task</label>
                                <select name="ref_task_source_id" id="ref_task_source_id">
                                    @foreach (TaskSource::all() as $source)
                                        <option value="{{ $source->id }}"
                                            {{ old('ref_task_source_id') == $source->id ? 'selected' : '' }}>
                                            {{ $source->source_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ref_task_source_id')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="">
                                <label class="required-label">Task Owner</label>
                                <select name="assigned_to" required>
                                    <option value="">--- Please select task assign user ---</option>
                                    @foreach ($user_responders as $responder)
                                        <option value="{{ $responder->id }}"
                                            {{ old('assigned_to') == $responder->id ? 'selected' : '' }}>
                                            {{ $responder->name }} ({{ $responder->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('assigned_to')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="" id="other_source_input_wrapper" style="display: none;">
                                <label> Source Of Task</label>
                                <input type="text" name="other_task_source" class="form-control" maxlength="150" placeholder="Enter other source name">
                            </div>

                        </div>

                        <div class="button_flex_cust_form">
                            <button class="hover-effect-btn fill_btn" type="submit">
                                Save
                            </button>
                        </div>

                    </form>

                </div>


            </div>

        </div>

    </section>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>
    <script src="{{ asset('public/js/md-task.js') }}"></script>
@endpush
