@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Winner</h1>

        <form method="POST" action="{{ route('winners.store') }}">
            @csrf

            <div class="form-group">
                <label for="quiz_id">Quiz ID:</label>
                <input type="number" name="quiz_id" id="quiz_id" class="form-control">
            </div>

            <div class="form-group">
                <label for="first_winner">First Winner:</label>
                <input type="text" name="first_winner" id="first_winner" class="form-control">
            </div>

            <div class="form-group">
                <label for="second_winner">Second Winner:</label>
                <input type="text" name="second_winner" id="second_winner" class="form-control">
            </div>

            <div class="form-group">
                <label for="third_winner">Third Winner:</label>
                <input type="text" name="third_winner" id="third_winner" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Create Winner</button>
        </form>
    </div>
@endsection
