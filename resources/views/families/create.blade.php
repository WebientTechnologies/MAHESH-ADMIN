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
                                            <input type="text" name="head_first_name" class="form-control" id="head_first_name" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="head_middle_name">{{ __('Middle Name') }}</label>
                                            <input type="text" name="head_middle_name" class="form-control" id="head_middle_name">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="head_last_name">{{ __('Last Name') }}</label>
                                            <input type="text" name="head_last_name" class="form-control" id="head_last_name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="gender">{{ __('Gender') }}</label>
                                            <select name="gender" class="form-control" id="gender" required>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>  
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="marital_status">{{ __('Marital Status') }}</label>
                                            <select name="marital_status" class="form-control" id="marital_status" required>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Divorced">Divorced</option>
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
                                            <select name="head_occupation" class="form-control" id="head_occupation" required>
                                                <option value="Student">Student</option>
                                                <option value="Profession">Profession</option>
                                                <option value="Business">Business</option>
                                                <option value="Private Service">Private Service</option>
                                                <option value="Goverment Service">Goverment Service</option>
                                                <option value="Home Maker">Home Maker</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="head_mobile_number">{{ __('Mobile Number') }}</label>
                                            <input type="text" name="head_mobile_number" class="form-control" id="head_mobile_number"  required maxlength="10">
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
                                            <select name="relationship_with_head" class="form-control" id="relationship_with_head" required>
                                                <option value="Self">Self</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="qualification">{{ __('Qualification') }}</label>
                                            <select name="qualification" class="form-control" id="qualification" required>
                                                <option value="Primary School">Primary School</option>
                                                <option value="High School">High School</option>
                                                <option value="Junior College">Junior College</option>
                                                <option value="Under-Graduate">Under-Graduate</option>
                                                <option value="Bachelors">Bachelors</option>
                                                <option value="Masters">Masters</option>
                                                <option value="Doctoral">Doctoral</option>
                                                <option value="CA">CA</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="degree">{{ __('Degree') }}</label>
                                            <select name="degree" class="form-control" id="degree" required>
                                                <option value="Matricuation">Matricuation</option>
                                                <option value="I.Sc">I.Sc</option>
                                                <option value="I.Com">I.Com</option>
                                                <option value="I.A.">I.A.</option>
                                                <option value="B.A">B.A</option>
                                                <option value="B.Sc">B.Sc</option>
                                                <option value="B.COm">B.COm</option>
                                                <option value="Engineering">Engineering</option>
                                                <option value="Doctorate">Doctorate</option>
                                                <option value="MBA">MBA</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <textarea type="text" name="address" class="form-control" id="address" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="head_image">{{ __('Head Image') }}</label>
                                <input type="file" name="head_image" class="form-control-file" id="head_image">
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
                                                     <input type="text" name="members[0][first_name]" class="form-control" id="member_first_name_0" required> 
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_middle_name_0">{{ __(' Middle Name') }}</label>
                                                    <input type="text" name="members[0][middle_name]" class="form-control" id="member_middle_name_0">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_last_name_0">{{ __(' Last Name') }}</label>
                                                    <input type="text" name="members[0][last_name]" class="form-control" id="member_last_name_0" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="member_gender_0">{{ __('Gender') }}</label>
                                                    <select name="members[0][gender]" class="form-control" id="member_gender_0" required>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>

                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_marital_status_0">{{ __('Marital Status') }}</label>
                                                    <select name="members[0][marital_status]" class="form-control" id="member_marital_status_0" required>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Divorced">Divorced</option>
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
                                                    <select name="members[0][occupation]" class="form-control" id="member_occupation_0" required>
                                                        <option value="Student">Student</option>
                                                        <option value="Profession">Profession</option>
                                                        <option value="Business">Business</option>
                                                        <option value="Private Service">Private Service</option>
                                                        <option value="Goverment Service">Goverment Service</option>
                                                        <option value="Home Maker">Home Maker</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_mobile_number_0">{{ __('Mobile Number') }}</label>
                                                    <input type="text" name="members[0][mobile_number]" class="form-control" id="member_mobile_number_0" required maxlength="10">
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
                                                    <select name="members[0][relationship_with_head]" class="form-control" id="member_relationship_with_head_0" required>
                                                        <option value="Self">Self</option>
                                                        <option value="Son">Son</option>
                                                        <option value="Grand Son">Grandson</option>
                                                        <option value="Daughter">Daughter</option>
                                                        <option value="Grand Daughter">Grand Daughter</option>
                                                        <option value="Wife">Wife</option>
                                                        <option value="Brother">Brother</option>
                                                        <option value="Sister">Sister</option>
                                                        <option value="Uncle">Uncle</option>
                                                    </select>
                                                        
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_qualification_0">{{ __('Qualification') }}</label>
                                                    <select name="members[0][qualification]" class="form-control" id="member_qualification_0" required>
                                                        <option value="Primary School">Primary School</option>
                                                        <option value="High School">High School</option>
                                                        <option value="Junior College">Junior College</option>
                                                        <option value="Under-Graduate">Under-Graduate</option>
                                                        <option value="Bachelors">Bachelors</option>
                                                        <option value="Masters">Masters</option>
                                                        <option value="Doctoral">Doctoral</option>
                                                        <option value="CA">CA</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                       
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="member_degree_0">{{ __('Degree') }}</label>
                                                    <select name="members[0][degree]" class="form-control" id="member_degree_0" required>
                                                        <option value="Matricuation">Matricuation</option>
                                                        <option value="I.Sc">I.Sc</option>
                                                        <option value="I.Com">I.Com</option>
                                                        <option value="I.A.">I.A.</option>
                                                        <option value="B.A">B.A</option>
                                                        <option value="B.Sc">B.Sc</option>
                                                        <option value="B.COm">B.COm</option>
                                                        <option value="Engineering">Engineering</option>
                                                        <option value="Doctorate">Doctorate</option>
                                                        <option value="MBA">MBA</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                       
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <label for="member_address_0">{{ __('Address') }}</label>
                                                    <input type="text" name="members[0][address]" class="form-control" id="member_address_0" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="same_address_0">{{ __('Choose Address Same as Family Head') }}</label>
                                                    <input type="checkbox" name="members[0][same_address]" class="form-control" id="same_address_0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="member_image_0">{{ __('Member Image') }}</label>
                                            <input type="file" name="members[0][image]" class="form-control-file" id="member_image_0">
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
    
@endsection
