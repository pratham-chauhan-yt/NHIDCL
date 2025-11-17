@extends('layouts.dashboard')
@section('title', 'Trainer Dashboard')
@section('dashboard_content')
<section class=" home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Trainer Profile</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4">
            <div id="Home" class="tabcontent">
                <form class="form_grid_cust" id="trainer-profile" action="{{ route('trainer.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="form-input">
                            <label class="required-label">Designation</label>
                            <select name="ref_designation_id" id="ref_designation_id">
                                <option value="">Select</option>
                                @foreach ($designation as $source)
                                    <option value="{{ $source->id }}" {{ old('ref_designation_id', $userprofile->ref_designation_id) == $source->id ? 'selected' : '' }}>
                                        {{ $source->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-input">
                            <label class="required-label">Qualification</label>
                            <select name="ref_qualification_id" id="ref_qualification_id">
                                <option value="">Select</option>
                                @foreach ($qualification as $qualifications)
                                    <option value="{{ $qualifications->id }}" {{ old('ref_qualification_id', $userprofile->ref_qualification_id) == $qualifications->id ? 'selected' : '' }}>
                                        {{ $qualifications->qualification_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="required-label">Available Time</label>
                            <p class="text-muted mb-3">Specify your available time for each day of the week.</p>

                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th>Day</th>
                                        <th>From Time</th>
                                        <th>To Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($daysOfWeek as $day)
                                        @php
                                            $available = $userprofile->availability[$day] ?? ['from' => '', 'to' => ''];
                                        @endphp
                                        <tr>
                                            <td><strong>{{ $day }}</strong></td>
                                            <td>
                                                <input type="time" name="availability[{{ $day }}][from]" 
                                                    value="{{ old("availability.$day.from", $available['from']) }}"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <input type="time" name="availability[{{ $day }}][to]" 
                                                    value="{{ old("availability.$day.to", $available['to']) }}"
                                                    class="form-control">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label class="required-label">Training Charges</label>
                            <input type="text" name="amount" id="amount" value="{{ old('amount', $userprofile->cost_per_session) }}" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" data-validate="required" data-error="Please enter training budget amount.">
                        </div>

                    </div>

                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn fill_btn" type="submit">
                            Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
    <script src="{{ asset('/public/js/training-management.js') }}"></script>
@endpush