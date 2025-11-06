@php
    $user = user();
@endphp
<form id="payment-form" method="POST" action="{{ route('payment.pay') }}" class="form_grid_cust"
    enctype="multipart/form-data">
    @csrf
    <div class="inpus_cust_cs form_grid_dashboard_cust_">

        <input type="hidden" name="from" value="{{ $from }}">
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="totalpay" value="{{ Crypt::encrypt($record?->amount) }}">
        <div class="form-input">
            <label class="required-label">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $previewData?->user?->name) }}" placeholder="Enter your Name" readonly>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-input">
            <label class="required-label">Mobile</label>
            <input type="text" id="mobile" name="mobile" value="{{ old('mobile', $previewData?->user?->mobile) }}" placeholder="Enter your mobile" readonly>
            @error('mobile')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-input">
            <label class="required-label">Email</label>
            <input type="text" id="email" name="email" value="{{ old('email', $previewData?->user?->email) }}" placeholder="Enter your email" readonly>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="inpus_cust_cs form_grid_dashboard_cust_">
        <div class="form-input">
            <label class="required-label">Amount to be paid</label>
            <input type="text" id="amount" name="amount" value="{{ $record->amount }}" readonly>
            @error('amount')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    @if(!$order || !$order->response_code || $order->response_code !== "E000")
        <div class="button_flex_cust_form">
            <button type="submit" class="hover-effect-btn border_btn">Proceed for Payment</button>
        </div>
    @endif
    <input type="hidden" name="response_code" id="response_code" value="{{ $order?->response_code }}">
</form>


@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>
    <script src="{{ asset('/public/validation/payment.js') }}"></script>
@endpush
