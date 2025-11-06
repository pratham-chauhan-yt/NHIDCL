@extends('layouts.dashboard')
@section('dashboard_content')
  <div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
      <div class="main_hed">Employee Self-Service</div>
    </div>
  </div>
  <div class="inner_page_dash__">
    <div class="my-4">
      <div class="tab_custom_c">
        <button class="tablink active" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"></path>
          </svg> Raise a Request
        </button>
        <button class="tablink" onclick="openPage('History', this, '#373737')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path>
          </svg> View Request History
        </button>
        @if(!Auth::user()->hasRole('Employee'))
        <button class="tablink" onclick="openPage('Employees', this, '#373737')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path>
          </svg> Request By NHIDCL Employees
        </button>
        @endif
      </div>
      @include('components.alert')
      <div id="Home" class="tabcontent" style="display: block;">
        <form action="{{ route('employee-management.self.service.update', Crypt::encrypt($services->id ?? 0)) }}" method="POST" class="form_grid_cust">
            @csrf
            @method('PUT')
          <div class="inpus_cust_cs form_grid_dashboard_cust_">
            <div class="form-input">
              <label class="required-label">Request Type</label>
              <select name="request_type" id="request_type" required>
                <option value="">Select request type</option>
                @forelse($reqtype as $reqtypedata)
                <option value="{{$reqtypedata->id}}" {{ $services->ref_request_type_id == $reqtypedata->id ? 'selected' : '' }}>{{$reqtypedata->request_type}}</option>
                @empty
                @endforelse
              </select>
            </div>
            <div class="form-input">
              <label class="required-label">Checker</label>
              <select name="ref_checker_id" id="ref_checker_id" required>
                <option value="">---- Choose your manager ----</option>
                @forelse($manager as $managerdata)
                <option value="{{$managerdata->id}}" {{ $services->ref_checker_id == $managerdata->id ? 'selected' : '' }}>{{$managerdata->name."  ".$managerdata->email}}</option>
                @empty
                @endforelse
              </select>
            </div>
            <div class="form-input">
              <label class="required-label">Approver</label>
              <select name="ref_approver_id" id="ref_approver_id" required>
                <option value="">---- Choose your manager ----</option>
                @forelse($gmanager as $gmanagerdata)
                <option value="{{$gmanagerdata->id}}" {{ $services->ref_approver_id == $gmanagerdata->id ? 'selected' : '' }}>{{$gmanagerdata->name."  ".$gmanagerdata->email}}</option>
                @empty
                @endforelse
              </select>
            </div>
            <div class="form-input attachment_payment_proof">
              <label class="required-label">Upload Additional Documents</label>
              <div class="flex gap-[10px]">
                @php
                $fileFullPath = "";
                $fileName = $services->additional_documents;
                
                $file = url('employee-management/view/files') . urldecode("?pathName=uploads/employee-management/payment/&fileName=".$fileName);
                @endphp
                <input id="payment_proof_txt" name="payment_proof_txt" type="text" value="{{ old('payment_proof_txt', $file ?? '') }}" class="payment_proof_txt" placeholder="Upload additional documents" readonly>
                <label class="upload_cust mb-0 hover-effect-btn hide_payment_proof cursor-pointer"> Upload File
                  <input id="payment_proof_file" name="payment_proof_file" type="file" class="hidden payment_proof_file">
                </label>
                <input type="hidden" name="payment_proof" id="payment_proof" value="{{ old('payment_proof', $services->additional_documents ?? '') }}">
              </div>
              <small class="form-text text-muted text-red">
                Max size: 2MB | Allowed types: PDF, JPG, PNG, MP4, DOC, DOCX. Files containing scripts (e.g. script, php tags) will be rejected.
              </small>
            </div>
            <div class="form-input">
              <label class="required-label">Request Details</label>
              <textarea name="request_details" id="request_details" rows="3" placeholder="Enter request details" required>{{ old('request_details', $services->request_details ?? '') }}</textarea>
              <small class="form-text text-muted text-red">
                Requests exceeding 500 characters will not be accepted.
              </small>
            </div>            
          </div>
          <div class="button_flex_cust_form">
            <button type="submit" class="hover-effect-btn fill_btn" name="submit" value="Submit">
              Submit
            </button>
          </div>
        </form>
      </div>

      <div id="History" class="tabcontent" style="display: none;">
        <div class="table_over">
          <table class="cust_table__ table_sparated table-auto" id="serviceDataTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Request Type</th>
                <th>Request Details</th>
                <th>Submission Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      @if(!Auth::user()->hasRole('Employee'))
      <div id="Employees" class="tabcontent" style="display: none;">
        <div class="table_over">
          <table class="cust_table__ table_sparated table-auto" id="serviceEmployeeDataTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Request Type</th>
                <th>Request Details</th>
                <th>Submission Date</th>
                <th>Status</th>
                <th>Request Raised By</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      @endif
    </div>
  </div>
@endsection
@push('scripts')
<script>
  const serviceDataUrl = "{{ route('employee-management.self.service.index') }}";
  const serviceEmployeeDataUrl = "{{ route('employee-management.self.service.table') }}";
</script>
<script src="{{asset('public/js/employee-management.js')}}"></script>
@endpush