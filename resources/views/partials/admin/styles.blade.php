@stack('style_start')

<link rel="stylesheet" href="{{ asset('public/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/dataTables.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/dataTables.tailwindcss.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/output.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/sweetalert2.min.css') }}">

<script src="{{ asset('public/js/fetchWrapper.js') }}"></script>
<script src="{{ asset('public/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('public/js/ajaxHandler.js') }}"></script>

@stack('styles')

@stack('style_end')
