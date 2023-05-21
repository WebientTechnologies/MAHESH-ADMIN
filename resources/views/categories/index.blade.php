@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Business Categories') }}
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <a href="{{ route('categories.create') }}" class="btn btn-primary float-right" style="margin-top: -27px;">Create Category</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr class="category-row">
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td style = "display: inline-flex; gap:70%;">
                                            <a href="{{ route('categories.edit', $category->id) }}" ><i class="fa fa-edit"></i> </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="javascript:void(0)" onclick="if (confirm('Are you sure you want to delete this Category?')) { $(this).closest('form').submit(); } else { return false; }">
                                                <i class="fa fa-trash"></i> 
                                            </a>
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
                $('.category-row').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection
@endsection
