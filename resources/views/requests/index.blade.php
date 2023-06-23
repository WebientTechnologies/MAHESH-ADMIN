@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Requests</h1>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#new-requests">New Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#approved-requests">Approved Requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#rejected-requests">Rejected Requests</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="new-requests">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Column Name</th>
                            <th>Old Image</th>
                            <th>New Image</th>
                            <th>Member Name</th>
                            <th>Head Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            @if ($request->status == 'pending')
                                <tr>
                                    <td>{{ $request->column_name }}</td>
                                    <td>
                                        @if ($request->old_value_link)
                                            <img src="{{ $request->old_value_link }}" width="50" alt="Old Value Image">
                                        @else
                                            {{ $request->old_value }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($request->new_value_link)
                                            <img src="{{ $request->new_value_link }}" width="50" alt="New Value Image">
                                        @else
                                            {{ $request->new_value }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($request->member)
                                            {{ $request->member->first_name }} {{ $request->member->middle_name }} {{ $request->member->last_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($request->head)
                                            {{ $request->head->head_first_name }} {{ $request->head->head_middle_name }} {{ $request->head->head_last_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $request->status }}</td>
                                    <td>
                                        @if ($request->status == 'pending')
                                        <form action="{{ route('requests.update', ['request' => $request->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="btn-group" role="group" aria-label="Request Actions">
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </div>

                                        </form>
                                        <form action="{{ route('requests.update', ['request' => $request->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="btn-group" role="group" aria-label="Request Actions">
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </div>
                                        </form>
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="approved-requests">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Column Name</th>
                            <th>Old Image</th>
                            <th>New Image</th>
                            <th>Member Name</th>
                            <th>Head Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            @if ($request->status == 'approved')
                                <tr>
                                    <td>{{ $request->column_name }}</td>
                                    <td>
                                        @if ($request->old_value_link)
                                            <img src="{{ $request->old_value_link }}" width="50" alt="Old Value Image">
                                        @else
                                            {{ $request->old_value }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($request->new_value_link)
                                            <img src="{{ $request->new_value_link }}" width="50" alt="New Value Image">
                                        @else
                                            {{ $request->new_value }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($request->member)
                                            {{ $request->member->first_name }} {{ $request->member->middle_name }} {{ $request->member->last_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($request->head)
                                            {{ $request->head->head_first_name }} {{ $request->head->head_middle_name }} {{ $request->head->head_last_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $request->status }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="rejected-requests">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Column Name</th>
                            <th>Old Image</th>
                            <th>New Image</th>
                            <th>Member Name</th>
                            <th>Head Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            @if ($request->status == 'rejected')
                                <tr>
                                    <td>{{ $request->column_name }}</td>
                                    <td>
                                        @if ($request->old_value_link)
                                            <img src="{{ $request->old_value_link }}" width="50" alt="Old Value Image">
                                        @else
                                            {{ $request->old_value }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($request->new_value_link)
                                            <img src="{{ $request->new_value_link }}" width="50" alt="New Value Image">
                                        @else
                                            {{ $request->new_value }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($request->member)
                                            {{ $request->member->first_name }} {{ $request->member->middle_name }} {{ $request->member->last_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        @if ($request->head)
                                            {{ $request->head->head_first_name }} {{ $request->head->head_middle_name }} {{ $request->head->head_last_name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $request->status }}</td>
                                    <td>
                                        @if ($request->status == 'rejected')
                                        <form action="{{ route('requests.update', ['request' => $request->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="btn-group" role="group" aria-label="Request Actions">
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </div>

                                        </form>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
