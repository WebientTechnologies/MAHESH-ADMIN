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
                                            <select name="head_occupation" class="form-control" id="head_occupation" required>
                                                <option value="Student" @if($family->head_occupation == 'Student') selected @endif>Student</option>
                                                <option value="Profession" @if($family->head_occupation == 'Profession') selected @endif>Profession</option>
                                                <option value="Business" @if($family->head_occupation == 'Business') selected @endif>Business</option>
                                                <option value="Private Service" @if($family->head_occupation == 'Private Service') selected @endif>Private Service</option>
                                                <option value="Government Service" @if($family->head_occupation == 'Government Service') selected @endif>Government Service</option>
                                                <option value="Home Maker" @if($family->head_occupation == 'Home Maker') selected @endif>Home Maker</option>
                                                <option value="Other" @if($family->head_occupation == 'Other') selected @endif>Other</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="head_mobile_number">{{ __('Mobile Number') }}</label>
                                            <input type="text" name="head_mobile_number" class="form-control" id="head_mobile_number" value="{{ $family->head_mobile_number }}" required maxlength="10">
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
                                            <select name="qualification" class="form-control" id="qualification" required>
                                                <option value="Primary School" {{ $family->qualification == 'Primary School' ? 'selected' : '' }}>Primary School</option>
                                                <option value="High School" {{ $family->qualification == 'High School' ? 'selected' : '' }}>High School</option>
                                                <option value="Junior College" {{ $family->qualification == 'Junior College' ? 'selected' : '' }}>Junior College</option>
                                                <option value="Under-Graduate" {{ $family->qualification == 'Under-Graduate' ? 'selected' : '' }}>Under-Graduate</option>
                                                <option value="Bachelors" {{ $family->qualification == 'Bachelors' ? 'selected' : '' }}>Bachelors</option>
                                                <option value="Masters" {{ $family->qualification == 'Masters' ? 'selected' : '' }}>Masters</option>
                                                <option value="Doctoral" {{ $family->qualification == 'Doctoral' ? 'selected' : '' }}>Doctoral</option>
                                                <option value="CA" {{ $family->qualification == 'CA' ? 'selected' : '' }}>CA</option>
                                                <option value="Other" {{ $family->qualification == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="degree">{{ __('Degree') }}</label>
                                            <select name="degree" class="form-control" id="degree" required>
                                                <option value="Matricuation" @if($family->degree == 'Matricuation') selected @endif>Matricuation</option>
                                                <option value="I.Sc" @if($family->degree == 'I.Sc') selected @endif>I.Sc</option>
                                                <option value="I.Com" @if($family->degree == 'I.Com') selected @endif>I.Com</option>
                                                <option value="I.A." @if($family->degree == 'I.A.') selected @endif>I.A.</option>
                                                <option value="B.A" @if($family->degree == 'B.A') selected @endif>B.A</option>
                                                <option value="B.Sc" @if($family->degree == 'B.Sc') selected @endif>B.Sc</option>
                                                <option value="B.COm" @if($family->degree == 'B.COm') selected @endif>B.COm</option>
                                                <option value="Engineering" @if($family->degree == 'Engineering') selected @endif>Engineering</option>
                                                <option value="Doctorate" @if($family->degree == 'Doctorate') selected @endif>Doctorate</option>
                                                <option value="MBA" @if($family->degree == 'MBA') selected @endif>MBA</option>
                                                <option value="Other" @if($family->degree == 'Other') selected @endif>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <textarea type="text" name="address" class="form-control" id="address" value="{{ $family->address }}" required>{{$family->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="marital_status">{{ __('Marital Status') }}</label>
                                <select name="marital_status" class="form-control" id="marital_status" required>
                                    <option value="Single" @if($family->marital_status == 'Single') selected @endif>Single</option>
                                    <option value="Married" @if($family->marital_status == 'Married') selected @endif>Married</option>
                                    <option value="Divorced" @if($family->marital_status == 'Divorced') selected @endif>Divorced</option>
                                </select>
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
                                                    <select name="members[0][occupation]" class="form-control" id="member_occupation_0" required>
                                                        <option value="Student" @if($member['occupation'] == 'Student') selected @endif>Student</option>
                                                        <option value="Profession" @if($member['occupation'] == 'Profession') selected @endif>Profession</option>
                                                        <option value="Business" @if($member['occupation'] == 'Business') selected @endif>Business</option>
                                                        <option value="Private Service" @if($member['occupation'] == 'Private Service') selected @endif>Private Service</option>
                                                        <option value="Government Service" @if($member['occupation'] == 'Government Service') selected @endif>Government Service</option>
                                                        <option value="Home Maker" @if($member['occupation'] == 'Home Maker') selected @endif>Home Maker</option>
                                                        <option value="Other" @if($member['occupation'] == 'Other') selected @endif>Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_mobile_number_0">{{ __('Mobile Number') }}</label>
                                                    <input type="text" name="members[0][mobile_number]" class="form-control" id="member_mobile_number_0" value="{{ $member->mobile_number }}" required maxlength="10">
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
                                                    <select name="members[0][relationship_with_head]" class="form-control" id="member_relationship_with_head_0" required>
                                                        <option value="Self" @if($member['relationship_with_head'] == 'Self') selected @endif>Self</option>
                                                        <option value="Son" @if($member['relationship_with_head'] == 'Son') selected @endif>Son</option>
                                                        <option value="Grand Son" @if($member['relationship_with_head'] == 'Grand Son') selected @endif>Grandson</option>
                                                        <option value="Daughter" @if($member['relationship_with_head'] == 'Daughter') selected @endif>Daughter</option>
                                                        <option value="Grand Daughter" @if($member['relationship_with_head'] == 'Grand Daughter') selected @endif>Grand Daughter</option>
                                                        <option value="Wife" @if($member['relationship_with_head'] == 'Wife') selected @endif>Wife</option>
                                                        <option value="Brother" @if($member['relationship_with_head'] == 'Brother') selected @endif>Brother</option>
                                                        <option value="Sister" @if($member['relationship_with_head'] == 'Sister') selected @endif>Sister</option>
                                                        <option value="Uncle" @if($member['relationship_with_head'] == 'Uncle') selected @endif>Uncle</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_qualification_0">{{ __('Qualification') }}</label>
                                                    <select name="members[0][qualification]" class="form-control" id="member_qualification_0" required>
                                                        <option value="Primary School" @if($family->members[0]['qualification'] == 'Primary School') selected @endif>Primary School</option>
                                                        <option value="High School" @if($family->members[0]['qualification'] == 'High School') selected @endif>High School</option>
                                                        <option value="Junior College" @if($family->members[0]['qualification'] == 'Junior College') selected @endif>Junior College</option>
                                                        <option value="Under-Graduate" @if($family->members[0]['qualification'] == 'Under-Graduate') selected @endif>Under-Graduate</option>
                                                        <option value="Bachelors" @if($family->members[0]['qualification'] == 'Bachelors') selected @endif>Bachelors</option>
                                                        <option value="Masters" @if($family->members[0]['qualification'] == 'Masters') selected @endif>Masters</option>
                                                        <option value="Doctoral" @if($family->members[0]['qualification'] == 'Doctoral') selected @endif>Doctoral</option>
                                                        <option value="CA" @if($family->members[0]['qualification'] == 'CA') selected @endif>CA</option>
                                                        <option value="Other" @if($family->members[0]['qualification'] == 'Other') selected @endif>Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_degree_0">{{ __('Degree') }}</label>
                                                    <select name="members[0][degree]" class="form-control" id="member_degree_0" required>
                                                        <option value="Matricuation" @if($family->members[0]['degree'] == 'Matricuation') selected @endif>Matricuation</option>
                                                        <option value="I.Sc" @if($family->members[0]['degree'] == 'I.Sc') selected @endif>I.Sc</option>
                                                        <option value="I.Com" @if($family->members[0]['degree'] == 'I.Com') selected @endif>I.Com</option>
                                                        <option value="I.A." @if($family->members[0]['degree'] == 'I.A.') selected @endif>I.A.</option>
                                                        <option value="B.A" @if($family->members[0]['degree'] == 'B.A') selected @endif>B.A</option>
                                                        <option value="B.Sc" @if($family->members[0]['degree'] == 'B.Sc') selected @endif>B.Sc</option>
                                                        <option value="B.COm" @if($family->members[0]['degree'] == 'B.COm') selected @endif>B.COm</option>
                                                        <option value="Engineering" @if($family->members[0]['degree'] == 'Engineering') selected @endif>Engineering</option>
                                                        <option value="Doctorate" @if($family->members[0]['degree'] == 'Doctorate') selected @endif>Doctorate</option>
                                                        <option value="MBA" @if($family->members[0]['degree'] == 'MBA') selected @endif>MBA</option>
                                                        <option value="Other" @if($family->members[0]['degree'] == 'Other') selected @endif>Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="form-group">
                                        <label for="member_address_0">{{ __('Address') }}</label>
                                        <textarea type="text" name="members[0][address]" class="form-control" id="member_address_0" value="{{ $member->address }}" required>{{ $member->address}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="member_marital_status_0">{{ __('Marital Status') }}</label>
                                        <select name="members[0][marital_status]" class="form-control" id="member_marital_status_0" required>
                                            <option value="Single" {{ $family->members[0]['marital_status'] == 'Single' ? 'selected' : '' }}>Single</option>
                                            <option value="Married" {{ $family->members[0]['marital_status'] == 'Married' ? 'selected' : '' }}>Married</option>
                                            <option value="Divorced" {{ $family->members[0]['marital_status'] == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                        </select>
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
