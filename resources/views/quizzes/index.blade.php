<!-- index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-3">
            <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Create Quiz</a>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#all-quiz">All Quiz</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#upcoming-quiz">Upcoming Quiz</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#completed-quiz">Completed Quiz</a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div id="all-quiz" class="tab-pane fade show active">
                <h4>All Quiz</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                        <a href="{{ route('quizzes.edit', $quiz['id']) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('quizzes.destroy', $quiz['id']) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Quiz?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No quizzes found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $media->links() }}
            </div>
            <div id="upcoming-quiz" class="tab-pane fade">
                <h4>Upcoming Quiz</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
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
                            @forelse ($quizes->where('start_time', '>', now()) as $quiz)
                                <tr>
                                    <td>{{ $quiz['id'] }}</td>
                                    <td><img src="{{ $quiz['file'] }}" width="50"></td>
                                    <td>{{ $quiz['start_time'] }}</td>
                                    <td>{{ $quiz['end_time'] }}</td>
                                    <td><a href="{{ $quiz['link'] }}" target="_blank">{{ $quiz['link'] }}</a></td>
                                    <td>{{ $quiz['description'] }}</td>
                                    <td>
                                        <a href="{{ route('quizzes.edit', $quiz['id']) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('quizzes.destroy', $quiz['id']) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Quiz?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No upcoming quizzes found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="completed-quiz" class="tab-pane fade">
                <h4>Completed Quiz</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
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
                            @forelse ($quizes->where('end_time', '<', now()) as $quiz)
                                <tr>
                                    <td>{{ $quiz['id'] }}</td>
                                    <td><img src="{{ $quiz['file'] }}" width="50"></td>
                                    <td>{{ $quiz['start_time'] }}</td>
                                    <td>{{ $quiz['end_time'] }}</td>
                                    <td><a href="{{ $quiz['link'] }}" target="_blank">{{ $quiz['link'] }}</a></td>
                                    <td>{{ $quiz['description'] }}</td>
                                    <td>
                                        <a href="{{ route('quizzes.edit', $quiz['id']) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('quizzes.destroy', $quiz['id']) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Quiz?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No completed quizzes found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
