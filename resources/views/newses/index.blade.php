@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        News List
                        <a href="{{ route('newses.create') }}" class="btn btn-primary btn-sm float-right">Add News</a>
                    </div> 
                    <div class="card-body">
                    <div class="mb-3">
                        <form action="{{ route('newses.index') }}" method="GET" class="form-inline">
                            <div class="form-group mr-2">
                                <input type="text" name="search" class="form-control" placeholder="Search....." value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('newses.index') }}" class="btn btn-secondary ml-2">Reset</a>
                        </form>
                    </div>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($newses as $news)
                                    <tr class="news-row">
                                        <td>{{ $news->title }}</td>
                                        <td>{{ $news->description }}</td>
                                        <td>{{ $news->created_at }}</td>
                                        <td style = "display: inline-flex; gap:70%;">
                                            <a href="{{ route('newses.edit', $news->id) }}" ><i class="fa fa-edit"></i> </a>
                                            <form action="{{ route('newses.destroy', $news->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="javascript:void(0)" onclick="if (confirm('Are you sure you want to delete this News?')) { $(this).closest('form').submit(); } else { return false; }">
                                                <i class="fa fa-trash"></i> 
                                            </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $newses->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
