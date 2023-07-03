@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Family') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('families.update', $family->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="head_first_name">{{ __('First Name') }}</label>
                                        <input type="text" name="head_first_name" class="form-control" id="head_first_name" value="{{ $family->head_first_name }}" >
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="head_middle_name">{{ __('Middle Name') }}</label>
                                        <input type="text" name="head_middle_name" class="form-control" id="head_middle_name" value="{{ $family->head_middle_name }}">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="head_last_name">{{ __('Last Name') }}</label>
                                        <input type="text" name="head_last_name" class="form-control" id="head_last_name" value="{{ $family->head_last_name }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="head_occupation">{{ __('Occupation') }}</label>
                                            <select name="head_occupation" class="form-control" id="head_occupation">
                                                <option value="">Select Occupation</option>
                                                @foreach ($occupations as $occup)
                                                    <option value="{{ $occup->name }}" @if ($occup->name == $family->head_occupation) selected @endif>{{ $occup->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="head_mobile_number">{{ __('Mobile Number') }}</label>
                                            <input type="text" name="head_mobile_number" class="form-control" id="head_mobile_number" value="{{ $family->head_mobile_number }}"  maxlength="10">
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
                                            <label for="gender">{{ __('Gender') }}</label>
                                            <select name="gender" class="form-control" id="gender" >
                                                <option value="Male" @if($family->gender == 'Male') selected @endif>Male</option>
                                                <option value="Female" @if($family->gender == 'Female') selected @endif>Female</option>
                                                <option value="Other" @if($family->gender == 'Other') selected @endif>Other</option>
                                            </select>  
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="marital_status">{{ __('Marital Status') }}</label>
                                            <select name="marital_status" class="form-control" id="marital_status" >
                                                <option value="">Select Marital Status</option>
                                                @foreach ($maritals as $marital)
                                                <option value="{{ $marital->name }}" @if ($marital->name == $family->marital_status) selected @endif>{{ $marital->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="date_of_anniversary">{{ __('Date of Anniversary') }}</label>
                                            <input type="text" name="date_of_anniversary" class="form-control" id="date_of_anniversary" value="{{ $family->date_of_anniversary }}">
                                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="relationship_with_head">{{ __('Relationship With Head') }}</label>
                                            <input type="text" name="relationship_with_head" class="form-control" id="relationship_with_head" value="{{ $family->relationship_with_head }}"  >
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="qualification">{{ __('Qualification') }}</label>
                                            <select name="qualification" class="form-control" id="qualification" >
                                                <option value="">Select Qualification</option>
                                                @foreach ($qualifications as $qualification)
                                                    <option value="{{ $qualification->name }}" @if ($qualification->name == $family->qualification) selected @endif>{{ $qualification->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="degree">{{ __('Degree') }}</label>
                                            <select name="degree" class="form-control" id="degree" >
                                            <option value="">Select Degree</option>
                                                @foreach ($degrees as $degree)
                                                    <option value="{{ $degree->name }}" @if ($degree->name == $family->degree) selected @endif>{{ $degree->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <textarea type="text" name="address" class="form-control" id="address" value="{{ $family->address }}">{{$family->address }}</textarea>
                            </div>


                            <hr>

                            <h5>{{ __('Members Details') }}</h5>
                            <div id="members_section">
                            @php
                            $memberIndex = 0;
                            @endphp

                            @foreach($family->members as $index => $member)
                            <div class="member-form" data-index="{{ $index }}">
                                <div class="form-group">
                                <input type="hidden" name="members[{{ $index }}][id]" value="{{ $member->id }}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="member_first_name_{{ $index }}">{{ __('First Name') }}</label>
                                            <input type="text" name="members[{{ $index }}][first_name]" class="form-control" id="member_first_name_{{ $index }}" value="{{ $member['first_name'] }}">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="member_middle_name_{{ $index }}">{{ __('Middle Name') }}</label>
                                            <input type="text" name="members[{{ $index }}][middle_name]" class="form-control" id="member_middle_name_{{ $index }}" value="{{ $member['middle_name'] }}">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="member_last_name_{{ $index }}">{{ __('Last Name') }}</label>
                                            <input type="text" name="members[{{ $index }}][last_name]" class="form-control" id="member_last_name_{{ $index }}" value="{{ $member['last_name'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="member_gender_{{ $index }}">{{ __('Gender') }}</label>
                                            <select name="members[{{ $index }}][gender]" class="form-control" id="member_gender_{{ $index }}">
                                                <option value="Male" {{ $member['gender'] == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $member['gender'] == 'Female' ? 'selected' : '' }}>Female</option>
                                                <option value="Other" {{ $member['gender'] == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="member_marital_status_{{ $index }}">{{ __('Marital Status') }}</label>
                                            <select name="members[{{ $index }}][marital_status]" class="form-control" id="member_marital_status_{{ $index }}">
                                                <option value="">Select Marital Status</option>
                                                @foreach ($maritals as $marital)
                                                    <option value="{{ $marital->name }}" {{ $marital->name == $member['marital_status'] ? 'selected' : '' }}>{{ $marital->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="member_date_of_anniversary_{{ $index }}">{{ __('Date of Anniversary') }}</label>
                                            <input type="text" name="members[{{ $index }}][date_of_anniversary]" class="form-control" id="member_date_of_anniversary_{{ $index }}" value="{{ $member['date_of_anniversary'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="member_occupation_{{ $index }}">{{ __('Occupation') }}</label>
                                            <select name="members[{{ $index }}][occupation]" class="form-control" id="member_occupation_{{ $index }}">
                                                <option value="">Select Occupation</option>
                                                @foreach ($occupations as $occup)
                                                    <option value="{{ $occup->name }}" {{ $occup->name == $member['occupation'] ? 'selected' : '' }}>{{ $occup->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="member_mobile_number_{{ $index }}">{{ __('Mobile Number') }}</label>
                                            <input type="text" name="members[{{ $index }}][mobile_number]" class="form-control" id="member_mobile_number_{{ $index }}" value="{{ $member['mobile_number'] }}" maxlength="10">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="member_dob_{{ $index }}">{{ __('Date of Birth') }}</label>
                                            <input type="text" name="members[{{ $index }}][dob]" class="form-control" id="member_dob_{{ $index }}" value="{{ $member['dob'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="member_relationship_with_head_{{ $index }}">{{ __('Relationship With Head') }}</label>
                                            <select name="members[{{ $index }}][relationship_with_head]" class="form-control" id="member_relationship_with_head_{{ $index }}">
                                                <option value="">Select Relation</option>
                                                @foreach ($relationships as $relation)
                                                    <option value="{{ $relation->name }}" {{ $relation->name == $member['relationship_with_head'] ? 'selected' : '' }}>{{ $relation->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="member_qualification_{{ $index }}">{{ __('Qualification') }}</label>
                                            <select name="members[{{ $index }}][qualification]" class="form-control" id="member_qualification_{{ $index }}">
                                                <option value="">Select Qualification</option>
                                                @foreach ($qualifications as $qualification)
                                                    <option value="{{ $qualification->name }}" {{ $qualification->name == $member['qualification'] ? 'selected' : '' }}>{{ $qualification->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="member_degree_{{ $index }}">{{ __('Degree') }}</label>
                                            <select name="members[{{ $index }}][degree]" class="form-control" id="member_degree_{{ $index }}">
                                                <option value="">Select Degree</option>
                                                @foreach ($degrees as $degree)
                                                    <option value="{{ $degree->name }}" {{ $degree->name == $member['degree'] ? 'selected' : '' }}>{{ $degree->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="member_address_{{ $index }}">{{ __('Address') }}</label>
                                    <input type="text" name="members[{{ $index }}][address]" class="form-control" id="member_address_{{ $index }}" value="{{ $member['address'] }}">
                                </div>
                                 
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
    $(document).ready(function() {
        var nextMemberIndex = {{ $family->members->count() }};

        $('#add_member_button').click(function() {
            var newMemberForm = $('.member-form').first().clone();
            var memberId = 'member_' + nextMemberIndex; // Unique identifier for each member form

            var subheading = $('<h5>').text('Member ' + (nextMemberIndex + 1));
            subheading.insertAfter(newMemberForm);

            newMemberForm.attr('data-index', nextMemberIndex); // Use 'data-index' instead of 'id' attribute

            newMemberForm.find('input, select').each(function() {
                var inputName = $(this).attr('name').replace('[0]', '[' + nextMemberIndex + ']');
                $(this).attr('name', inputName);
                $(this).val('');

                if ($(this).attr('name').includes('[last_name]')) {
                    var headLastName = $('#head_last_name').val();
                    $(this).val(headLastName);
                }
            });

            $('.member-form').last().after($('<hr>'));
            newMemberForm.appendTo('#members_section');
            nextMemberIndex++;
        });
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
