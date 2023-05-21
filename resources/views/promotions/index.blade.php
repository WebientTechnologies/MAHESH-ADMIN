@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Promotions
        <a href="{{ route('promotions.create') }}" class="btn btn-primary btn-sm float-right">Add Promotion</a></h1>
        <div class="row">
                     <div class="row">
                            <div class="col-md-12 mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search">
                            </div>
                    </div>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Thumbnail</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Link</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($promotions as $promotion)
                         <tr class="promotion-row">
                            <td>{{ $promotion['id'] }}</td>
                            <td><img src="{{ $promotion['file'] }}" width="50"></td>
                            <td>{{ $promotion['start_date'] }}</td>
                            <td>{{ $promotion['end_date'] }}</td>
                            <td><a href="{{ $promotion['link'] }}" target="_blank">{{ $promotion['link'] }}</a></td>
                            <td>{{ $promotion['created_at'] }}</td>
                            <td>
                                <a href="{{ route('promotions.edit', $promotion['id']) }}"><i class="fa fa-edit"></i></a>
                                <form action="{{ route('promotions.destroy', $promotion['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:void(0)" onclick="if (confirm('Are you sure you want to delete this News?')) { $(this).closest('form').submit(); } else { return false; }">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7">No promotions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $media->links() }}
            </div>
        </div>
    </div>
    @section('scripts')
    <script>
        $(document).ready(function() {
            debugger;
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('.promotion-row').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection
@endsection
