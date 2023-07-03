@extends('layouts.app')

@section('content')
<style>
    .required-field:after {
        content: "*";
        color: red;
        margin-left: 5px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Family Member</div>
                <form method="POST" action="{{ route('members.update', ['family' => $family, 'member' => $member]) }}">

                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="family_id">Family Head:</label>
                        <select id="family_id" name="family_id" class="form-control select2">
                            <option value="">Select Family Head</option>
                            @foreach($family as $f)
                            <option value="{{ $f->id }}" {{ $f->id == $member->family_id ? 'selected' : '' }}>
                                {{ $f->head_first_name }} {{ $f->head_first_name }} {{ $f->head_last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="first_name">{{ __('First Name') }}</label>
                                <input type="text" name="first_name" class="form-control" id="first_name"
                                    value="{{ $member->first_name }}">
                            </div>
                            <div class="col-sm-4">
                                <label for="middle_name">{{ __('Middle Name') }}</label>
                                <input type="text" name="middle_name" class="form-control" id="middle_name"
                                    value="{{ $member->middle_name }}">
                            </div>
                            <div class="col-sm-4">
                                <label for="last_name">{{ __('Last Name') }}</label>
                                <input type="text" name="last_name" class="form-control" id="last_name"
                                    value="{{ $member->last_name }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="gender">{{ __('Gender') }}</label>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="Male" {{ $member->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $member->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ $member->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="marital_status">{{ __('Marital Status') }}</label>
                                <select name="marital_status" class="form-control" id="marital_status">
                                    <option value="">Select Marital Status</option>
                                    @foreach ($maritals as $marital)
                                        <option value="{{ $marital->name }}" {{ $marital->name == $member->marital_status ? 'selected' : '' }}>{{ $marital->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="date_of_anniversary">{{ __('Date of Anniversary') }}</label>
                                <input type="date" name="date_of_anniversary" class="form-control" id="date_of_anniversary"
                                    value="{{ $member->date_of_anniversary }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="occupation">{{ __('Occupation') }}</label>
                                <select name="occupation" class="form-control" id="occupation">
                                    <option value="">Select Occupation</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}" {{ $category->name == $member->occupation ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                    <input type="hidden" name="category_id" id="category_id">
                                    <input type="text" name="occupation_other" class="form-control other-field" id="occupation_other" style="display: none;">
                            </div>
                            <div class="col-sm-4">
                                <label for="sub_occupation">Sub Occupation:</label>
                                <select name="sub_occupation" class="form-control" id="sub_occupation">
                                    <option value="">Select Sub Occupation</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->name }}" {{ $subcategory->name == $member->sub_occupation ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                                    <input type="hidden" name="subcategory_id" id="sub_category_id">
                            </div>
                            <div class="col-sm-4">
                                <label for="mobile_number">{{ __('Mobile Number') }}</label>
                                <input type="text" name="mobile_number" class="form-control" id="mobile_number"
                                    maxlength="10" value="{{ $member->mobile_number }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="relationship_with_head">{{ __('Relationship With Head') }}</label>
                                <select name="relationship_with_head" class="form-control" id="relationship_with_head">
                                    <option value="">Select Relation</option>
                                    @foreach ($relationships as $relation)
                                        <option value="{{ $relation->name }}" {{ $relation->name == $member->relationship_with_head ? 'selected' : '' }}>{{ $relation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="qualification">{{ __('Qualification') }}</label>
                                <select name="qualification" class="form-control" id="qualification">
                                    <option value="">Select Qualification</option>
                                    @foreach ($qualifications as $qualification)
                                        <option value="{{ $qualification->name }}" {{ $qualification->name == $member->qualification ? 'selected' : '' }}>{{ $qualification->name }}</option>
                                    @endforeach
                                </select>
                                    <input type="text" name="qualification_other" class="form-control other-field" id="qualification_other" style="display: none;">
                            </div>
                            <div class="col-sm-4">
                                <label for="degree">{{ __('Degree') }}</label>
                                <select name="degree" class="form-control" id="degree">
                                    <option value="">Select Degree</option>
                                    @foreach ($degrees as $degree)
                                        <option value="{{ $degree->name }}" {{ $degree->name == $member->degree ? 'selected' : '' }}>{{ $degree->name }}</option>
                                    @endforeach
                                </select>
                                    <input type="text" name="degree_other" class="form-control other-field" id="degree_other" style="display: none;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="address">{{ __('Address') }}</label>
                                <textarea type="text" name="address" class="form-control"
                                    id="address">{{ $member->address }}</textarea>
                            </div>
                            <div class="col-sm-6">
                                <label for="dob">Date of Birth:</label>
                                <input type="date" name="dob" class="form-control" id="dob"
                                    value="{{ $member->dob }}">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#occupation').on('change', function() {
    var category = $(this).val();

    if (category) {
        $.ajax({
            url: '{{ route('subcategories', ['category' => '']) }}/' + category,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#sub_occupation').empty();
                if (data.length > 0) {
                    $('#sub_occupation').append('<option value="">Select Sub Occupation</option>');
                    $.each(data, function(key, value) {
                        $('#sub_occupation').append('<option value="' + value.name + '" data-sub-category-id="' + value.id + '">' + value.name + '</option>');
                    });
                } else {
                    $('#sub_occupation').append('<option value="">No Sub Occupation Found</option>');
                }
            }
        });
    } else {
        $('#sub_occupation').empty();
    }
});
    
</script>

<script>
$(document).ready(function() {
    
  $('#family_id').on('change', function() {
    var familyId = $(this).val(); 
    var selectedFamily = $('option:selected', this).text(); 
    $('#last_name').val(selectedFamily.split(' ').pop());
    $.ajax({
      url: '/get-address',
      type: 'GET',
      data: {familyId: familyId},
      success: function(response) {
        $('#address').val(response.address);
      },
      error: function(xhr, status, error) {
      }
    });
  });
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Occupation dropdown change event handler
        document.getElementById('occupation').addEventListener('change', function () {
            
            var occupationValue = this.value;
            var occupationOtherField = document.getElementById('occupation_other');
            var categoryIdInput = document.getElementById('category_id');

            // Retrieve the category_id associated with the selected occupation
            var categoryOption = this.options[this.selectedIndex];
            var categoryId = categoryOption.getAttribute('data-category-id');
            
            // Set the category_id value in the hidden input field
            categoryIdInput.value = categoryId;

            // Show or hide the other field based on the selected value
            if (occupationValue === 'Others') {
                occupationOtherField.style.display = 'block';
            } else {
                occupationOtherField.style.display = 'none';
            }
        });

        // Sub Occupation dropdown change event handler
        document.getElementById('sub_occupation').addEventListener('change', function () {
            var subOccupationValue = this.value;
            var subCategoryIdInput = document.getElementById('sub_category_id');

            // Retrieve the sub_category_id associated with the selected sub_occupation
            var subCategoryOption = this.options[this.selectedIndex];
            var subCategoryId = subCategoryOption.getAttribute('data-sub-category-id');

            // Set the sub_category_id value in the hidden input field
            subCategoryIdInput.value = subCategoryId;
        });

        // Qualification dropdown change event handler
        document.getElementById('qualification').addEventListener('change', function () {
            var qualificationValue = this.value;
            var qualificationOtherField = document.getElementById('qualification_other');

            // Show or hide the other field based on the selected value
            if (qualificationValue === 'Others') {
                qualificationOtherField.style.display = 'block';
            } else {
                qualificationOtherField.style.display = 'none';
            }
        });

        // Degree dropdown change event handler
        document.getElementById('degree').addEventListener('change', function () {
            var degreeValue = this.value;
            var degreeOtherField = document.getElementById('degree_other');

            // Show or hide the other field based on the selected value
            if (degreeValue === 'Others') {
                degreeOtherField.style.display = 'block';
            } else {
                degreeOtherField.style.display = 'none';
            }
        });
    });
</script>
@endsection
