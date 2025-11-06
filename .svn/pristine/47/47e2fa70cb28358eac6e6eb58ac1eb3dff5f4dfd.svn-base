@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Advertisement Edit</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div id="Home">
                {{ Form::model($edit_record, ['route' => ['recruitment-portal.advertisement.update', ($id = encrypt($edit_record->id))], 'id' => 'advertisementForm', 'files' => true]) }}
                @csrf
                @method('put')
                <div class="inpus_cust_cs form_grid_dashboard_cust_">
                    <div>
                        <label class="required-label">Advertisement Title</label>
                        <input type="text" class="" name="advertisement_title" id="advertisement_title"
                            value="{{ $edit_record->advertisement_title ?? '' }}" />
                        @error('advertisement_title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="required-label">As on date</label>
                        <input type="date" name="as_on_date" id="as_on_date" value="{{ $edit_record->as_on_date ?? '' }}" />
                        @error('as_on_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="required-label">Start Date and Time</label>
                        <input type="datetime-local" name="start_datetime" id="start_datetime"
                            value="{{ $edit_record->start_datetime ?? '' }}" />
                        @error('start_datetime')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="required-label">Expiry Date and Time</label>
                        <input type="datetime-local" name="expiry_datetime" id="expiry_datetime"
                            value="{{ $edit_record->expiry_datetime ?? '' }}" />
                        @error('expiry_datetime')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="attachment_advertisement">
                        <label class="required-label">Upload Advertisement File</label>
                        <div class="flex gap-[10px]">
                            <input id="advertisement_file_txt" name="advertisement_file_txt" type="text"
                                class="advertisement_file_txt" placeholder="Upload documents">
                            <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer"> Upload File
                                <input id="advertisement_file" name="advertisement_file" type="file"
                                    class="hidden advertisement_file">
                            </label>
                            <input type="hidden" name="upload_file" id="upload_file"
                                value="{{ $edit_record->advertisement_file ?? '' }}">
                        </div>

                        <span id="advertisement_file" class="advertisement_file_err candidateErr"></span>
                        @error('advertisement_file')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="">Note/Instruction</label>
                        <textarea name="note_instruction" class="form-control" placeholder="Description" rows="2">{{ $note_instruction }}</textarea>
                        @error('note_instruction')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="button_flex_cust_form">
                    <button class="hover-effect-btn fill_btn" type="submit" id="submitButton">Submit
                    </button>
                </div>
                </form>
            </div>
        @endsection
