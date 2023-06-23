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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Occupation') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('businesses.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="business_name" class="col-md-4 col-form-label text-md-right">{{ __('Occupation Name') }} <span class="required-field"></span></label>

                            <div class="col-md-6">
                                <input id="business_name" type="text" class="form-control @error('business_name') is-invalid @enderror" name="business_name" value="{{ old('business_name') }}" required autocomplete="business_name" autofocus>

                                @error('business_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="owner" class="col-md-4 col-form-label text-md-right">{{ __('Owner Id') }} <span class="required-field"></span></label>
                            <div class="col-md-6">
                                <input type="text" id="owner_input" class="form-control" list="owners" name="owner_id">
                                <datalist id="owners">
                                    <option value="">Select Owner</option>
                                    @foreach ($heads as $head)
                                        <option value="{{ $head->id }}" data-name="{{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }}">{{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }}</option>
                                    @endforeach
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}" data-name="{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}">{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</option>
                                    @endforeach
                                </datalist>
                                @error('owner_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="owner" class="col-md-4 col-form-label text-md-right">{{ __('Owner Name') }} <span class="required-field"></span></label>
                            <input  name="owner_name" id="owner_name" value="{{ old('owner_name') }}" readonly>
                        </div>
                        


                        <div class="form-group row">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }} <span class="required-field"></span></label>

                            <div class="col-md-6">
                                <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="subcategory_id" class="col-md-4 col-form-label text-md-right">{{ __('Subcategory') }} <span class="required-field"></span></label>

                            <div class="col-md-6">
                                <select id="subcategory_id" name="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" required>
                                    <option value="">-- Select Subcategory --</option>
                                </select>

                                @error('subcategory_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }} <span class="required-field"></span></label>

                            <div class="col-md-6">
                                <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address">{{ old('address') }}</textarea>

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }} <span class="required-field"></span></label>

                            <div class="col-md-6">
                                <input id="contact_number" type="text" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number" value="{{ old('contact_number') }}" required autocomplete="contact_number" maxlength="10">

                                @error('contact_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Create Occupation') }}</button>
                                <a href="{{ route('businesses.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Initialize subcategory options
        var subcategories = @json($subcategories);
        var initialCategory = $('#category_id').val();
        updateSubcategoryOptions(initialCategory);

        // Update subcategory options when the category is changed
        $('#category_id').change(function () {
            var selectedCategory = $(this).val();
            updateSubcategoryOptions(selectedCategory);
        });

        // Function to update subcategory options based on the selected category
        function updateSubcategoryOptions(categoryId) {
            var subcategorySelect = $('#subcategory_id');
            subcategorySelect.empty();

            // Add the default option
            subcategorySelect.append('<option value="">-- Select Subcategory --</option>');

            // Add the subcategories related to the selected category
            var relatedSubcategories = subcategories.filter(function (subcategory) {
                return subcategory.category_id == categoryId;
            });

            relatedSubcategories.forEach(function (subcategory) {
                subcategorySelect.append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
            });
        }
    });
</script>



@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        debugger;

        $('#owner_id').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var ownerName = selectedOption.data('name');
            var ownerId = selectedOption.val();
            $('#owner_name').val(ownerName);
            $('input[name="owner_id"]').val(ownerId);
        });

        var ownerName = "{{ old('owner_name') }}";
         $('#owner_name').val(ownerName);
    });
</script>

<script>
    const ownerInput = document.getElementById('owner_input');
    const ownersList = document.getElementById('owners');
    const ownerNameInput = document.getElementById('owner_name');

    ownerInput.addEventListener('input', function(event) {
        const inputValue = event.target.value.toLowerCase();
        const options = ownersList.options;

        for (let i = 0; i < options.length; i++) {
            const option = options[i];
            const optionValue = option.value.toLowerCase();
            const optionName = option.getAttribute('data-name').toLowerCase();
            
            if (optionValue.includes(inputValue) || optionName.includes(inputValue)) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        }
    });

    ownerInput.addEventListener('change', function(event) {
        const selectedOption = ownersList.querySelector(`option[value="${event.target.value}"]`);
        const ownerName = selectedOption.getAttribute('data-name');
        ownerNameInput.value = ownerName;
    });

    // Set the initial owner name if available
    const initialOwnerName = "{{ old('owner_name') }}";
    ownerNameInput.value = initialOwnerName;
</script>

@endsection

@endsection
