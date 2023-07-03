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
                <div class="card-header">Edit Family</div>
                <form method="POST" action="{{ route('families.update', $family->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <div class="row mx-5">
                            <div class="col-sm-4">
                                <label for="head_first_name">{{ __('First Name') }}</label>
                                <input type="text" name="head_first_name" class="form-control" id="head_first_name" value="{{ $family->head_first_name }}">
                            </div>
                            <div class="col-sm-4">
                                <label for="head_middle_name">{{ __('Middle Name') }}</label>
                                <input type="text" name="head_middle_name" class="form-control" id="head_middle_name" value="{{ $family->head_middle_name }}">
                            </div>
                            <div class="col-sm-4">
                                <label for="head_last_name">{{ __('Last Name') }}</label>
                                <input type="text" name="head_last_name" class="form-control" id="head_last_name" value="{{ $family->head_last_name }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row mx-5">
                            <div class="col-sm-4">
                                <label for="gender">{{ __('Gender') }}</label>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="Male" {{ $family->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $family->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ $family->gender == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="marital_status">{{ __('Marital Status') }}</label>
                                <select name="marital_status" class="form-control" id="marital_status">
                                    <option value="">Select Marital Status</option>
                                    @foreach ($maritals as $marital)
                                        <option value="{{ $marital->name }}" {{ $family->marital_status == $marital->name ? 'selected' : '' }}>
                                            {{ $marital->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="date_of_anniversary">{{ __('Date of Anniversary') }}</label>
                                <input type="date" name="date_of_anniversary" class="form-control" id="date_of_anniversary" value="{{ $family->date_of_anniversary }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row mx-5">
                            <div class="col-sm-4">
                                <label for="head_occupation">{{ __('Occupation') }}</label>
                                <select name="head_occupation" class="form-control" id="head_occupation">
                                    <option value="">Select Occupation</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}" data-category-id="{{ $category->id }}" {{ $family->head_occupation == $category->name ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="category_id" id="category_id">
                                <input type="text" name="head_occupation_other" class="form-control other-field" id="occupation_other" style="display: none;" value="{{ $family->head_occupation_other }}">
                            </div>
                            <div class="col-sm-4">
                                <label for="sub_occupation">Sub Occupation:</label>
                                <select name="sub_occupation" class="form-control" id="sub_occupation">
                                    <option value="">Select Sub Occupation</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->name }}" data-sub-category-id="{{ $subcategory->id }}" {{ $family->sub_occupation == $subcategory->name ? 'selected' : '' }}>
                                            {{ $subcategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="subcategory_id" id="sub_category_id" value="{{ $family->subcategory_id }}">
                            </div>
                            <div class="col-sm-4">
                                <label for="head_mobile_number">{{ __('Mobile Number') }}</label>
                                <input type="text" name="head_mobile_number" class="form-control" id="head_mobile_number" maxlength="10" value="{{ $family->head_mobile_number }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row mx-5">
                            <div class="col-sm-4">
                                <label for="relationship_with_head">{{ __('Relationship With Head') }}</label>
                                <select name="relationship_with_head" class="form-control" id="relationship_with_head">
                                    <option value="Self" {{ $family->relationship_with_head == 'Self' ? 'selected' : '' }}>Self</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="qualification">{{ __('Qualification') }}</label>
                                <select name="qualification" class="form-control" id="qualification">
                                    <option value="">Select Qualification</option>
                                    @foreach ($qualifications as $qualification)
                                        <option value="{{ $qualification->name }}" {{ $family->qualification == $qualification->name ? 'selected' : '' }}>
                                            {{ $qualification->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="text" name="qualification_other" class="form-control other-field" id="qualification_other" style="display: none;" value="{{ $family->qualification_other }}">
                            </div>
                            <div class="col-sm-4">
                                <label for="degree">{{ __('Degree') }}</label>
                                <select name="degree" class="form-control" id="degree">
                                    <option value="">Select Degree</option>
                                    @foreach ($degrees as $degree)
                                        <option value="{{ $degree->name }}" {{ $family->degree == $degree->name ? 'selected' : '' }}>
                                            {{ $degree->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="text" name="degree_other" class="form-control other-field" id="degree_other" style="display: none;" value="{{ $family->degree_other }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row mx-5">
                            <div class="col-sm-6">
                                <label for="address">{{ __('Address') }}</label>
                                <textarea type="text" name="address" class="form-control" id="address">{{ $family->address }}</textarea>
                            </div>
                            <div class="col-sm-6">
                                <label for="head_dob">Head Date of Birth:</label>
                                <input type="date" name="head_dob" class="form-control" id="head_dob" value="{{ $family->head_dob }}">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                <div class="card-body"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#head_occupation').on('change', function() {
       
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
    document.addEventListener('DOMContentLoaded', function () {
        // Occupation dropdown change event handler
        document.getElementById('head_occupation').addEventListener('change', function () {
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

        // Function to fetch sub_occupation options based on the selected category
        function fetchSubOccupations(categoryId) {
            $.ajax({
                url: '{{ route('subcategories', ['category' => '']) }}/' + categoryId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var subOccupationDropdown = document.getElementById('sub_occupation');
                    subOccupationDropdown.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(function (subcategory) {
                            var option = document.createElement('option');
                            option.value = subcategory.name;
                            option.text = subcategory.name;
                            option.setAttribute('data-sub-category-id', subcategory.id);
                            subOccupationDropdown.appendChild(option);
                        });
                    } else {
                        var option = document.createElement('option');
                        option.value = '';
                        option.text = 'No Sub Occupation Found';
                        subOccupationDropdown.appendChild(option);
                    }
                }
            });
        }

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