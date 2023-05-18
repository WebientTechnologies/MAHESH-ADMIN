@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Business List
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <a href="{{ route('businesses.create') }}" class="btn btn-primary float-right" style="margin-top: -27px;">Create Business</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Business Name</th>
                                    <th>Owner Name</th>
                                    <th>Contact Number</th>
                                    <th>Category</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($businesses as $business)
                                    <tr>
                                        <td>{{ $business->id }}</td>
                                        <td>{{ $business->business_name }}</td>
                                        <td>{{ $business->owner_name }}</td>
                                        <td>{{ $business->contact_number }}</td>
                                        <td>{{ $business->category->name }}</td>
                                        <td>{{ $business->address }}</td>
                                        <td style = "display: inline-flex; gap:70%;">
                                            <a href="{{ route('businesses.edit', $business->id) }}" ><i class="fa fa-edit"></i> </a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
