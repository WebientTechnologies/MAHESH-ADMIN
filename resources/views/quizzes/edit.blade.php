@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Quiz</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('quizzes.update', $quiz->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="title">Quiz Title:</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $quiz->title) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Quiz Description:</label>
                                <textarea name="description" class="form-control" required>{{ old('description', $quiz->description) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="start_time">Quiz Start Time:</label>
                                <input type="datetime-local" name="start_time" class="form-control" value="{{ old('start_time', $quiz->start_time->format('Y-m-d\TH:i:s')) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="end_time">Quiz End Time:</label>
                                <input type="datetime-local" name="end_time" class="form-control" value="{{ old('end_time', $quiz->end_time->format('Y-m-d\TH:i:s')) }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Quiz</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
