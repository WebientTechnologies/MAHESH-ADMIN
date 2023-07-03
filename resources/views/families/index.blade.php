@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                    <a class="nav-link{{ request('tab') !== 'members' ? ' active' : '' }}" id="families-tab" data-toggle="tab" href="#families">Families</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link{{ request('tab') === 'members' ? ' active' : '' }}" id="members-tab" data-toggle="tab" href="#members">Members</a>
                    </li>
                </ul>


                <div class="tab-content">
                    <div class="tab-pane fade{{ request('tab') !== 'members' ? ' show active' : '' }}" id="families">
                        <div class="card">
                            <div class="card-header" style="height: 56px;">{{ __('Families') }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('families.create') }}" class="btn btn-primary float-right" style="margin-top: -27px;">Create Family</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('members.create') }}" class="btn btn-primary float-right" style="margin-top: -37px; margin-right: -376px">Add Member</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                            <div class="mb-3">
                                <form action="{{ route('families.index') }}" method="GET" class="form-inline">
                                    <div class="form-group mr-2">
                                        <input type="text" name="search" class="form-control" placeholder="Search by Name" value="{{ request('search') }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="{{ route('families.index') }}" class="btn btn-secondary ml-2">Reset</a>
                                </form>
                                <a href="{{ route('families.exportExcel') }}"  class="btn btn-success float-right" style="margin-top: -27px;">Export Data</a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Family Id</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Total Family Members</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($families as $family)
                                        <tr class="family-row">
                                            
                                            <td>{{ $family->id }}</td>
                                            <td>{{ $family->head_first_name }} {{ $family->head_middle_name }} {{ $family->head_last_name}}</td>
                                            <td>{{ $family->head_mobile_number }}</td>
                                            <td>
                        
                                                <a href="#" onclick="showFamilyMembers({{ $family->id }})">
                                                    {{ $family->members_count }}
                                                </a>
                                            </td>
                                            <td style = "display: inline-flex; gap:70%;">
                                                <a href="{{ route('families.edit', $family->id) }}" ><i class="fa fa-edit"></i> </a>
                                                <form action="{{ route('families.destroy', $family->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="javascript:void(0)" onclick="if (confirm('Are you sure you want to delete this Family?')) { $(this).closest('form').submit(); } else { return false; }">
                                                    <i class="fa fa-trash"></i> 
                                                </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $families->appends(['tab' => ''])->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade{{ request('tab') === 'members' ? ' show active' : '' }}" id="members">
                        <input type="hidden" name="tab" value="members">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <form action="{{ route('families.index') }}" method="GET" class="form-inline">
                                        <input type="hidden" name="tab" value="members">
                                        <div class="form-group mr-2">
                                            <input type="text" name="search" class="form-control" placeholder="Search by Name" value="{{ request('search') }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ route('families.index') }}" class="btn btn-secondary ml-2">Reset</a>
                                    </form>
                                </div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile Number</th>
                                            <th>Relationship</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fmembers as $member)
                                            <tr>
                                                <td>{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</td>
                                                <td>{{ $member->mobile_number }}</td>
                                                <td>{{ $member->relationship_with_head }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $fmembers->appends(['tab' => 'members'])->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            
                
            </div>
        </div>
    </div>

<div id="familyMembersModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <table class="table table-bordered table-striped">>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Dob</th>
                    <th>Mobile</th>
                    <th>Occupation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="familyMembersTableBody">
            </tbody>
        </table>
    </div>
</div>

<script>
    function showFamilyMembers(familyId) {
        debugger;
        var modal = document.getElementById("familyMembersModal");
        var span = document.getElementsByClassName("close")[0];

        $.get('/family-members/'+familyId, function(data) {
            var familyMembers = data.familyMembers;

            var tableBody = document.getElementById("familyMembersTableBody");
            tableBody.innerHTML = '';

            familyMembers.forEach(function(familyMember) {
                var tr = document.createElement('tr');
                tr.innerHTML = '<td>'+ familyMember.first_name + ' ' + (familyMember.middle_name ? familyMember.middle_name + ' ' : '') + familyMember.last_name +'</td><td>' + familyMember.dob + '</td><td>' + familyMember.mobile_number + '</td><td>' + familyMember.occupation +'</td><td><a href="/members/' + familyMember.id + '/edit"><i class="fa fa-edit"></i></a><a onclick="deleteFamilyMember(' + familyMember.id + ')"><i class="fa fa-trash"></i></a></td>';
                tableBody.appendChild(tr);
            });

            modal.style.display = "block";
        });

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
</script>

<script>
    function deleteFamilyMember(memberId) {
        var confirmation = confirm('Are you sure you want to delete this family member?');
        if (confirmation) {
            // Get the CSRF token value
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Set up the AJAX request with CSRF token header
            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', '/delete-members/' + memberId);
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            xhr.setRequestHeader('Content-Type', 'application/json');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Handle success, such as removing the deleted row from the table
                    alert('Family member deleted successfully');
                } else {
                    // Handle error if deletion fails
                    alert('Family member deleted successfully');
                }
            };

            xhr.send();
        }
    }
</script>

<script>
    $(document).ready(function() {
        debugger;
        // Set the active tab based on query parameter 'tab'
        var activeTab = '{{ request()->query('tab') }}';

        if (activeTab === 'members') {
            console.log(activeTab);
            $('#members-tab').tab('show');
        } else {
            console.log(activeTab);
            $('#families-tab').tab('show');
        }
        
        // Update the active tab when a new tab is clicked
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var tab = $(e.target).attr('href');
            var tabParam = tab === '#members' ? 'members' : '';
            history.replaceState(null, null, '?tab=' + tabParam);
        });
    });
</script>


@endsection


@push('styles')
    <style>
        table.table-bordered {
            border: 1px solid #dee2e6;
            margin-top: 20px;
        }

        table.table-bordered th,
        table.table-bordered td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        table.table-bordered thead th {
            background-color: #f2f2f2;
        }

        table.table-bordered thead th:first-child,
        table.table-bordered td:first-child {
            border-left: 0;
        }

        table.table-bordered thead th:last-child,
        table.table-bordered td:last-child {
            border-right: 0;
        }
    </style>
@endpush
