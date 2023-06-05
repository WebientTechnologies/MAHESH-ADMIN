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
        <h1>Create Promotion</h1>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('quizzes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title <span class="required-field"></label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">File <span class="required-field"></label>
                        <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" accept="image/*" required>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time <span class="required-field"></label>
                        <input type="datetime-local" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" required>
                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="end_time">End Time <span class="required-field"></label>
                        <input type="datetime-local" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" required>
                        @error('end_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link">Link <span class="required-field"></label>
                        <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror" required>
                        @error('link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description <span class="required-field"></label>
                        <textarea type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" required></textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
