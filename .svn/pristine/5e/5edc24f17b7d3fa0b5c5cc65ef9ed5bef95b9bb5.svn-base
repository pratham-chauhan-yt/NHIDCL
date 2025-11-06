@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Task List</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div class="tab_custom_c">
                    <button class="tablink" onclick="openPage('md-task', this, '#373737')" id="defaultOpen">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        Pending
                    </button>
                    <button class="tablink" onclick="openPage('md-task', this, '#373737')">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                        </svg>
                        Completed
                    </button>
                </div>

                <div id="md-task" class="tabcontent">
                    <div class="table_over">
                        <table class="cust_table__ table_sparated" id="task-management-table">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>Task Id</th>
                                    <th>Task Name</th>
                                    <th>Due Date</th>
                                    <th>Pending</th>
                                    <th>Repeat</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Assigned To</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class=""> </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="taskModalOverlay" class="modal-overlay" style="display: none;"></div>


    <div id="taskModal" class="custom-modal" style="display:none;">
        <form class="form_grid_cust" id="taskStatusForm" method="POST">
            @csrf
            @method('PUT')
            <h2>Update Task Status</h2>
            <div class="inpus_cust_cs form_grid_dashboard_cust_" style="display:block;">
                <div class="">
                    <label class="required-label" for="remarks">Remarks</label>
                    <textarea id="remarks" name="remarks"></textarea>
                    <small class="error-message" style="color:red; display:none;">Please enter valid remark (min 5
                        chars).</small>
                </div>

                <div class="">
                    <label class="required-label" for="status">Status</label>
                    <select id="status" name="status" class="">
                        <option value="">Select Status</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                    <small class="error-message" style="color:red; display:none;">Please select a status.</small>
                </div>

                <div class="modal-buttons">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-cancel" id="closeModal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
@endsection



@push('scripts')
    <script src="{{ asset('public/js/md-task.js') }}"></script>
@endpush
