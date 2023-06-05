@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Occupation List
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <a href="{{ route('businesses.create') }}" class="btn btn-primary float-right" style="margin-top: -27px;">Create Occupation</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <form action="{{ route('businesses.index') }}" method="GET" class="form-inline">
                            <div class="form-group mr-2">
                                <input type="text" name="search" class="form-control" placeholder="Search by Occupation Name" value="{{ request('search') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('businesses.index') }}" class="btn btn-secondary ml-2">Reset</a>
                        </form>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Occupation Name</th>
                                <th>Owner Name</th>
                                <th>Contact Number</th>
                                <th>Category</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($businesses as $business)
                            <tr class="business-row">
                                <td>{{ $business->business_name }}</td>
                                <td>{{ $business->owner_name }}</td>
                                <td>{{ $business->contact_number }}</td>
                                <td>{{ $business->category->name }}</td>
                                <td>{{ $business->address }}</td>
                                <td style="display: inline-flex; gap:70%;">
                                    <a href="{{ route('businesses.edit', $business->id) }}"><i class="fa fa-edit"></i> </a>
                                    <form action="{{ route('businesses.destroy', $business->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="javascript:void(0)" onclick="if (confirm('Are you sure you want to delete this Business?')) { $(this).closest('form').submit(); } else { return false; }">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $businesses->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
