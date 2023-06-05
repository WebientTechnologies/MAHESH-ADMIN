

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        News List
                        <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm float-right">Add Event</a>
                    </div>
                    <div class="card-body">
                        
                    <div class="mb-3">
                        <form action="{{ route('events.index') }}" method="GET" class="form-inline">
                            <div class="form-group mr-2">
                                <input type="text" name="search" class="form-control" placeholder="Search....." value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('events.index') }}" class="btn btn-secondary ml-2">Reset</a>
                        </form>
                    </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                    <tr class="event-row">
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->description }}</td>
                                        <td>{{ $event->event_start_at}}</td>
                                        <td>{{ $event->event_end_at}}</td>
                                        <td>{{ $event->created_at }}</td>
                                        
                                        <td style = "display: inline-flex; gap:70%;">
                                            <a href="{{ route('events.edit', $event->id) }}" ><i class="fa fa-edit"></i> </a>
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="javascript:void(0)" onclick="if (confirm('Are you sure you want to delete this Event?')) { $(this).closest('form').submit(); } else { return false; }">
                                                <i class="fa fa-trash"></i> 
                                            </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $events->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
