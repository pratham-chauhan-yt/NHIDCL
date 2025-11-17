@extends('layouts.dashboard')
@section('dashboard_content')
<div class="inner_page_dash__">
    <div class="my-4 ">


        <div id="Home" class="tabcontent" data-users-postid="{{ auth()->user()->id }}">
            <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                <div class="">Appraisal Cycle Create</div>

                @if (session('success'))
                <div style="background-color:#d1e7dd; color:#0f5132; padding:10px; border-radius:5px; margin-bottom:10px;">
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <form action="{{ route('employee-management.appraisal.assigntocycle') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="cycle_id">Select Appraisal Cycle</label>
                    <select name="cycle_id" class="form-control" required>
                        @foreach($cycles as $cycle)
                        <option value="{{ $cycle->id }}">{{ $cycle->cycle_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="employee_ids">Select Employees</label>
                    <select name="employee_ids[]" multiple class="form-control" required>
                        @foreach($employees as $emp)
                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="manager_id">Select Manager</label>
                    <select name="manager_id" class="form-control" required>
                        @foreach($managers as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Assign Employees</button>
            </form>
        </div>



    </div>

</div>



@endsection
@push('scripts')
<script src="{{ asset('public/js/select2.min.js') }}"></script>
<script src="{{ asset('public/js/resource-pool/hr/advertisement.js') }}"></script>
@endpush