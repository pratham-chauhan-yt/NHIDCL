@extends('layouts.dashboard')
@section('dashboard_content')

<div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
        <div class="main_hed">Project Dashboard</div>
        <div class="plain_dlfex bg_elips_ic">

        </div>
    </div>
</div>
<!-- <div id="project" class="tabcontent">
        <div class="search_section_box md-6 border rounded bg-white shadow-sm p-3">
            <form id="bg-search-form" class="flex flex-wrap items-center gap-2" onsubmit="return false;">
                <div class="flex">
                    <input
                     type="text"
                     id="searchInput"
                     class="form-control w-1/3"
                     placeholder="Enter value to search">
                </div>
                <div class="flex">
                    <input type="radio" class="form-input-contol " name="ref_name" value="Ref. No">Ref. No
                    <input type="radio" class="form-input-contol" name="ref_name" value="BG No">BG No
                    <input type="radio" class="form-input-contol" name="ref_name" value="Agency Name">Agency Name
                    <input type="radio" class="form-input-contol" name="ref_name" value="Amount">Amount
                </div>
                <button type="button" id="searchButton" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div> -->
<div id="project" class="tabcontent">
    <div class="search_section_box md-6 border rounded bg-white shadow-sm p-3">
        <form id="bg-search-form" class="flex flex-wrap items-center gap-2">
            <!-- Dropdown Options -->
            <div class="flex w-full">
                <select name="ref_name" id="ref_name" class="form-control w-full">
                    <option value="">Select State</option>

                    @foreach($states as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Button -->
            <button type="button" id="searchButton" class="btn btn-primary">
                Search
            </button>

        </form>
    </div>
</div>

<div class="dashbord_main_content_rigt">
    <div class="one_cut">
        <!-- <div class="card_cust_parnet_dash">
            <div class="first_card_dash">
                <div class="bg_card_1">
                    <a href="{{ route('bgms.project.list') }}" class="">
                        <div class="inner_flex_card">
                            <div>
                                <p class="">Total Task</p>
                                <h5 class="">555</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="first_card_dash">
                <div class="bg_card_1">
                    <a href="{{ route('bgms.project.list') }}" class="">
                        <div class="inner_flex_card">
                            <div>
                                <p class="">Total Task</p>
                                <h5 class="">555</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="first_card_dash">
                <div class="bg_card_1">
                    <a href="{{ route('bgms.project.list') }}" class="">
                        <div class="inner_flex_card">
                            <div>
                                <p class="">Total Task</p>
                                <h5 class="">555</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="first_card_dash">
                <div class="bg_card_1">
                    <a href="{{ route('bgms.project.list') }}" class="">
                        <div class="inner_flex_card">
                            <div>
                                <p class="">Total Task</p>
                                <h5 class="">555</h5>
                        </div>
                        </div>one_cut
                    </a>
                </div>
            </div>
            <div class="first_card_dash">
                <div class="bg_card_1">
                    <a href="{{ route('bgms.project.list') }}" class="">
                        <div class="inner_flex_card">
                            <div>
                                <p class="">Total Task</p>
                                <h5 class="">555</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="first_card_dash">
                <div class="bg_card_1">
                    <a href="{{ route('bgms.project.list') }}" class="">
                        <div class="inner_flex_card">
                            <div>
                                <p class="">Total Task</p>
                                <h5 class="">555</h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            

        </div> -->
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('public/js/chart.js') }}"></script>
<script src="{{ asset('public/js/md-task.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#searchButton').on('click', function() {
            const state = $('#ref_name').val();
            $.ajax({
                url: "{{route('bgms.project.stateSearch')}}",
                type: "POST",
                data: {
                    state: state,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('.one_cut').html(response);
                    console.log("Success:", response);
                },
                error: function(xhr) {
                    console.log("Error:", xhr.responseText);
                }
            });
        });
    });
    $(document).ready(function() {
        const state = 'all';
        $.ajax({
            url: "{{route('bgms.project.stateSearch')}}",
            type: "POST",
            data: {
                state: state,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                $('.one_cut').html(response);
                console.log("Success:", response);
            },
            error: function(xhr) {
                console.log("Error:", xhr.responseText);
            }
        });
    });
</script>
@endpush