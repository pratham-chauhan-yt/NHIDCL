{{--
Single File Upload (PDF Only)

<x-form.file-upload label="Upload Marksheet/Degree Certificate" name="marksheet_certificate"
    note="Only PDF files are allowed, with a maximum size of 2 MB" required />

Multiple File Upload (PDF, PNG, JPEG)

<x-form.file-upload label="Supporting Documents" name="support_docs" note="Max 10MB each, PDF, PNG, or JPEG allowed"
    prefix="support" :existingUrl="null" class="multi-file-upload" uploadBtnText="Upload Files" required />

Edit Mode with Existing File

<x-form.file-upload label="Document" name="upload_doc" :existingUrl="url(
    'document-management/viewFiles?pathName=' . $document->document_filepath . '&fileName=' . $document->document,)"
    note="PDF file only, max 20 MB" prefix="doc" required />
--}}


@props([
    'label' => 'Upload File',
    'smallLabel' => null,
    'smallLabelClass' => null,
    'name', // input name (e.g. upload_doc)
    'hiddenInput' => null, // hidden input name (e.g. uploaded_doc_url)
    'class' => '', // custom class for the section div
    'required' => false,
    'note' => null, // optional note (e.g. "Max size 2MB, only PDF")
    'existingUrl' => null, // pre-filled file URL for edit view
    'uploadBtnText' => 'Upload File',
    'prefix' => 'doc', // prefix for JS key
    'viewPath' => null, // used in edit mode to show preview links
    'wrapperId' => null, // optional id for the wrapper div
])

@php
    $hiddenInput = $hiddenInput ?? "{$name}_url";
    $uniqueKey = $prefix . '_' . time() . '_' . mt_rand(100000, 999999);
@endphp

<div class="attachment_section_{{ $name }} attachment_preview {{ $class }}"
    @if ($wrapperId) id="{{ $wrapperId }}" @endif>
    <label @class(['required-label' => $required]) for="{{ $name }}">
        {{ $label }}
        @if ($smallLabel)
            (<small @if ($smallLabelClass) class="{{ $smallLabelClass }}" @endif>
                {{ $smallLabel }}
            </small>)
        @endif
    </label>

    <div class="flex gap-[10px]">
        <input type="text" id="{{ $hiddenInput }}" name="{{ $hiddenInput }}" class="form-input {{ $hiddenInput }}"
            placeholder="Choose File" value="{!! $existingUrl ?? '' !!}" readonly>

        <label class="upload_cust mb-0 hover-effect-btn hide_{{ $name }}_btn"
            @if ($existingUrl) style="display: none;" @endif>
            {{ $uploadBtnText }}
            <input id="{{ $name }}" type="file" name="{{ $name }}"
                class="hidden {{ $name }}" @if ($required) required @endif
                @if ($existingUrl) disabled @endif>
        </label>
    </div>
    @if ($note)
        <small class="text-yellow-message">{{ $note }}</small>
    @endif

    {{-- Existing file preview for edit mode --}}
    @php
        preg_match('/fileName=([^&]+)/', $existingUrl, $matches);
        $filename = $matches[1] ?? '';
    @endphp
    @if ($existingUrl)
        <div class="upload-preview" data-key="{{ $uniqueKey }}">
            <a href="{!! $existingUrl !!}" target="_blank"
                class="font-medium text-sm mx-2 my-2 report_preview_support_photo">View</a>
            <a href="javascript:void(0);" class="font-medium text-sm mx-2 my-2 report_remove_doc"
                data-key="{{ $uniqueKey }}" data-filename="{{$filename}}">Remove</a>
        </div>
    @endif

    <span id="{{ $name }}_err" class="{{ $name }}_err candidateErr">
        @error($name)
            <div class="error">{{ $message }}</div>
        @enderror
    </span>
</div>
