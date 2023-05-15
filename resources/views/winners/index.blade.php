<!-- resources/views/winners/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Winners</div>

                    <div class="card-body">
                        <a href="{{ route('winners.create') }}" class="btn btn-primary mb-3">Create New Winner</a>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Quiz ID</th>
                                    <th>First Winner</th>
                                    <th>Second Winner</th>
                                    <th>Third Winner</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($winners as $winner)
                                    <tr>
                                        <td>{{ $winner->quiz_id }}</td>
                                        <td>{{ $winner->first_winner }}</td>
                                        <td>{{ $winner->second_winner }}</td>
                                        <td>{{ $winner->third_winner }}</td>
                                        <td>
                                            <a href="{{ route('winners.edit', $winner->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('winners.destroy', $winner->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this winner?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
