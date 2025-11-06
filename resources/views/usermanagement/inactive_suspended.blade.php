@extends('business.layouts.app')
@section('title', 'All Inactive/Suspended Users')
 
@section('content')
<div class="container-fluid">

<!-- start page title -->
	<div class="row">
		<div class="col-12">
			<div class="page-title-box d-sm-flex align-items-center justify-content-between">
				<h4 class="mb-sm-0">Inactive/Suspended Users</h4>

				<div class="page-title-right">
					@if(canHaveAccess('user-create'))	
					<a class="btn blue-btn" href="{{ route('business.users.create') }}"> <i class="ri-add-line align-bottom me-1"></i> Add New User</a>
					@endif
				</div>

			</div>
		</div>
	</div>
	<!-- end page title -->
 <div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<form>
                    <div class="row g-3 mb-2">
                        <div class="col-xxl-5 col-sm-12">
                            <div class="search-box">
                                <input type="text" name="search_text" id="search_text" class="form-control search bg-light border-light"
                                    placeholder="Search for tasks or something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                       
                        <div class="col-xxl-3 col-sm-4">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">From</span>
                                <input type="date" name="start_date" id="start_date" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="col-xxl-3 col-sm-4">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">To</span>
                                <input type="date" name="end_date" id="end_date" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>

                        <!-- <div class="col-xxl-2 col-sm-4">
                            <div class="input-light">
                                <select class="form-control" name="department" id="department" data-choices data-choices-search-false>
                                    <option value="">Department</option>
                                    @if(!empty(getAllDepartment()))
                                        @foreach(getAllDepartment() as $value)
										<option value="{{$value->id}}">{{$value->department}}</option>
										@endforeach
									@endif
                                </select>
                            </div>
                        </div>

                        <div class="col-xxl-2 col-sm-4">
                            <div class="input-light">
                                <select class="form-control" name="sub_department" id="sub_department" data-choices data-choices-search-false>
                                    <option value="">Sub Department</option>
                                    @if(!empty(getAllSubDepartment()))
                                        @foreach(getAllSubDepartment() as $value)
										<option value="{{$value->id}}">{{$value->department}}</option>
										@endforeach
									@endif
                                </select>
                            </div>
                        </div> -->
                       
                        <!-- <div class="col-xxl-2 col-sm-4">
                            <div class="input-light">
                                <select class="form-control" data-choices data-choices-search-false
                                    name="taskStatus" id="idStatus">
                                    <option value="">Status</option>
                                    <option value="5">Completed</option>
                                    <option value="6">Open</option>
                                    <option value="4">In progress</option>
                                    <option value="12">Verified</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-xxl-1 col-sm-4">
                        <button type="button" id="filterButton" value="search" name="search" class="btn btn-primary w-90">
                            Search
                        </button>
                        </div>
                    </div>
                </form>
			</div>
			  
			<div class="card-body">
				<div class="live-preview">
					<div class="row gy-4">
					<div class="table-responsive">
					 <table class="table align-middle table-nowrap mb-0" id="dt_table">
					 <thead class="table-light text-muted">
						 <tr>
						   <th>#</th>
						   <th>Code</th> 
						   <th>Name</th>
						   <th>Email</th>
						   <th>Mobile</th>
						   <th>Role</th>						   				   
						   <th>Status</th>
						   <th>Action</th>
						 </tr>
					</thead>
					</table>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		
</div>
</div>
 
@endsection

@section('script')

<script>
	$.ajaxSetup({
      	headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      	}
	});
	var table =$('#dt_table').DataTable({
        dom:'Blfrtip',
        lengthMenu : [[10, 25, 50, -1], [10, 25, 50, "All"]],
        processing: true,
        serverSide: true,
        bDestory:true,
        bFilter: false,
        ajax: {
            url: '{{route("business.users.inactiveOrSuspended")}}',
            type: 'get',
            data: function (d) {
            	d.url = '{{route("business.users.inactiveOrSuspended")}}';
				d.search_text = $('#search_text').val();
				d.start_date = $('#start_date').val();
				d.end_date = $('#end_date').val();
				// d.department = $('#department').val();
				// d.sub_department = $('#sub_department').val();
				// d.status = $('#idStatus').val();
            }
          },
        columns: [
            {	data: 'DT_RowIndex',
	            name: 'DT_RowIndex',
	            orderable: false
        	},
        	{	data: 'code',
	            name: 'code',
	            orderable: false
	        },
            {	data: 'name',
	            name: 'name',
	            orderable: false
	        },
            {	data: 'email',
	            name: 'email',
	            orderable: false
	        },
            {	data: 'mobile',
            	name: 'mobile',
            	orderable: false
            },
            {	data: 'role',
	            name: 'role',
	            orderable: false
	        },
	        // {	data: 'department',
	        //     name: 'department',
	        //     orderable: false
	        // },
	        // {	data: 'sub_department',
	        //     name: 'sub_department',
	        //     orderable: false
	        // },
            {	data: 'status',
	            name: 'status',
	            orderable: false
	        },
            {	data: 'action',
            	name: 'action',
            	orderable: false
            },
        ],
        buttons: [
            // {
            //      extend: 'excel',
            //      exportOptions: {
            //         columns: 'th:not(:last-child)'
            //      },
            //      text : '<i class="fa fa-file-excel-o"> Excel</i>',
            //      className: 'btn btn-success',
            //   },{
            //      extend: 'pdfHtml5',
            //      exportOptions: {
            //         columns: 'th:not(:last-child)'
            //      },
            //     orientation : 'landscape',
            //     pageSize : 'LEGAL',
            //     text : '<i class="fa fa-file-pdf-o"> PDF</i>',
            //     titleAttr : 'PDF',
            //     className: 'btn btn-danger',
            //     style:'bar'
            //   }
        ]
    });

    $("#filterButton").click(function(){
			table.draw();
	});
</script>

@endsection
 