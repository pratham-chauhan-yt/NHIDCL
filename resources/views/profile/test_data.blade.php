@extends('layouts.dashboard')
@section('dashboard_content')
<section class="home-section ">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed"> Test Data</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        @include('components.alert')
        <form action="" method="post">
            @csrf
            <textarea name="summary" class="form-control"></textarea>
            <input type="submit" name="submit" class="btn btn-primary">
        </form>
    </div>
</section>
 @endsection