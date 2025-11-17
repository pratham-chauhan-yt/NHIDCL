@extends('layouts.dashboard')

@section('dashboard_content')
<div class="inner_page_dash__">
    <div class="my-4">
        <div id="Home" class="tabcontent" data-users-postid="{{ auth()->user()->id }}">
            <div class="parrent_dahboard_chart_c inner_body_style inner_pages mt-0">
                <div>Add KPI for Cycle: <b>{{ $cycle->cycle_name }}</b></div>

                @if (session('success'))
                    <div class="alert alert-success mt-3" style="background-color:#d1e7dd; color:#0f5132; padding:10px; border-radius:5px;">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <form action="{{ route('employee-management.kpi.store') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="cycle_id" value="{{ $cycle->id }}">

                <div class="mb-3">
                    <label for="kpi_name" class="form-label">KPI Name</label>
                    <input 
                        type="text" 
                        name="kpi_name" 
                        id="kpi_name" 
                        class="form-control @error('kpi_name') is-invalid @enderror" 
                        value="{{ old('kpi_name') }}" 
                        required
                    >
                    @error('kpi_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                   <select name="status" id="status" class="form-control" required>
                     @foreach ($statuses as $status)

                        <option value="{{ $status->id }}" {{ old('status') == $status->id ? 'selected' : '' }}>
    {{ $status->type }}
</option>
@endforeach
 </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

          <div class="d-flex justify-content-center gap-3 mt-4">
    
        <button
             class="hover-effect-btn fill_btn" type="submit">
                Submit
            </button>

   
</div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/js/resource-pool/hr/advertisement.js') }}"></script>
@endpush
