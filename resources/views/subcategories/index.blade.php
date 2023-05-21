@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Subcategories') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ route('subcategories.create') }}" class="btn btn-primary">{{ __('Add Subcategory') }}</a>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-12 mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search">
                            </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subCategories as $subcategory)
                                    <tr class="subcategory-row">
                                        <td>{{ $subcategory->name }}</td>
                                        <td>{{ $subcategory->category->name }}</td>
                                        <td>{{ $subcategory->created_at->format('d/m/Y') }}</td>
                                        <td style = "display: inline-flex; width:100%; gap:40%">
                                            <a href="{{ route('subcategories.edit', $subcategory->id) }}" ><i class="fa fa-edit"></i> </a>
                                            <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST">
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
</div>
@section('scripts')
    <script>
        $(document).ready(function() {
            debugger;
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('.subcategory-row').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection
@endsection
