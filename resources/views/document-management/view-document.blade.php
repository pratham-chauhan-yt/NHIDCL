@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Office Order & Other Documents</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            @php
                $tabs = [
                    'Office-Order' => [
                        'label' => 'Office Order',
                        'columns' => ['#', 'Title', 'Code/File Number', 'Type', 'Department', 'Issue Date', 'Tagged User', 'File',
                        ],
                    ],
                    'SOP' => [
                        'label' => 'SOP',
                        'columns' => ['#', 'Title', 'Code/File Number', 'Department', 'Issue Date', 'File'],
                    ],
                    'Policy' => [
                        'label' => 'Policy',
                        'columns' => ['#', 'Title', 'Code/File Number', 'Issue Date', 'File'],
                    ],
                    'Circular' => [
                        'label' => 'Circular',
                        'columns' => ['#', 'Title', 'Code/File Number', 'Department', 'Issue Date', 'File'],
                    ],
                    'IS-Codes' => [
                        'label' => 'IS Codes, IRC & Other publication',
                        'columns' => ['#', 'Title', 'Code/File Number', 'Year', 'File'],
                    ],
                ];
            @endphp

            <div class="my-4">
                {{-- Tab Buttons --}}
                <div class="tab_custom_c">
                    @foreach ($tabs as $key => $tab)
                        <button class="tablink" data-page="{{ $key }}"
                            onclick="openPage('{{ $key }}', this, '#373737')"
                            @if ($loop->first) id="defaultOpen" @endif>
                            {{-- You can replace these with dynamic SVGs if needed --}}
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                            </svg>
                            {{ $tab['label'] }}
                        </button>
                    @endforeach
                </div>

                {{-- Tab Content --}}
                @foreach ($tabs as $key => $tab)
                    <div id="{{ $key }}" class="tabcontent">
                        <div class="table_over mt-4 p-1">
                            <table id="{{ $key }}Table" data-edit="@json(auth()->user()->can('dms-edit'))"
                                data-delete="@json(auth()->user()->can('dms-delete'))"
                                class="cust_table__ table-auto text-wrap cell-border stripe compact hover w-full">
                                <thead>
                                    <tr>
                                        @foreach ($tab['columns'] as $col)
                                            <th>{{ $col }}</th>
                                        @endforeach
                                        @can(['dms-edit', 'dms-delete'])
                                            <th>Action</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('public/css/flowbite.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('public/js/utils/dataTableManager.js') }}"></script>
    <script src="{{ asset('public/js/document-management/view-document.js') }}"></script>
@endpush
