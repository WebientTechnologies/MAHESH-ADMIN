@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $family->head_name }}</h1>
        <p>Occupation: {{ $family->head_occupation }}</p>
        <p>Mobile Number: {{ $family->head_mobile_number }}</p>

        <h2>Members</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Occupation</th>
                    <th>Age</th>
                    <th>Mobile Number</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($family->members as $member)
                    <tr>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->occupation }}</td>
                        <td>{{ $member->age }}</td>
                        <td>{{ $member->mobile_number }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('families.edit', $family) }}" class="btn btn-primary">Edit Family</a>
    </div>
@endsection
