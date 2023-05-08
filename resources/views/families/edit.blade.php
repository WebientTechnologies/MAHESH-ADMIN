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
                                        <input type="text" name="head_middle_name" class="form-control" id="head_middle_name" value="{{ $family->head_middle_name }}" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="head_last_name">{{ __('Last Name') }}</label>
                                        <input type="text" name="head_last_name" class="form-control" id="head_last_name" value="{{ $family->head_last_name }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="head_occupation">{{ __('Family Head Occupation') }}</label>
                                <input type="text" name="head_occupation" class="form-control" id="head_occupation" value="{{ $family->head_occupation }}" required>
                            </div>

                            <div class="form-group">
                                <label for="head_mobile_number">{{ __('Family Head Mobile Number') }}</label>
                                <input type="text" name="head_mobile_number" class="form-control" id="head_mobile_number" value="{{ $family->head_mobile_number }}" required>
                            </div>

                            <div class="form-group">
                                <label for="head_dob">{{ __('Date of Birth') }}</label>
                                <input type="text" name="head_dob" class="form-control" id="head_dob" value="{{ $family->head_dob }}" required>
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
                                    <label for="member_name_{{ $memberIndex }}">{{ __('Member Name') }}</label>
                                    <input type="text" name="members[{{ $memberIndex }}][name]" class="form-control" id="member_name_{{ $memberIndex }}" value="{{ $member->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="member_occupation_{{ $memberIndex }}">{{ __('Member Occupation') }}</label>
                                    <input type="text" name="members[{{ $memberIndex }}][occupation]" class="form-control" id="member_occupation_{{ $memberIndex }}" value="{{ $member->occupation }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="member_mobile_number_{{ $memberIndex }}">{{ __('Member Mobile Number') }}</label>
                                    <input type="text" name="members[{{ $memberIndex }}][mobile_number]" class="form-control" id="member_mobile_number_{{ $memberIndex }}" value="{{ $member->mobile_number }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="member_age_{{ $memberIndex }}">{{ __('Member Age') }}</label>
                                    <input type="number" name="members[{{ $memberIndex }}][age]" class="form-control" id="member_age_{{ $memberIndex }}" value="{{ $member->age }}" required>
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
@endsection
