@extends('layouts.dashboard')
@section('dashboard_content')
<div class="inner_page_dash__">
    <div class="my-4 ">


        <div id="Home" class="tabcontent" data-users-postid="{{ auth()->user()->id }}">
            <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                <div class="">Self Appraisal for Cycle :- {{ $cycle->cycle_name }}</div>

                @if (session('success'))
    <div style="background-color:#d1e7dd; color:#0f5132; padding:10px; border-radius:5px; margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif
            </div>

    <form action="{{ route('employee-management.selfappraisal.storeself') }}" method="POST">
        @csrf
        <input type="hidden" name="appraisal_detail_id" value="{{ $cycleId }}">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>KPI</th>
                    <th>Self Rating (1–5)</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kpis as $kpi)
                    <tr>
                        <td>
                            {{ $kpi->kpi_name }}
                            <input type="hidden" name="kpi_name[]" value="{{ $kpi->kpi_name }}">
                        </td>
                        <td>
                            <input type="number" name="self_rating[]" min="1" max="5"
                                   value="{{ $ratings[$kpi->kpi_name]->self_rating ?? '' }}"
                                   class="form-control" required>
                        </td>
                        <td>
                            <input type="text" name="comment[]"
                                   value="{{ $ratings[$kpi->kpi_name]->comment ?? '' }}"
                                   class="form-control">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

<div class="d-flex justify-content-center gap-3 mt-4">

            <button 
                data-modal-toggle="static-modal" class="hover-effect-btn fill_btn" type="submit">
                Submit
            </button>
    </form>

</div>

</div>

</div>



@endsection
@push('scripts')
<script src="{{ asset('public/js/select2.min.js') }}"></script>
<script src="{{ asset('public/js/resource-pool/hr/advertisement.js') }}"></script>
@endpush