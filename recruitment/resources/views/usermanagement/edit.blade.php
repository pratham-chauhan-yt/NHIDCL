@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="row">
        <div class="col-12">
            @include('breadcrumb.index')
        </div>
    </div>
<style>
.inline-checkboxes {
    display: flex;
    align-items: center;
}

.inline-checkboxes .form-check {
    margin-right: 15px; /* Adjust spacing as needed */
}

	</style>
<div class="container-fluid">

<!-- start page title -->
	<!-- <div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Edit Employee</h4>

				<div class="page-title-right">
					<ol class="breadcrumb m-0">
						<li class="breadcrumb-item"><a href="{{ route('usermanagement.index') }}">Employee</a></li>
						<li class="breadcrumb-item active">Edit Employee</li>
					</ol>
				</div>

			</div>
		</div>
	</div> -->
	<!-- end page title -->
	{!! Form::open(array('route' => ['usermanagement.update', $user->id],'method'=>'PATCH','files' => 'true','enctype'=>'multipart/form-data')) !!}
 <div class="row">
	<div class="col-lg-12">
		<div class="card">
	
			 @if (count($errors) > 0)
			  <div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
				   @foreach ($errors->all() as $error)
					 <li>{{ $error }}</li>
				   @endforeach
				</ul>
			  </div>
			@endif
			
			<div class="card-header align-items-center d-flex">
				<h4 class="card-title mb-0 flex-grow-1">Employee Detail</h4>
				 
			</div>
			
			<div class="card-body">
				<div class="live-preview">
				
				 
					<div class="row gy-4">					 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelName" class="form-label">{{ __('Emp Name') }} *</label>
								<input type="text" name="userName" class="form-control" id="labelName" value="{{old('userName', $user->name)}}" required>
							</div>
						</div>
						
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="labelEmail" class="form-label">{{ __('Email * (Username)') }} </label>
								<div class="form-icon right">
									<input type="email" name="userEmail" class="form-control form-control-icon" value="{{old('userEmail', $user->email)}}" id="labelEmail" required><i class="ri-mail-unread-line"></i>
								</div>
							</div>
						</div>
					
							
    <div>
	@php
   
@endphp


    </div>
</div>

						
						 
						<div class="col-xxl-3 col-md-6">
							<div>
								<label for="statusSelect" class="form-label">{{ __('Status') }} *</label>
								<select name="userStatus" class="form-select" id="statusSelect" required>
									<option value="">{{ __('Choose...') }}</option>
									<option {{(old('userStatus',$user->status) == '1') ? 'selected': ''}} value="1">Active</option>
									<option {{(old('userStatus',$user->status) == '2') ? 'selected': ''}} value="2">Inactive</option>									 
								</select>
							</div>
						</div>
						 	  
								
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 text-center">
		<button type="submit" class="btn btn-soft-primary">{{ __('Update') }}</button>
		<button type="button" class="btn py-0 fs-16 text-body">
                                        <a onclick="location.href='javascript:history.go(-1)'" class="btn btn-soft-primary" > <i class="fas fa-chevron-left me-1"></i> Back </a>
                                    </button>
	</div>
</div>
  

{!! Form::close() !!}



</div> 
@endsection
@section('script')
<script>
 $(document).ready(function() {
  $('.js-example-basic-multiple').select2();
});



</script>

@endsection
 