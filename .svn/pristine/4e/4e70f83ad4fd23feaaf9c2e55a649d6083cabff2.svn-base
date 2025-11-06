@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section">
        <div class="container-fluid">
            <div class="top_heading_dash__">
                <div class="main_hed">{{ __('User Login History') }}</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class=" inner_page_dash">
                @if (Auth::user()->hasRole('Super Admin'))
                <form id="filterForm" class="mb-0 form_grid_cust">
                    <div class="space-y-4 mb-6">
                        <div class="flex space-x-4 gap-[10px]">
                            <div class="flex flex-col">
                                <select name="user_id" id="user_id" class="mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">-- Select User --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex flex-col">
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div class="flex flex-col">
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div class="flex justify-start">
                                <button type="button" id="resetFilters" class="hover-effect-btn fill_btn">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
                @endif
                <div class="table_over">
                    <table class="cust_table__ table_sparated" id="loginHistoryTable">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Emp. Name</th>
                                <th>Browser</th>
                                <th>Platform</th>
                                <th>Logs</th>
                                <th>Ip Address</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script>
    const loginHistoryUrl = "{{ route('user.login.history') }}";
</script>
@endpush