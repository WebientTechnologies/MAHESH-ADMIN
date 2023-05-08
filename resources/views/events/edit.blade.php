@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Event</h1>
        <form method="POST" action="{{ route('events.update', $event->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $event->title }}" required autocomplete="title" autofocus>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="description">{{ $event->description }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="event_start_at">{{ __('Event Start At') }}</label>
                <input id="event_start_at" type="datetime-local" class="form-control @error('event_start_at') is-invalid @enderror" name="event_start_at" value="{{ date('Y-m-d\TH:i', strtotime($event->event_start_at)) }}" required>
                @error('event_start_at')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="event_end_at">{{ __('Event End At') }}</label>
                <input id="event_end_at" type="datetime-local" class="form-control @error('event_end_at') is-invalid @enderror" name="event_end_at" value="{{ date('Y-m-d\TH:i', strtotime($event->event_end_at)) }}" required>
                @error('event_end_at')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save') }}
                </button>
                <a href="{{ route('events.index') }}" class="btn btn-secondary">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
@endsection
