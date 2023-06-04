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
                <form action="{{ route('promotions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">File <span class="required-field"></label>
                        <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" accept="image/*" required>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date <span class="required-field"></label>
                        <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date <span class="required-field"></label>
                        <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" required>
                        @error('end_date')
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
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
