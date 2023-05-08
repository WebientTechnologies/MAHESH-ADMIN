@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Member to Family {{ $family->name }}</h1>

        <form method="POST" action="{{ route('families.member.store', $family) }}">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="occupation">Occupation:</label>
                <input type="text" name="occupation" id="occupation" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" name="age" id="age" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="mobile_number">Mobile Number:</label>
                <input type="text" name="mobile_number" id="mobile_number" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
