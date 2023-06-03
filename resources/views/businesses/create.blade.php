@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Occupation') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('businesses.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="business_name" class="col-md-4 col-form-label text-md-right">{{ __('Occupation Name') }}</label>

                            <div class="col-md-6">
                                <input id="business_name" type="text" class="form-control @error('business_name') is-invalid @enderror" name="business_name" value="{{ old('business_name') }}" required autocomplete="business_name" autofocus>

                                @error('business_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="owner_name" id="owner_name" value="{{ old('owner_name') }}">
                        <div class="form-group row">
                            <label for="owner" class="col-md-4 col-form-label text-md-right">{{ __('Owner') }}</label>
                            <div class="col-md-6">
                                <select name="owner_id" id="owner_id" class="form-control select2">
                                    <option value="">Select Owner</option>
                                    @foreach ($heads as $head)
                                    <option value="{{ $head->id }}" data-name="{{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }}">Head - {{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }}</option>
                                    @endforeach
                                    @foreach ($members as $member)
                                    <option value="{{ $member->id }}" data-name="{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}">Member - {{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('owner_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

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
                            <label for="subcategory_id" class="col-md-4 col-form-label text-md-right">{{ __('Subcategory') }}</label>

                            <div class="col-md-6">
                                <select id="subcategory_id" name="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" required>
                                    <option value="">-- Select Subcategory --</option>
                                    @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" @if(old('subcategory_id') == $subcategory->id) selected @endif>{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>

                                @error('subcategory_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

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
                            <label for="contact_number" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

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
                            <input type="file" class="form-control-file" id="image" name="image" required>
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
@endsection

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
@endsection
