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
                            <div class="member-form" data-index="0">
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
                                                    <input name="members[0][occupation]" class="form-control" id="member_occupation_0" value="{{ $member->occupation }}" required>
                                                       
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
                                                    <input name="members[0][relationship_with_head]" class="form-control" id="member_relationship_with_head_0" value="{{ $member->relationship_with_head }}" required>
                                                       
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_qualification_0">{{ __('Qualification') }}</label>
                                                    <input name="members[0][qualification]" class="form-control" id="member_qualification_0" value="{{ $member->qualification }}" required>
                                                       
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_degree_0">{{ __('Degree') }}</label>
                                                    <input name="members[0][degree]" class="form-control" id="member_degree_0" value="{{ $member->degree }}" required>
                                                      
                                                </div>
                                            </div>
                                        </div>

                                    <div class="form-group">
                                        <label for="member_address_0">{{ __('Address') }}</label>
                                        <input type="text" name="members[0][address]" class="form-control" id="member_address_0" value="{{ $member->address }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="member_marital_status_0">{{ __('Marital Status') }}</label>
                                        <input name="members[0][marital_status]" class="form-control" id="member_marital_status_0" value="{{ $member->marital_status }}" required>
                                           
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
                var lastMemberForm = $('.member-form').last();
                var lastMemberIndex = parseInt(lastMemberForm.data('index'));
                var newMemberIndex = lastMemberIndex + 1;

                var newMemberForm = lastMemberForm.clone();

                newMemberForm.find('input').each(function() {
                    var inputName = $(this).attr('name').replace(/\[(\d+)\]/, '[' + newMemberIndex + ']');
                    $(this).attr('name', inputName);
                    $(this).val('');
                });

                newMemberForm.data('index', newMemberIndex);
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
