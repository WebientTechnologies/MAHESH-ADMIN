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
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search">
                            </div>
                    </div>
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
                                    <tr class="winner-row">
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
    @section('scripts')
    <script>
        $(document).ready(function() {
            debugger;
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('.winner~-row').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection
@endsection
