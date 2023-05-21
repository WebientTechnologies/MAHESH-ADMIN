

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
                    <div class="row">
                            <div class="col-md-12 mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search">
                            </div>
                    </div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
    <script>
        $(document).ready(function() {
            debugger;
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('.event-row').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection
@endsection
