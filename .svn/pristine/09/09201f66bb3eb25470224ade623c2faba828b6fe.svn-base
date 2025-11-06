@extends('layouts.dashboard')
@section('dashboard_content')
  <div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
      <div class="main_hed">Claim Expenses</div>
    </div>
  </div>
  <div class="inner_page_dash__">
    <div class="my-4">
      <div class="tab_custom_c">
        <button class="tablink active" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"></path>
          </svg> Claim Expense
        </button>
        <button class="tablink" onclick="openPage('ClaimTab', this, '#373737')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path>
          </svg> Claim History
        </button>
        @if(!Auth::user()->hasRole('Employee'))
        <button class="tablink" onclick="openPage('EmployeeTable', this, '#373737')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path>
          </svg> Claim Raised By Employees
        </button>
        @endif
      </div>
      @include('components.alert')
      <div id="Home" class="tabcontent" style="display: block;">
        <form action="{{ route('employee-management.claim.expenses.update', Crypt::encrypt($expenses->id ?? 0)) }}" method="POST" class="form_grid_cust">
            @csrf
            @method('PUT')
          <div class="inpus_cust_cs form_grid_dashboard_cust_">
            <div class="form-input">
              <label class="required-label">Purpose</label>
              <input type="text" name="purpose" id="purpose" value="{{ old('purpose', $expenses->purpose ?? '') }}" placeholder="Purpose" required>
            </div>
            <div class="form-input">
              <label class="required-label">Amount</label>
              <input type="text" name="amount" id="amount" value="{{ old('amount', $expenses->amount ?? '') }}" placeholder="Enter claim amount" required>
            </div>
            <div class="form-input">
              <label class="required-label">From/To Date</label>
              <div class="grid grid-cols-2 gap-[10px]">
                <input type="date" name="from_date" id="from_date" max="{{ date('Y-m-d') }}" value="{{ old('from_date', $expenses->from_date ?? '') }}" required>
                <input type="date" name="to_date" id="to_date" min="{{ date('Y-m-d') }}" value="{{ old('to_date', $expenses->to_date ?? '') }}" required>
              </div>
            </div>
            <div class="form-input attachment_payment_proof">
              <label class="required-label">Payment Proof</label>
              <div class="flex gap-[10px]">
                @php
                $fileFullPath = "";
                $fileName = $expenses->payment_proof;
                
                $file = url('employee-management/view/files') . urldecode("?pathName=uploads/employee-management/payment/&fileName=".$fileName);
                @endphp
                <input type="text" id="payment_proof_txt" name="payment_proof_txt" value="{{ old('payment_proof_txt', $file ?? '') }}" class="payment_proof_txt" placeholder="Upload payment proof" readonly>
                <label class="upload_cust mb-0 hover-effect-btn hide_payment_proof cursor-pointer"> Upload File
                  <input id="payment_proof_file" name="payment_proof_file" type="file" class="hidden payment_proof_file">
                </label>
                <input type="hidden" name="payment_proof" id="payment_proof" value="{{ old('payment_proof', $expenses->payment_proof ?? '') }}">
              </div>
              <small class="form-text text-muted text-red">
                Max size: 2MB | Allowed types: PDF, JPG, PNG, MP4, DOC, DOCX. Files containing scripts (e.g. script, php tags) will be rejected.
              </small>
            </div>
            <div class="form-input">
              <label class="required-label">Brief Description</label>
              <textarea name="description" id="description" rows="3" placeholder="Brief Description" required>{{ old('description', $expenses->description ?? '') }}</textarea>
              <small class="form-text text-muted text-red">
                Brief description exceeding 500 characters will not be accepted.
              </small>
            </div>
          </div>
          <div class="button_flex_cust_form">
            <button class="hover-effect-btn fill_btn" type="submit" name="submit" value="Submit">
              Submit
            </button>
          </div>
        </form>
      </div>

      <div id="ClaimTab" class="tabcontent" style="display: none;">
        <div class="table_over">
          <table class="cust_table__ table_sparated table-auto" id="claimDataTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Purpose</th>
                <th>Claim Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      @if(!Auth::user()->hasRole('Employee'))
      <div id="EmployeeTable" class="tabcontent" style="display: none;">
        <div class="table_over">
          <table class="cust_table__ table_sparated table-auto" id="claimEmployeeDataTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Purpose</th>
                <th>Claim Date</th>
                <th>Status</th>
                <th>Created By</th>
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
  const claimDataUrl = "{{ route('employee-management.claim.expenses.index') }}";
  const claimEmployeeDataUrl = "{{ route('employee-management.claim.expenses.table') }}";
</script>
<script src="{{asset('public/js/employee-management.js')}}"></script>
@endpush