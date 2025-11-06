@props(['id', 'buttons' => [], 'routePrefix' => ''])

<div class="btn-group" role="group">
    @foreach ($buttons as $type)
        @switch($type)
            @case('show')
                <a href="{{ route($routePrefix . '.show', encryptId($id)) }}" class="btn btn-sm btn-info">View</a>
            @break

            @case('edit')
            @if(Auth::user()->getRoleNames()->first() == "MD-Role" && Auth::user()->id == $creator_id && $status != 'Completed')
                <a href="{{ route($routePrefix . '.edit', encryptId($id)) }}" class="btn btn-sm btn-warning">Edit</a>
            @endif
            @break

            @case('delete')
            @if(Auth::user()->getRoleNames()->first() == "MD-Role" && Auth::user()->id == $creator_id && $status != 'Completed')
                <form action="{{ route($routePrefix . '.destroy', encryptId($id)) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            @endif
            @break

            @case('status')
                @if ($status != 'Completed' && Auth::user()->getRoleNames()->first() == "MD-Role")
                <button type="button" class="btn btn-sm btn-primary mark-as-completed-btn" data-action="{{ route($routePrefix . '.complete', encryptId($id)) }}">
                    Update
                </button>
                @endif
            @break

        @endswitch
    @endforeach
</div>
<!-- Overlay -->
<div id="taskModalOverlay" class="modal-overlay" style="display: none;"></div>

<!-- Modal -->
<div id="taskModal" class="custom-modal" style="display:none;">
    <form class="form_grid_cust" id="taskStatusForm" method="POST">
        @csrf
        @method('PUT')
        <h2>Update Task Status</h2>
        <div class="inpus_cust_cs form_grid_dashboard_cust_" style="display:block;">
            <div class="">
                <label class="required-label" for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks"></textarea>
                <small class="error-message" style="color:red; display:none;">Please enter valid remark (min 5 chars).</small>
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
@push('scripts')
    <script src="{{ asset('js/md-task.js') }}"></script>
@endpush
