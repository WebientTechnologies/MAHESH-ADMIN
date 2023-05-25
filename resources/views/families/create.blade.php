@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Create Family') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('families.store') }}">
                                @csrf
                                <h6><b>Family Head</b></h6>
                                <hr>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="head_first_name">{{ __('First Name') }}</label>
                                            <input type="text" name="head_first_name" class="form-control" id="head_first_name">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="head_middle_name">{{ __('Middle Name') }}</label>
                                            <input type="text" name="head_middle_name" class="form-control" id="head_middle_name">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="head_last_name">{{ __('Last Name') }}</label>
                                            <input type="text" name="head_last_name" class="form-control" id="head_last_name">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="gender">{{ __('Gender') }}</label>
                                            <select name="gender" class="form-control" id="gender" >
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>  
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="marital_status">{{ __('Marital Status') }}</label>
                                            <select name="marital_status" class="form-control" id="marital_status" >
                                                <option value="">Select Marital Status</option>
                                                @foreach ($maritals as $marital)
                                                    <option value="{{ $marital->name }}">{{ $marital->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="date_of_anniversary">{{ __('Date of Anniversary') }}</label>
                                            <input type="text" name="date_of_anniversary" class="form-control" id="date_of_anniversary">
                                                        
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="head_occupation">{{ __('Occupation') }}</label>
                                            <select name="head_occupation" class="form-control" id="head_occupation" >
                                                <option value="">Select Occupation</option>
                                                @foreach ($occupations as $occup)
                                                    <option value="{{ $occup->name }}">{{ $occup->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="head_mobile_number">{{ __('Mobile Number') }}</label>
                                            <input type="text" name="head_mobile_number" class="form-control" id="head_mobile_number" maxlength="10">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="head_dob">{{ __('Date of Birth') }}</label>
                                            <input type="text" name="head_dob" class="form-control" id="head_dob" >
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="relationship_with_head">{{ __('Relationship With Head') }}</label>
                                            <select name="relationship_with_head" class="form-control" id="relationship_with_head" >
                                                <option value="Self">Self</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="qualification">{{ __('Qualification') }}</label>
                                            <select name="qualification" class="form-control" id="qualification" >
                                                <option value="">Select Qualification</option>
                                                @foreach ($qualifications as $qualification)
                                                    <option value="{{ $qualification->name }}">{{ $qualification->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="degree">{{ __('Degree') }}</label>
                                            <select name="degree" class="form-control" id="degree" >
                                                    <option value="">Select Degree</option>
                                                @foreach ($degrees as $degree)
                                                    <option value="{{ $degree->name }}">{{ $degree->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <textarea type="text" name="address" class="form-control" id="address" ></textarea>
                            </div>

                               <hr>

                                <h5>{{ __('Members Details') }}</h5>
                                <div id="members_section">
                                    <div class="member-form">
                                    <hr>
                                        <h6><b>MEMBER</b></h6>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="member_first_name_0">{{ __(' First Name') }}</label>
                                                     <input type="text" name="members[0][first_name]" class="form-control" id="member_first_name_0" > 
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_middle_name_0">{{ __(' Middle Name') }}</label>
                                                    <input type="text" name="members[0][middle_name]" class="form-control" id="member_middle_name_0">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_last_name_0">{{ __(' Last Name') }}</label>
                                                    <input type="text" name="members[0][last_name]" class="form-control" id="member_last_name_0" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="member_gender_0">{{ __('Gender') }}</label>
                                                    <select name="members[0][gender]" class="form-control" id="member_gender_0" >
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>

                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_marital_status_0">{{ __('Marital Status') }}</label>
                                                    <select name="members[0][marital_status]" class="form-control" id="member_marital_status_0" >
                                                        <option value="">Select Marital Status</option>
                                                        @foreach ($maritals as $marital)
                                                            <option value="{{ $marital->name }}">{{ $marital->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_date_of_anniversary_0">{{ __('Date of Anniversary') }}</label>
                                                    <input type="text" name="members[0][date_of_anniversary]" class="form-control" id="member_date_of_anniversary_0">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="member_occupation_0">{{ __('Occupation') }}</label>
                                                    <select name="members[0][occupation]" class="form-control" id="member_occupation_0" >
                                                        <option value="">Select Occupation</option>
                                                        @foreach ($occupations as $occup)
                                                            <option value="{{ $occup->name }}">{{ $occup->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_mobile_number_0">{{ __('Mobile Number') }}</label>
                                                    <input type="text" name="members[0][mobile_number]" class="form-control" id="member_mobile_number_0"  maxlength="10">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_dob_0">{{ __('Date of Birth') }}</label>
                                                    <input type="text" name="members[0][dob]" class="form-control" id="member_dob_0">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="member_relationship_with_head_0">{{ __(' Relationship With Head') }}</label>
                                                    <select name="members[0][relationship_with_head]" class="form-control" id="member_relationship_with_head_0" >
                                                            <option value="">Select Relation</option>
                                                        @foreach ($relationships as $relation)
                                                            <option value="{{ $relation->name }}">{{ $relation->name }}</option>
                                                        @endforeach
                                                    </select>
                                                        
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_qualification_0">{{ __('Qualification') }}</label>
                                                    <select name="members[0][qualification]" class="form-control" id="member_qualification_0" >
                                                            <option value="">Select Qualification</option>
                                                        @foreach ($qualifications as $qualification)
                                                            <option value="{{ $qualification->name }}">{{ $qualification->name }}</option>
                                                        @endforeach
                                                    </select>
                                                       
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_degree_0">{{ __('Degree') }}</label>
                                                    <select name="members[0][degree]" class="form-control" id="member_degree_0" >
                                                            <option value="">Select Degree</option>
                                                        @foreach ($degrees as $degree)
                                                            <option value="{{ $degree->name }}">{{ $degree->name }}</option>
                                                        @endforeach
                                                    </select>
                                                       
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <label for="member_address_0">{{ __('Address') }}</label>
                                                    <input type="text" name="members[0][address]" class="form-control" id="member_address_0" >
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="same_address_0">{{ __('Choose Address Same as Family Head') }}</label>
                                                    <input type="checkbox" name="members[0][same_address]" class="form-control" id="same_address_0">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary" id="add_member_button">{{ __('Add Member') }}</button>
                                <button type="submit" class="btn btn-primary">{{ __('Create Family') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script>
        $(document).ready(function() {
            var nextMemberIndex = 1;

            $('#add_member_button').click(function() {
                var newMemberForm = $('.member-form').first().clone();

                var subheading = $('<h5>').text('Member ' + (nextMemberIndex + 1));
                subheading.insertAfter(newMemberForm);

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

            $(document).on('change', 'input[type="checkbox"][name^="members"][name$="[same_address]"]', function() {
                var checkbox = $(this);
                var addressInput = checkbox.closest('.form-group').find('input[name^="members"][name$="[address]"]');

                if (checkbox.is(':checked')) {
                    addressInput.val($('#address').val()); // Copy family head's address
                    addressInput.prop('readonly', true); // Make the address input readonly
                } else {
                    addressInput.val(''); // Clear the copied address
                    addressInput.prop('readonly', false); // Make the address input editable
                }
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
    <script>
        $('#date_of_anniversary').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
    <script>
        $('#member_date_of_anniversary_0').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>

<script>
    const maritalStatusSelect = document.getElementById('marital_status');
    const anniversaryInput = document.getElementById('date_of_anniversary');

    maritalStatusSelect.addEventListener('change', function() {
        if (maritalStatusSelect.value === 'Married') {
            anniversaryInput.disabled = false;
        } else {
            anniversaryInput.disabled = true;
            anniversaryInput.value = ''; // Clear the value if disabled
        }
    });
</script>

<script>
    const maritalStatus = document.getElementById('member_marital_status_0');
    const anniversary = document.getElementById('member_date_of_anniversary_0');

    maritalStatus.addEventListener('change', function() {
        if (maritalStatus.value === 'Married') {
            anniversary.disabled = false;
        } else {
            anniversary.disabled = true;
            anniversary.value = ''; // Clear the value if disabled
        }
    });
</script>
    
@endsection
