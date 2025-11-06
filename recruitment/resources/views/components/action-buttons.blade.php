@props(['id', 'buttons' => [], 'routePrefix' => '', 'role' => '', 'module' => '', 'status'])

@php
    $user = Auth::user();
    $userRole = $user->getRoleNames()->first();
    $userPermissions = $user->getAllPermissions()->pluck('name')->toArray();
@endphp


<div class="btn-group" role="group">

    @foreach ($buttons as $type)
        @switch($type)
            @case('show')
                @if (canAccess('view', $userPermissions, $module))
                    <a href="{{ route($routePrefix . '.show', encryptId($id)) }}" class="btn btn-sm btn-info">View</a>
                @endif
            @break

            @case('renew')
                @if (canAccess('renew', $userPermissions, $module))
                    <a href="{{ route($routePrefix . '.renew', encryptId($id)) }}" class="btn btn-sm btn-info">Renew</a>
                @endif
            @break

            @case('edit')
                @if (canAccess('edit', $userPermissions, $module))
                    {{-- @if ($user->hasRole($role)) --}}
                    @if ($userRole == 'MD-Role')
                        @if ($user->id == $creator_id && $status != 'Completed')
                            <a href="{{ route($routePrefix . '.edit', encryptId($id)) }}" class="btn btn-sm btn-warning">Edit</a>
                        @endif
                    @else
                        <a href="{{ route($routePrefix . '.edit', encryptId($id)) }}" class="btn btn-sm btn-warning">Edit</a>
                    @endif
                    {{-- @endif --}}
                @endif
            @break

            @case('delete')
                @if (canAccess('delete', $userPermissions, $module))
                    {{-- @if ($user->hasRole($role)) --}}
                    @if ($userRole === 'MD-Role')
                        @if ($user->id == $creator_id && $status != 'Completed')
                            <form action="{{ route($routePrefix . '.destroy', encryptId($id)) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endif
                    @else
                        <form action="{{ route($routePrefix . '.destroy', encryptId($id)) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    @endif
                    {{-- @endif --}}
                @endif
            @break

            @case('status')
                @if (canAccess('status', $userPermissions, $module))
                    {{-- @if ($user->hasRole($role)) --}}
                    @if ($userRole === 'MD-Role')
                        @if ($status != 'Completed')
                            <button type="button" class="btn btn-sm btn-primary mark-as-completed-btn"
                                data-action="{{ route($routePrefix . '.complete', encryptId($id)) }}">
                                Update
                            </button>
                        @endif
                    @else
                        <button type="button" class="btn btn-sm btn-primary mark-as-completed-btn"
                            data-action="{{ route($routePrefix . '.complete', encryptId($id)) }}">
                            Update
                        </button>
                    @endif
                    {{-- @endif --}}
                @endif
            @break

            @case('verify')
                @if (canAccess('verify', $userPermissions, $module))
                    <form action="{{ route($routePrefix . '.verify', encryptId($id)) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" onclick="return confirm('Are you sure want to verify?')"
                            class="btn btn-sm btn-info mark-as-completed-btn" data-action="">
                            Verify
                        </button>

                    </form>

                    {{-- <button type="button"  class="btn btn-sm btn-info verify-btn"
                        data-action="{{ route($routePrefix . '.verify', encryptId($id)) }}">
                        Verify
                    </button> --}}
                @endif
            @break

            {{-- @case('reject')
                @if (canAccess('reject', $userPermissions, $module))
                    <button type="button" class="btn btn-sm btn-danger reject-btn"
                        data-action="{{ route($routePrefix . '.reject', encryptId($id)) }}">
                        Refer Back
                    </button>
                @endif
            @break --}}

            @case('receive')
                @if (canAccess('receive', $userPermissions, $module))
                    <button type="button" class="btn btn-sm btn-primary receive-btn"
                        data-action="{{ route($routePrefix . '.receive.update', encryptId($id)) }}">
                        Receive
                    </button>
                @endif
            @break

            @case('referback')
                @if (canAccess('referback', $userPermissions, $module))
                    <button type="button" class="btn btn-sm btn-danger referback-btn"
                        data-action="{{ route($routePrefix . '.referback', encryptId($id)) }}">
                        Refer Back
                    </button>
                @endif
            @break

          @case('renewsubmit')
                   <a href="{{ route($routePrefix . '.showrenew', encryptId($id)) }}"  class="btn btn-sm btn-danger">
                      view
                  </a>
           @break

             @case('acceptrenew')
                   <a href="{{ route($routePrefix . '.acceptRenew', encryptId($id)) }}"  class="btn btn-sm btn-danger">
                      view
                  </a>
           @break

        @endswitch
    @endforeach
</div>
