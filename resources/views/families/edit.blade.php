@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Family') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('families.update', $family->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="head_first_name">{{ __('First Name') }}</label>
                                        <input type="text" name="head_first_name" class="form-control" id="head_first_name" value="{{ $family->head_first_name }}" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="head_middle_name">{{ __('Middle Name') }}</label>
                                        <input type="text" name="head_middle_name" class="form-control" id="head_middle_name" value="{{ $family->head_middle_name }}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="head_last_name">{{ __('Last Name') }}</label>
                                        <input type="text" name="head_last_name" class="form-control" id="head_last_name" value="{{ $family->head_last_name }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="head_occupation">{{ __('Occupation') }}</label>
                                            <input type="text" name="head_occupation" class="form-control" id="head_occupation" value="{{ $family->head_occupation }}" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="head_mobile_number">{{ __('Mobile Number') }}</label>
                                            <input type="text" name="head_mobile_number" class="form-control" id="head_mobile_number" value="{{ $family->head_mobile_number }}" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="head_dob">{{ __('Date of Birth') }}</label>
                                            <input type="text" name="head_dob" class="form-control" id="head_dob" value="{{ $family->head_dob }}" >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="relationship_with_head">{{ __('Relationship With Head') }}</label>
                                            <input type="text" name="relationship_with_head" class="form-control" id="relationship_with_head" value="{{ $family->relationship_with_head }}"  required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="qualification">{{ __('Qualification') }}</label>
                                            <input type="text" name="qualification" class="form-control" id="qualification" value="{{ $family->qualification }}" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="degree">{{ __('Degree') }}</label>
                                             <input type="text" name="degree" class="form-control" id="degree" value="{{ $family->degree }}" required>
                                        </div>
                                    </div>
                                </div>

                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <textarea type="text" name="address" class="form-control" id="address" value="{{ $family->address }}" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="marital_status">{{ __('Marital Status') }}</label>
                                <input type="text" name="marital_status" class="form-control" id="marital_status" value="{{ $family->marital_status }}" required>
                            </div>


                            <hr>

                            <h5>{{ __('Members Details') }}</h5>
                            <div id="members_section">
                            @php
                            $memberIndex = 0;
                            @endphp

                            @foreach($family->members as $member)
                            <div class="member-form">
                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="member_first_name_0">{{ __(' First Name') }}</label>
                                                     <input type="text" name="members[0][first_name]" class="form-control" id="member_first_name_0" value="{{ $member->first_name }}" required> 
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_middle_name_0">{{ __(' Middle Name') }}</label>
                                                    <input type="text" name="members[0][middle_name]" class="form-control" id="member_middle_name_0" value="{{ $member->middle_name }}">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_last_name_0">{{ __(' Last Name') }}</label>
                                                    <input type="text" name="members[0][last_name]" class="form-control" id="member_last_name_0" value="{{ $member->last_name }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="member_occupation_0">{{ __('Occupation') }}</label>
                                                    <input type="text" name="members[0][occupation]" class="form-control" id="member_occupation_0" value="{{ $member->occupation }}" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_mobile_number_0">{{ __('Mobile Number') }}</label>
                                                    <input type="text" name="members[0][mobile_number]" class="form-control" id="member_mobile_number_0" value="{{ $member->mobile_number }}" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_dob_0">{{ __('Date of Birth') }}</label>
                                                    <input type="text" name="members[0][dob]" class="form-control" id="member_dob_0" value="{{ $member->dob}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="member_relationship_with_head_0">{{ __(' Relationship With Head') }}</label>
                                                    <input type="text" name="members[0][relationship_with_head]" class="form-control" id="member_relationship_with_head_0" value="{{ $member->relationship_with_head }}" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_qualification_0">{{ __('Qualification') }}</label>
                                                    <input type="text" name="members[0][qualification]" class="form-control" id="member_qualification_0" value="{{ $member->qualification }}" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_degree_0">{{ __('Degree') }}</label>
                                                    <input type="text" name="members[0][degree]" class="form-control" id="member_degree_0" value="{{ $member->degree }}" required>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="form-group">
                                        <label for="member_address_0">{{ __('Address') }}</label>
                                        <textarea type="text" name="members[0][address]" class="form-control" id="member_address_0" value="{{ $member->address }}" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="member_marital_status_0">{{ __('Marital Status') }}</label>
                                        <input type="text" name="members[0][marital_status]" class="form-control" id="member_marital_status_0" value="{{ $member->marital_status }}" required>
                                    </div>
                                 

                                <button type="button" class="btn btn-danger" onclick="$(this).closest('.member-form').remove()">{{ __('Delete Member') }}</button>
                            </div>
                            @php
                                $memberIndex++;
                            @endphp
                            @endforeach


                                <button type="button" class="btn btn-primary" id="add_member_button">{{ __('Add Member') }}</button>
                                <button type="submit" class="btn btn-primary">{{ __('Update Family') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#add_member_button').click(function() {
                var newMemberForm = $('.member-form').first().clone();
                var newIndex = $('.member-form').length;

                newMemberForm.find('input').each(function() {
                    var inputName = $(this).attr('name').replace(/\[(\d+)\]/, '[' + newIndex + ']');
                    $(this).attr('name', inputName);
                    $(this).val('');
                });

                newMemberForm.appendTo('#members_section');
            });
        </script>
         <script>
            $('#head_dob').datepicker({
                format: 'yyyy-mm-dd'
            });
        </script>
        <script>
        $('#member_dob_0').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection
