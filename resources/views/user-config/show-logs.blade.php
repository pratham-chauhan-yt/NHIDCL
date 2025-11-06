@extends('layouts.dashboard')
@section('dashboard_content')
<div class="container">
    <h4>Log File: {{ $filename }}</h4>
    <div style="max-height: 75vh; overflow-y: auto; background-color: #1e1e1e; color: #d4d4d4; font-family: monospace; padding: 10px;">
        <pre>{{ $content }}</pre>
    </div>

    @if($hasMore)
        <form method="GET" action="{{ route('users.logs.show') }}">
            <input type="hidden" name="filename" value="{{ $filename }}">
            <input type="hidden" name="page" value="{{ $page + 1 }}">
            <button type="submit" class="btn btn-primary mt-2">Load Previous Lines</button>

            <a href="{{ route('users.logs.clear') }}" 
                class="btn btn-danger"
                onclick="return confirm('Are you sure you want to clear this log file?')">
                Clear Log
            </a>
        </form>
    @endif
</div>
@endsection
