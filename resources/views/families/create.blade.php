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
                                            <input type="text" name="head_middle_name" class="form-control" id="head_middle_name" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="head_last_name">{{ __('Last Name') }}</label>
                                            <input type="text" name="head_last_name" class="form-control" id="head_last_name" required>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="head_occupation">{{ __('Occupation') }}</label>
                                    <input type="text" name="head_occupation" class="form-control" id="head_occupation" required>
                                </div>

                                <div class="form-group">
                                    <label for="head_mobile_number">{{ __('Mobile Number') }}</label>
                                    <input type="text" name="head_mobile_number" class="form-control" id="head_mobile_number" required>
                                </div>

                            <div class="form-group">
                                <label for="head_dob">{{ __('Date of Birth') }}</label>
                                <input type="text" name="head_dob" class="form-control" id="head_dob" required>
                            </div>

                               <hr>

                                <h5>{{ __('Members Details') }}</h5>
                                <div id="members_section">
                                    <div class="member-form">
                                    <hr>
                                        <h6><b>MEMBER</b></h6>
                                        <div class="form-group">                                         
                                            <label for="member_name_0">{{ __(' Name') }}</label>
                                            <input type="text" name="members[0][name]" class="form-control" id="member_name_0" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="member_occupation_0">{{ __(' Occupation') }}</label>
                                            <input type="text" name="members[0][occupation]" class="form-control" id="member_occupation_0" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="member_mobile_number_0">{{ __(' Mobile Number') }}</label>
                                            <input type="text" name="members[0][mobile_number]" class="form-control" id="member_mobile_number_0" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="member_age_0">{{ __(' Age') }}</label>
                                            <input type="number" name="members[0][age]" class="form-control" id="member_age_0" required>
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

                newMemberForm.find('input').each(function() {
                    var inputName = $(this).attr('name').replace('[0]', '[' + nextMemberIndex + ']');
                    $(this).attr('name', inputName);
                    $(this).val('');
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
@endsection
