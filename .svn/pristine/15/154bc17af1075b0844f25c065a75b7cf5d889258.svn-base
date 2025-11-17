@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">{{ __('Create Sessions') }}</div>
            </div>
        </div>

        <div class="inner_page_dash__">
            {!! Form::open(['route' => 'sessions.store','method' => 'POST']) !!}
                <div class="inpus_cust_cs grid check_box_input grid-cols-1 gap-[10px] mt-4 mb-4">
                    <div class="form-input">
                        <label class="required-label">{{ __('Choose Trainer') }}</label>
                        <select name="trainer" id="trainer" class="form-control @error('trainer') is-invalid @enderror" required>
                            <option value="">----- Choose session trainer -----</option>
                            @foreach($trainers as $trainerData)
                            <option value="{{$trainerData->id}}">{{ucwords($trainerData->user->name ?? '')}}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label class="required-label">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" maxlength="100" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label class="required-label">{{ __('Agenda') }}</label>
                        <input type="text" name="agenda" id="agenda" class="form-control @error('agenda') is-invalid @enderror" value="{{ old('agenda') }}" maxlength="100" required>
                        @error('agenda')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label class="required-label">{{ __('Address') }}</label>
                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" maxlength="200" required>{{ old('address') }}</textarea>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label class="required-label">{{ __('Date') }}</label>
                        <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required>
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label class="required-label">{{ __('Duration') }}</label>
                        <input type="text" name="duration" id="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}" maxlength="100" required>
                        @error('duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label class="required-label">{{ __('Type') }}</label>
                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="">----- Choose session type -----</option>
                            <option value="mandatory">Mandatory</option>
                            <option value="upcoming">Upcoming</option>
                            <option value="job">Job</option>
                            <option value="requested">Requested</option>
                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label class="required-label">{{ __('Status') }}</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="">----- Choose session status -----</option>
                            @foreach($status as $statusData)
                            <option value="{{$statusData->id}}">{{ucwords($statusData->type)}}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-input">
                    <button type="submit" class="hover-effect-btn fill_btn">{{ __('Submit') }}</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection