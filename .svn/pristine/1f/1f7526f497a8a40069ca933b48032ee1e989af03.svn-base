@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Grievance Details</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <h1 class="candidat_cust-title">{{$grievance->title}}</h1>
        <div class="my-4">
            <div class="candidat_cust-dates">
                <p>Grievance Number: <br><span class="text-red-500">{{$grievance->grievance_id}}</span></p>
                <p>Submitted Date: <br><span>{{$grievance->date}}</span></p>
                <p>Petitioner: <br><span>{{$grievance->name}}</span></p>
                <p>Type: <br><span>{{ucwords(str_replace('_', ' ', $grievance->type))}}</span></p>
                <p>Status: <br><span>{{ucwords(str_replace('_', ' ', $grievance->status))}}</span></p>
                <p>File: <br>
                @php
                $pathName = $grievance->upload_file_path;   // e.g. "uploads/grievance-management/documents/"
                $fileName = $grievance->upload_file;        // e.g. "68c3bbedd8dd9_tarunmahajanprofile.pdf"
                $viewFileUrl = route('grievance-management.view.files', [
                    'pathName' => $pathName,
                    'fileName' => $fileName
                ]);
                @endphp
                <span><a href="{{$viewFileUrl}}" target="_blank"><i class="fa fa-file-pdf mx-1" aria-hidden="true"></i></a></span>
                </p>
                @php
                    use Carbon\Carbon;

                    $createdAt = Carbon::parse($grievance->created_at);
                    $dueDate   = $createdAt->copy()->addHours($grievance->handled_at);
                @endphp
                <p>Due Date: <br><span>{{$dueDate}}</span></p>
                <p>Assigned To: <br><span>{{$grievance->assigned->name}} <br>({{$grievance->assigned->email}})</span></p>
            </div>
            <hr class="my-3">
            <!-- <p class="text-sm mt-3"><strong>Note:-</strong> <span class="text-gray-600">{{$grievance->message}}</span></p> -->
            <div class="table_over mt-4">
                <div class="top_heading_dash__">
                    <div class="main_hed">
                        <h4 class="font-semibold text-black">List of replies:-</h4>
                    </div>
                </div>
                <table class="cust_table__ table_sparated">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>Users</th>
                            <th>Type</th>
                            <th>Remark/Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grievance->logs as $index=>$logdata)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{$logdata?->user?->name}}</td>
                            <td>{{ucwords($logdata->action)}}</td>
                            <td>{{$logdata->comment}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @can('grievance-management-reply')
            <div class="top_heading_dash__">
                <div class="main_hed mt-3">
                    <h4 class="font-semibold text-black">Grievance reply:-</h4>
                </div>
            </div>
            <form action="{{ route('grievance-management.grievance.comment', $grievance) }}" method="POST" class="mt-4">
                @csrf
                <div class="inpus_cust_cs">
                    <div class="form-group">
                        <label for="status" class="required-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">----- choose grievance status -----</option>
                            <option value="under_review">Under Review</option>
                            <option value="resolved">Resolved</option>
                            <option value="closed">Closed</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment" class="required-label">Comment</label>
                        <textarea name="comment" class="form-control" required></textarea>
                    </div>
                    
                    <button type="submit" class="hover-effect-btn border_btn mt-2">Add Comment</button>
                </div>
            </form>
            @endcan
            @if($grievance->status==="resolved")
                <form action="{{ route('grievance-management.grievances.feedback', $grievance->id) }}" method="POST">
                    @csrf
                    <div class="inpus_cust_cs mt-3">
                        <div class="form-group">
                            <label class="required-label">Are you satisfied with the resolution?</label>
                            <select name="feedback_status" class="form-select" required>
                                <option value="satisfied"> Yes, I’m satisfied</option>
                                <option value="not_satisfied"> No, I want to appeal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="required-label">Remarks</label>
                            <textarea name="feedback_remarks" id="feedback_remarks" class="form-control mt-2" placeholder="Leave comments" maxlength="1000"  required></textarea>
                            <span id="charCount" class="fs-12">Maximum 1000 characters allowed. (1000 characters left)</span>
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="hover-effect-btn border_btn mt-2">Submit Feedback</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection