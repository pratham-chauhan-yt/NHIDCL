@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">View Knowledgebase Query</div>
                <div class="plain_dlfex bg_elips_ic">
                    <button type="button" onclick="history.back();"
                        class="hover-effect-btn fill_btn">{{ __('Back') }}</button>
                </div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4">
                <div id="Home" class="tabcontent">
                    <div class="candidat_cust-dates">
                        <table class="details-table">
                            <tbody>
                                <tr>
                                    <th>Query ID:</th>
                                    <td>{{ $data->query_id }}</td>
                                </tr>
                                <tr>
                                    <th>Title:</th>
                                    <td>{{ $data->title }}</td>
                                </tr>
                                <tr>
                                    <th>Meta Title:</th>
                                    <td>{{ $data->meta_title }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $data->description }}</td>
                                </tr>
                                <tr>
                                    <th>Meta Description:</th>
                                    <td>{{ $data->meta_description }}</td>
                                </tr>
                                <tr>
                                    <th>Added Date:</th>
                                    <td>{{ $data->created_at ? $data->created_at->format('d-m-Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Added By:</th>
                                    <td>{{ $data->createdBy ? $data->createdBy->name . ' (' . $data->createdBy->email . ')' : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>File:</th>
                                    <td>
                                        @if (isset($data->image))
                                            @php
                                                $FilePath = 'uploads/qms-knowladgebase-file/';
                                                $FileName = basename($data->image);
                                                $FileUrl = route('qms.view-file', [
                                                    'pathName' => $FilePath,
                                                    'fileName' => $FileName,
                                                ]);
                                            @endphp
                                            <a href="{{ $FileUrl }}" target="_blank" data-bs-toggle="tooltip"
                                                title="View query file">
                                                <i class="fa fa-file mx-1" aria-hidden="true"></i> View File
                                            </a>
                                        @else
                                            <span>No file uploaded</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .candidat_cust-dates {
            margin: 1rem auto;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
        }

        .details-table th,
        .details-table td {
            padding: 10px 15px;
            vertical-align: top;
            border-bottom: 1px solid #ddd;
        }

        .details-table th {
            text-align: left;
            width: 25%;
            font-weight: 600;
            color: #222;
            background-color: #f9f9f9;
        }

        .details-table td {
            color: #555;
        }

        .details-table a {
            color: #0d6efd;
            /* Bootstrap blue */
            text-decoration: none;
        }

        .details-table a:hover {
            text-decoration: underline;
        }
    </style>
@endpush
@push('scripts')
    {{-- <script src="{{ asset('public/validation/query-management/raised-query.js') }}"></script> --}}
@endpush
