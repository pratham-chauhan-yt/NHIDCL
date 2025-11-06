@extends('layouts.dashboard')
@section('dashboard_content')
  <div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
      <div class="main_hed">Out Of Office Attendance</div>
    </div>
  </div>
  <div class="inner_page_dash__">
    <div class="my-4">
      <div class="tab_custom_c">
        <button class="tablink active" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path>
          </svg>
          Edit Mark Attendance
        </button>
        <button class="tablink" onclick="openPage('News', this, '#373737')">
          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776"></path>
          </svg>
          History
        </button>
      </div>
      @include('components.alert')
      <div id="Home" class="tabcontent" style="display: block;">
        <form action="{{ route('employee-management.mark.attendance.update', Crypt::encrypt($attendance->id ?? 0)) }}" method="POST" class="form_grid_cust">
            @csrf
            @method('PUT')
            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                <div class="form-input">
                    <label class="required-label">Purpose</label>
                    <input type="text" name="purpose" id="purpose" maxlength="100" value="{{ old('purpose', $attendance->purpose ?? '') }}" placeholder="Purpose" required>
                </div>
            <div class="form-input">
              <label class="required-label">Checker</label>
              <select name="ref_checker_id" id="ref_checker_id" required>
                <option value="">---- Choose your manager ----</option>
                @forelse($manager as $managerdata)
                <option value="{{ $managerdata->id }}" {{ $attendance->ref_checker_id == $managerdata->id ? 'selected' : '' }}>
                  {{ $managerdata->name . '  ' . $managerdata->email }}
                </option>
                @empty
                @endforelse
              </select>
            </div>
            <div class="form-input">
              <label class="required-label">Approver</label>
              <select name="ref_approver_id" id="ref_approver_id" required>
                <option value="">---- Choose your manager ----</option>
                @forelse($gmanager as $gmanagerdata)
                <option value="{{ $gmanagerdata->id }}" {{ $attendance->ref_approver_id == $gmanagerdata->id ? 'selected' : '' }}>
                  {{ $gmanagerdata->name . '  ' . $gmanagerdata->email }}
                </option>
                @empty
                @endforelse
              </select>
            </div>
            <div class="form-input">
              <label class="required-label">From/To Date</label>
              <div class="grid grid-cols-2 gap-[10px]">
                <input type="date" name="from_date" id="from_date" max="{{ date('Y-m-d') }}" value="{{ old('from_date', $attendance->from_date ?? '') }}" required>
                <input type="date" name="to_date" id="to_date" min="{{ date('Y-m-d') }}" value="{{ old('to_date', $attendance->to_date ?? '') }}" required>
              </div>
            </div>
            <div class="form-input">
              <label class="required-label">Address/Location</label>
              <textarea name="address" id="address" rows="3" placeholder="Address/Location" required>{{ old('address', $attendance->address ?? '') }}</textarea>
              <small class="form-text text-muted text-red">
                Address/Location exceeding 500 characters will not be accepted.
              </small>
            </div>
          </div>
          <div class="button_flex_cust_form">
            <button type="submit" name="submit" value="Apply" class="hover-effect-btn fill_btn">
              Apply
            </button>
          </div>
        </form>
      </div>

      <div id="News" class="tabcontent" style="display: none;">
        <div class="inner_select_cust_op">
          <select class="m-2">
            <option value="2025">2025</option>
          </select>
        </div>

        <div class="table_over">
          <table class="cust_table__ table_sparated table-auto" id="attendanceTable">
            <thead class="">
              <tr>
                <th>#</th>
                <th>Purpose</th>
                <th>Address/Location</th>
                <th>No. of Days</th>
                <th>From/To date</th>
                <th>Status</th>
                <th>Checker</th>
                <th>Checker Remark</th>
                <th>Approver</th>
                <th>Approver Remark</th>
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
  const attendanceUrl = "{{ route('employee-management.mark.attendance.index') }}";
</script>
<script src="{{asset('public/js/employee-management.js')}}"></script>
@endpush