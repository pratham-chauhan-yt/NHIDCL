@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Documents Received</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4">
                <div class="tab_custom_c">
                    <button class="tablink" onclick="openPage('Received-Documents', this, '#373737')" data-page="Received-Documents" id="defaultOpen">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                        </svg>
                        Documents Shared with You
                    </button>
                </div>

                <div id="Received-Documents" class="tabcontent">
                    <div class="table_over mt-4 p-1">
                        <table id="Received-DocumentsTable"
                            class="cust_table__ table-auto text-wrap cell-border stripe compact hover w-full">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Remark</th>
                                    <th>Shared Type</th>
                                    <th>Shared By</th>
                                    <th>Shared Date</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('public/css/flowbite.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('public/js/utils/dataTableManager.js') }}"></script>
    <script src="{{ asset('public/js/document-management/sharing-document/received-document.js') }}"></script>
@endpush
