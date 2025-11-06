@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        <div class="col-md-12">
            <div class="parrent_dahboard_">
                <div class="text">{{ __('Candidate Details') }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="bg_chart_card">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="mb-3">
                        <label class="form-label aster">{{ __('First Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $user->name) }}" disabled>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="mb-3">
                        <label class="form-label aster">{{ __('Email') }}</label>
                        <input type="email" class="form-control" name="email" id="email"
                            value="{{ old('email', $user->email) }}" disabled>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">{{ __('Created By') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="created_by" name="created_by"
                                value="{{ old('name', $user->creator ? $user->creator->email : 'N/A') }}" disabled>
                            @if ($user->creator && auth()->user()->hasRole('HR Admin'))
                                <a href="{{ route('user-config.view', Crypt::encrypt($user->creator->id)) }}"
                                    class="quick-btn">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">{{ __('Updated By') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="updated_by" name="updated_by"
                                value="{{ old('name', $user->updater ? $user->updater->email : 'N/A') }}" disabled>
                            @if ($user->updater && auth()->user()->hasRole('Super Admin'))
                                <a href="{{ route('user-config.view', Crypt::encrypt($user->updater->id)) }}"
                                    class="quick-btn">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">{{ __('Created At') }}</label>
                        <input type="text" class="form-control" id="created_at" name="created_at"
                            value="{{ old('name', $user->created_at ?? 'N/A') }}" disabled>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">{{ __('Updated At') }}</label>
                        <input type="text" class="form-control" id="updated_at" name="updated_at"
                            value="{{ old('name', $user->updated_at ?? 'N/A') }}" disabled>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/chart-loader.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
@endpush
