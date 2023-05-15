@extends('layouts.app')

@section('content')
    <!-- <div class="card">
        <div class="card-header">
           
            <a href="https://docs.google.com/forms/d/15fEu07kDJZCMxkRx041i6HHtisDvVpWa_lTaZQZjScM/edit" target="_blank" class="btn btn-primary">Create/Update Quiz</a>
        </div>
        <div class="card-body">
            <iframe src="https://docs.google.com/forms/d/15fEu07kDJZCMxkRx041i6HHtisDvVpWa_lTaZQZjScM/viewform?embedded=true" width="100%" height="1000" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
        </div>
    </div> -->
    <div class="container">
        <h1>Quize
        <a href="{{ route('quizzes.create') }}" class="btn btn-primary btn-sm float-right">Add Quize</a></h1>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Thumbnail</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Link</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($quizes as $quiz)
                        <tr>
                            <td>{{ $quiz['id'] }}</td>
                            <td><img src="{{ $quiz['file'] }}" width="50"></td>
                            <td>{{ $quiz['start_time'] }}</td>
                            <td>{{ $quiz['end_time'] }}</td>
                            <td><a href="{{ $quiz['link'] }}" target="_blank">{{ $quiz['link'] }}</a></td>
                            <td>{{ $quiz['description'] }}</td>
                            <td>
                                <a href="{{ route('quizzes.edit', $quiz['id']) }}"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('quizzes.destroy', $quiz['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:void(0)" onclick="if (confirm('Are you sure you want to delete this News?')) { $(this).closest('form').submit(); } else { return false; }">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7">No quizes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $media->links() }}
            </div>
        </div>
    </div>
@endsection
