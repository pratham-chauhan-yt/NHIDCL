@extends('layouts.dashboard')
@section('dashboard_content')
<style>
  /* Tab container */
  .modern-tab {
    display: flex;
    border-bottom: 2px solid #e5e7eb;
    gap: 10px;
  }

  /* Tab buttons */
  .inner-tablinks {
    padding: 10px 20px;
    background: #f3f4f6;
    border: 1px solid #d1d5db;
    border-bottom: none;
    cursor: pointer;
    font-size: 15px;
    font-weight: 600;
    color: #4b5563;
    border-radius: 8px 8px 0 0;
    transition: all 0.3s ease;
  }

  /* Hover effect */
  .inner-tablinks:hover {
    background: #e5e7eb;
  }

  /* Active tab */
  .inner-tablinks.active {
    background: #ffffff;
    color: #111827;
    border-bottom: 2px solid white !important;
    border-top: 2px solid #6366f1;
    border-left: 2px solid #6366f1;
    border-right: 2px solid #6366f1;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
  }

  .punch-card {
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  }

  .punch-row {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    gap: 12px;
  }

  .punch-label {
    width: 120px;
    font-weight: 600;
  }

  .punch-input {
    flex: 1;
    padding: 10px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    background: #f9fafb;
  }

  .punch-btn {
    padding: 8px 16px;
    background: #10b981;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
  }

  .punch-btn:hover {
    opacity: 0.85;
  }

  .punch-out {
    background: #ef4444 !important;
  }
</style>
<div class="container-fluid md:p-0">
  <div class="top_heading_dash__">
    <div class="main_hed">Out Of Office Attendance</div>
  </div>
</div>

<div class="inner_page_dash__">
  <div class="my-4">

    <!-- OUTER TABS -->
    <div class="tab_custom_c">
      <button class="tablink active" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10">
          </path>
        </svg>
        Mark Attendance
      </button>

      <button class="tablink" onclick="openPage('News', this, '#373737')">
        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776">
          </path>
        </svg>
        History
      </button>
    </div>

    @include('components.alert')

    <!-- OUTER TAB 1: MARK ATTENDANCE -->
    <div id="Home" class="tabcontent" style="display:none;">

      <!-- INNER TABS -->
      <div class="tab modern-tab mt-3">
        <button class="inner-tablinks" onclick="openInnerTab(event, 'HomeTab')" id="innerDefault">
          Outdoor
        </button>
        <button class="inner-tablinks active" onclick="openInnerTab(event, 'OfficeTab')">
          In Office
        </button>
      </div>


      <!-- INNER TAB CONTENT: OUTDOOR -->
      <div id="HomeTab" class="inner-tabcontent" style="display:none;">
        <form action="{{ route('employee-management.mark.attendance.store') }}" method="post" class="form_grid_cust" id="FormValidations">
          @csrf

          <div class="inpus_cust_cs form_grid_dashboard_cust_">
            <div class="form-input">
              <label class="required-label">Purpose</label>
              <input type="text" name="purpose" maxlength="100" value="{{ old('purpose') }}" placeholder="Purpose"
                data-validate="required" data-error="Please enter your purpose.">
            </div>

            <div class="form-input">
              <label class="required-label">Checker</label>
              <select name="ref_checker_id" data-validate="required" data-error="Please choose your manager.">
                <option value="">---- Choose your manager ----</option>
                @foreach($manager as $managerdata)
                <option value="{{ $managerdata->id }}" {{ old('ref_checker_id') == $managerdata->id ? 'selected' : '' }}>
                  {{ $managerdata->name }} ({{ $managerdata->email }})
                </option>
                @endforeach
              </select>
            </div>

            <div class="form-input">
              <label class="required-label">Approver</label>
              <select name="ref_approver_id" data-validate="required" data-error="Please choose your manager.">
                <option value="">---- Choose your manager ----</option>
                @foreach($gmanager as $gmanagerdata)
                <option value="{{ $gmanagerdata->id }}" {{ old('ref_approver_id') == $gmanagerdata->id ? 'selected' : '' }}>
                  {{ $gmanagerdata->name }} ({{ $gmanagerdata->email }})
                </option>
                @endforeach
              </select>
            </div>

            <div class="form-input">
              <label class="required-label">From/To Date</label>
              <div class="grid grid-cols-2 gap-[10px]">
                <input type="date" name="from_date" max="{{ date('Y-m-d') }}" value="{{ old('from_date') }}"
                  data-validate="required">
                <input type="date" name="to_date" min="{{ date('Y-m-d') }}" value="{{ old('to_date') }}"
                  data-validate="required">
              </div>
            </div>

            <div class="form-input">
              <label class="required-label">Address/Location</label>
              <textarea name="address" rows="3" data-validate="required">{{ old('address') }}</textarea>
              <small class="form-text text-muted text-red">
                Address/Location exceeding 500 characters will not be accepted.
              </small>
            </div>
          </div>

          <div class="button_flex_cust_form">
            <button type="submit" class="hover-effect-btn fill_btn">Apply</button>
          </div>
        </form>
      </div>

      <!-- INNER TAB CONTENT: IN OFFICE -->
      <div id="OfficeTab" class="inner-tabcontent" style="display:block;">
        <div class="punch-card">

          <!-- Current Date -->
          <div class="punch-row">
            <label class="punch-label">Date</label>
            <input type="text" id="current_date" readonly class="punch-input">
          </div>

          <!-- Punch In -->
          <div class="punch-row">
            <label class="punch-label">Punch In</label>
            <button id="punch_in_btn" class="punch-btn punch-in"onclick="markPunch('in')">Punch In</button>
            <input type="text" id="punch_in_time" readonly class="punch-input">
          </div>

          <!-- Punch Out -->
          <div class="punch-row">
            <label class="punch-label">Punch Out</label>
            <button class="punch-btn punch-out" onclick="markPunch('out')">Punch Out</button>
            <input type="text" id="punch_out_time" readonly class="punch-input">
          </div>

          <!-- Location (optional) -->
          <!-- Location Row -->
          <div class="punch-row">
            <label class="punch-label">Location</label>
            <input type="text" id="office_location" class="punch-input" placeholder="Fetching location..." readonly>
          </div>

          <!-- Hidden fields to store lat & long -->
          <input type="hidden" id="latitude">
          <input type="hidden" id="longitude">

          <div class="button_flex_cust_form mt-3">
            <button class="hover-effect-btn fill_btn" onclick="saveAttendance()">
              Save Attendance
            </button>
          </div>
        </div>
      </div>


    </div>

    <!-- OUTER TAB 2: HISTORY -->
    <div id="News" class="tabcontent" style="display:none;">
      <div class="inner_select_cust_op">
        <select class="m-2">
          <option value="2025">2025</option>
        </select>
      </div>

      <div class="table_over">
        <table class="cust_table__ table_sparated table-auto" id="attendanceTable">
          <thead>
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

<!-- OUTER TAB JS -->
<script>
  function openPage(pageName, element, color) {
    let contents = document.getElementsByClassName("tabcontent");
    for (let c of contents) c.style.display = "none";

    let links = document.getElementsByClassName("tablink");
    for (let l of links) {
      l.classList.remove("active");
      l.style.color = "";
    }

    document.getElementById(pageName).style.display = "block";
    element.classList.add("active");
    element.style.color = color;
  }

  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("defaultOpen").click();
    document.getElementById("innerDefault").click();
  });
</script>

<!-- INNER TABS JS -->
<script>
  function openInnerTab(evt, tabName) {
    $(".inner-tabcontent").hide();
    $(".inner-tablinks").removeClass("active");

    $("#" + tabName).show();
    $(evt.currentTarget).addClass("active");
  }
</script>
<script>
// Disable Punch In until location is fetched
document.getElementById("punch_in_btn").disabled = true;

// Load stored punch times
loadAttendanceState();

// Fetch location on page load
fetchLocation();

function fetchLocation() {
    let locationInput = document.getElementById("office_location");
    locationInput.value = "Fetching location...";

    if (!navigator.geolocation) {
        locationInput.value = "Location not supported";
        return;
    }

    navigator.geolocation.getCurrentPosition(
        async function (position) {
            let lat = position.coords.latitude;
            let lon = position.coords.longitude;

            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lon;

            try {
                let response = await fetch(`{{ url('employee-management/geo/reverse') }}?lat=${lat}&lon=${lon}`);
                let data = await response.json();

                let address = data.display_name || "Address not found";
                locationInput.value = address;

                // Enable Punch-In only if not already punched-in
                if (!localStorage.getItem("punch_in_time")) {
                    document.getElementById("punch_in_btn").disabled = false;
                }

            } catch (error) {
                locationInput.value = "Server error fetching address";
            }
        },
        function () {
            locationInput.value = "Location permission denied";
        }
    );
}


// Mark Punch In / Punch Out
function markPunch(type) {
    let now = new Date().toLocaleTimeString();

    if (type === "in") {
        document.getElementById("punch_in_time").value = now;

        // Save punch-in persistently
        localStorage.setItem("punch_in_time", now);

        // Disable punch-in button
        document.getElementById("punch_in_btn").disabled = true;

    } else if (type === "out") {
        document.getElementById("punch_out_time").value = now;

        // Save punch-out
        localStorage.setItem("punch_out_time", now);

        // After punch-out, clear punch-in for next use
        localStorage.removeItem("punch_in_time");

        // Allow punch-in next day (after refresh)
        document.getElementById("punch_in_btn").disabled = false;
    }
}


// Load saved attendance state on page load
function loadAttendanceState() {
    let punchIn = localStorage.getItem("punch_in_time");
    let punchOut = localStorage.getItem("punch_out_time");

    if (punchIn) {
        document.getElementById("punch_in_time").value = punchIn;

        // If already punched-in, disable punch-in button
        document.getElementById("punch_in_btn").disabled = true;
    }

    if (punchOut) {
        document.getElementById("punch_out_time").value = punchOut;

        // After punch-out next day → reset data automatically
        // You can manually clear if needed
    }
}


// Clear everything on logout
function clearAttendanceOnLogout() {
    localStorage.removeItem("punch_in_time");
    localStorage.removeItem("punch_out_time");
}

function saveAttendance() {
    Swal.fire("Saved!", "Attendance saved successfully", "success");
}
</script>




<script>
  const attendanceUrl = "{{ route('employee-management.mark.attendance.index') }}";
</script>

<script src="{{ asset('public/js/employee-management.js') }}"></script>

@endpush