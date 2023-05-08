@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{ $quiz->title }}
            </div>
            <div class="card-body">
                <p>{{ $quiz->description }}</p>
                <p>Start Time: {{ $quiz->start_time }}</p>
                <p>End Time: {{ $quiz->end_time }}</p>
            </div>
        </div>
    </div>
@endsection
