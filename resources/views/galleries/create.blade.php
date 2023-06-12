@extends('layouts.app')

@section('content')
<style>
    .required-field:after {
        content: "*";
        color: red;
        margin-left: 5px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload Image or Video') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="album_name" class="col-md-4 col-form-label text-md-right">{{ __('Album Name') }} <span class="required-field"></span></label>

                            <div class="col-md-6">
                                <input id="album_name" type="text" class="form-control" name="album_name" value="{{ old('album_name') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="event_name" class="col-md-4 col-form-label text-md-right">{{ __('Event Name') }} <span class="required-field"></span></label>

                            <div class="col-md-6">
                                <input id="event_name" type="text" class="form-control" name="event_name" value="{{ old('event_name') }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="description" class="col-md-4 control-label text-md-right">{{ __('Description') }} <span class="required-field"></span></label>
                                <div class="col-md-6">
                                    <textarea id="description" class="form-control" name="description" required>{{ old('description') }}</textarea>
                                </div>
                            
                            </div>

                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('File') }} <span class="required-field"></span></label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control" name="file[]" accept="image/*,video/*" multiple required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload') }}
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
