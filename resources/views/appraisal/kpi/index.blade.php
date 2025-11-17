@extends('layouts.dashboard')

@section('dashboard_content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<section class="home-section">
    <div class="container-fluid px-4"> {{-- ✅ full-width fluid container --}}
        <div class="top_heading_dash__ mb-3">
            <div class="main_hed">{{ __('KPI Management') }}</div>
        </div>

        <div class="inner_page_dash__" id="permissionContainer">
            <h4 class="text-[24px] py-[10px] font-semibold">
                KPI List for Cycle: <b>{{ $cycle->cycle_name }}</b>
            </h4>

            <div class="d-flex justify-content-between align-items-center my-3">
                <a href="{{ route('employee-management.kpi.create', $cycle->id) }}" class="btn btn-primary">
                    + Add New KPI
                </a>
                <a href="{{ route('employee-management.appraisal.appraisallist') }}" class="btn btn-secondary">
                    ← Back to Cycles
                </a>
            </div>

            {{-- ✅ Success Message --}}
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- ✅ Full-width Table --}}
            <div class="table-responsive"> {{-- ✅ allows scroll on smaller screens --}}
                <table id="appraisalTable" class="table table-bordered table-striped align-middle w-100">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th style="width: 150px;">KPI Name</th>
                            <th style="width: 150px;">Status</th>
                            <th style="width: 150px;">Created At</th>
                            <th style="width: 150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($kpis->isNotEmpty())
                            @foreach($kpis as $index => $kpi)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $kpi->kpi_name }}</td>
                                <td>
                                    @foreach ($statuses as $status)
                                        @if ($kpi->ref_status_id == $status->id)
                                            {{ $status->type }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ \Carbon\Carbon::parse($kpi->created_at)->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('employee-management.kpi.edit', $kpi->id) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="5" style="padding: 0;">
                                <div class="d-flex justify-content-center align-items-center text-muted"
                                     style="min-height: 200px; width: 100%; font-size: 18px; font-weight: 500;">
                                    No KPIs found for this cycle
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


{{-- ✅ DataTable (initialize safely even if no data) --}}
<script>
    $(document).ready(function() {
        if ($('#appraisalTable tbody tr').length > 1 || 
            !$('#appraisalTable tbody tr td').first().attr('colspan')) {
            $('#appraisalTable').DataTable({
                paging: false,
                ordering: true,
                searching: true,
                info: false,
                lengthChange: false,
                language: { search: "Search KPI:" }
            });
        }
    });

    
</script>



<style>
    #appraisalTable th, #appraisalTable td {
        vertical-align: middle;
        text-align: center;
        font-size: 15px;
        padding: 14px;
    }

    #appraisalTable td:nth-child(2) {
        text-align: left;
        font-weight: 500;
    }

    #appraisalTable {
        width: 100% !important;
        table-layout: auto;
    }

    .home-section {
        width: 100%;
    }

    .inner_page_dash__ {
        background: #fff;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
</style>



@endsection
