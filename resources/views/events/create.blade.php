@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Event</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('events.store') }}"  enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description" required>{{ old('description') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('event_start_at') ? ' has-error' : '' }}">
                                <label for="event_start_at" class="col-md-4 control-label">Start Date and Time</label>

                                <div class="col-md-6">
                                    <input id="event_start_at" type="datetime-local" class="form-control" name="event_start_at" value="{{ old('event_start_at') }}" required>

                                    @if ($errors->has('event_start_at'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('event_start_at') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('event_end_at') ? ' has-error' : '' }}">
                                <label for="event_end_at" class="col-md-4 control-label">End Date and Time</label>

                                <div class="col-md-6">
                                    <input id="event_end_at" type="datetime-local" class="form-control" name="event_end_at" value="{{ old('event_end_at') }}" required>

                                    @if ($errors->has('event_end_at'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('event_end_at') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="file">File</label>
                                 <input id="file" type="file" class="form-control" name="file[]" accept="image/*,video/*" multiple required>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
