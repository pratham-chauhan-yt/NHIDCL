@extends('layouts.dashboard')
@section('dashboard_content')


    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('Notifications') }}</div>

        </div>
    </div>


    <div class="inner_page_dash__">

        <div class="plain_dlfex bg_elips_ic">
            <h3>Notifications List</h3>
            <a href="{{ route('notifications.markAllAsRead') }}" id="markAllAsRead"
            class="font-bold">{{ __('Mark All as Read') }}</a>
        </div>


                    <ul class="list-group cust_list_notification">
                        @if ($notifications->count() > 0)
                            @foreach ($notifications as $notification)
                                <li class="list-group-item {{ $notification->read_at ? '' : 'list-group-item-primary' }}">
                                    {{-- <a href="{{ $notification->data['url'] ?? '#' }}" class="text-reset d-block">
                                        {{ $notification->data['message'] }}
                                    </a> --}}
                                    <a href="{{ route('notification.read', $notification->id) }}"
                                        class="text-reset d-block">
                                        {{ $notification->data['message'] }}
                                    </a>
                                    <small
                                        class="text-muted float-right">{{ $notification->created_at->diffForHumans() }}</small>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">
                                {{ __('No notifications') }}
                            </li>
                        @endif
                    </ul>

                    {{ $notifications->links() }} <!-- Pagination links -->

        </div>

@endsection
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('markAllAsRead').addEventListener('click', function(event) {
            event.preventDefault();

            fetch("{{ route('notifications.markAllAsRead') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {

                    document.querySelectorAll('.notification-item').forEach(item => {
                        item.classList.remove('bg-blue-100', 'text-blue-800', 'hover:bg-blue-200');
                        item.classList.add('bg-gray-100', 'text-gray-500');
                    });


                    const badge = document.querySelector('.badge');
                    if (badge) {
                        badge.innerText = '0';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>
@endpush
