@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Transactions List</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div id="transactions" class="tabcontent">
                    <div class="table_over">
                        <table class="cust_table__ table_sparated" id="transactions-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Response Code</th>
                                    <th>Transaction ID</th>
                                    <th>Payment Mode</th>
                                    <th>Reference No</th>
                                    <th>Total Amount</th>
                                    <th>Transaction Amount</th>
                                    <th>Transaction Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#transactions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('payment.index') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'response_code',
                        name: 'response_code'
                    },
                    {
                        data: 'transaction_id',
                        name: 'transaction_id'
                    },
                    {
                        data: 'payment_mode',
                        name: 'payment_mode'
                    },
                    {
                        data: 'ref_no',
                        name: 'ref_no'
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount'
                    },
                    {
                        data: 'transaction_amount',
                        name: 'transaction_amount'
                    },
                    {
                        data: 'transaction_date',
                        name: 'transaction_date'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush
