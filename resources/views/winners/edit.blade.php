@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Winner</h1>

        <form method="POST" action="{{ route('winners.update', $winner->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="quiz_id">Quiz ID:</label>
                <input type="number" name="quiz_id" id="quiz_id" class="form-control" value="{{ $winner->quiz_id }}">
            </div>

            <div class="form-group">
                <label for="first_winner">First Winner:</label>
                <input type="text" name="first_winner" id="first_winner" class="form-control" value="{{ $winner->first_winner }}">
            </div>

            <div class="form-group">
                <label for="second_winner">Second Winner:</label>
                <input type="text" name="second_winner" id="second_winner" class="form-control" value="{{ $winner->second_winner }}">
            </div>

            <div class="form-group">
                <label for="third_winner">Third Winner:</label>
                <input type="text" name="third_winner" id="third_winner" class="form-control" value="{{ $winner->third_winner }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Winner</button>
        </form>
    </div>
@endsection
