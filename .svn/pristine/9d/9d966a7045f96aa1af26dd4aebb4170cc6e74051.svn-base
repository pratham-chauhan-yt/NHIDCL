@extends('layouts.dashboard')
@section('dashboard_content')
  <div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
      <div class="main_hed">Directory of Stakeholders</div>
    </div>
  </div>
  <div class="inner_page_dash__">
    <div class="my-4">
      <div class="tab_custom_c mb-[20px]">
        <button class="tablink active" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z"></path>
          </svg>
          Internal/NHIDCL Employee Details
        </button>

        <button class="tablink" onclick="openPage('News', this, '#373737')">
          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"></path>
          </svg>
          External Employee
        </button>

        <button class="tablink" onclick="openPage('work', this, '#373737')">
          <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z"></path>
          </svg>
          Contractors
        </button>
      </div>

      <div id="Home" class="tabcontent" style="display: block;">
        <div class="table_over">
          <table class="cust_table__ table_sparated" id="internalEmpTableData">
            <thead class=" ">
              <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Designation</th>
                <th>Department</th>
                <th>State</th>
                <th>HQ/RO/PMU/SO</th>
                <th class="">Address</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>

      <div id="News" class="tabcontent" style="display: none;">
        <div class="table_over">
          <table class="cust_table__ table_sparated" id="stakeholderEmpTableData">
            <thead>
              <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Designation</th>
                <th>Department</th>
                <th>State</th>
                <th>Address</th>
                <th>Status</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>

      <div id="work" class="tabcontent" style="display: none;">
        <div class="table_over">
          <table class="cust_table__ table_sparated text-wrap">
            <thead class=" ">
              <tr>
                <th>#</th>
                <th>Contractor Name</th>
                <th>UPC</th>
                <th>Project Name</th>
                <th>HQ/RO/PMU/SO</th>
                <th>Total Length (in KM)</th>
                <th>Mode</th>
                <th>NH</th>
                <th>Awarded Cost (Cr.)</th>
                <th>Start/Appointment date</th>
                <th>Schedule Completion Date</th>
                <th>Current Status</th>
                <th>Detailed View</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>M/s KR Construction</td>
                <td>945362954625</td>
                <td>Construction of balance work of Bi-directional Tunnel at Km 83rd and a Major Bridge between Km 82+675 and Km 82+925 on NH-244 in the UT of J&amp;K on EPC mode.</td>
                <td>RO-Imphal</td>
                <td>48</td>
                <td>EPC</td>
                <td>42</td>
                <td>2.8</td>
                <td>12-08-2025</td>
                <td>12-08-2026</td>
                <td>Under Construction</td>
                <td>
                  <a href="javascript:void(0);">
                    <i class="fa fa-eye"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script>
  window.stakeholderInternalEmpUrl = "{{ route('directory-management.internal.employees.table.data') }}";
  window.stakeholderEmpDataUrl = "{{ route('directory-management.external.employees.create') }}";
</script>
@endpush