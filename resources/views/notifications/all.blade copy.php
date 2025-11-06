@extends('layouts.dashboard')
@section('dashboard_content')


    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('Notifications') }}</div>

        </div>
    </div>


    <div class="inner_page_dash__">

        <div class="plain_dlfex bg_elips_ic">
            <a href="{{ route('notifications.markAllAsRead') }}" id="markAllAsRead"
                            class="quick-btn">{{ __('Mark All as Read') }}</a>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="bg_chart_card mt-0">
                    <div class="parrent_dahboard_ chart_c">
                        <div class="text text-dark"> </div>
                        <a href="{{ route('notifications.markAllAsRead') }}" id="markAllAsRead"
                            class="quick-btn">{{ __('Mark All as Read') }}</a>
                    </div>
                    <ul class="list-group">
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
            </div>
        </div>

@endsection
@push('scripts')
    <script src="{{ asset('js/chart-loader.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        document.getElementById('markAllAsRead').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link action

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
                        // Update the notification badge to 0 or remove unread notification styling
                        document.querySelectorAll('.notification-item').forEach(item => item.classList.remove(
                            'list-group-item-primary'));
                        document.querySelector('.badge').innerText = '0';
                    }
                });
        });
    </script>
@endpush
