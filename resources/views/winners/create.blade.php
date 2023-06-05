@extends('layouts.app')
<style>
    .required-field:after {
        content: "*";
        color: red;
        margin-left: 5px;
    }
</style>

@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    span.select2.select2-container.select2-container--classic{
        width: 100% !important;
    }
</style>
@endpush

@section('content')
    <div class="container">
        <h1>Create Winner</h1>

        <form method="POST" action="{{ route('winners.store') }}">
            @csrf

            <div class="form-group">
                <label for="quiz_id">Quiz<span class="required-field">:</label>
                <select name="quiz_id" id="quiz_id" class="form-control quiz">
                    <option value="">Select Quiz</option>
                    @foreach ($quizzes as $quiz)
                        <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="first_winner">First Winner<span class="required-field">:</label>
                <select name="first_winner" id="first_winner" class="form-control select2">
                    <option value="">Select First Winner</option>
                    @foreach ($heads as $head)
                    <option value="{{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }}" data-name="{{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }}">Head - {{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }}</option>
                    @endforeach
                    @foreach ($members as $member)
                    <option value="{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}" data-name="{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}">Member - {{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="second_winner">Second Winner<span class="required-field">:</label>
                <select name="second_winner" id="second_winner" class="form-control select2">
                    <option value="">Select Second Winner</option>
                    @foreach ($heads as $head)
                    <option value="{{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }}" data-name="{{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }}">Head - {{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }}</option>
                    @endforeach
                    @foreach ($members as $member)
                    <option value="{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}" data-name="{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}">Member - {{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="third_winner">Third Winner<span class="required-field">:</label>
                <select name="third_winner" id="third_winner" class="form-control select2">
                    <option value="">Select Thired Winner</option>
                    @foreach ($heads as $head)
                    <option value="{{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }}" data-name="{{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }}">Head - {{ $head->head_first_name }} {{ $head->head_middle_name }} {{ $head->head_last_name }}</option>
                    @endforeach
                    @foreach ($members as $member)
                    <option value="{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}" data-name="{{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}">Member - {{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Winner</button>
        </form>
    </div>
@endsection

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function(){
    $('.quiz').select2({
        theme: "classic"
    });
});
</script>
@endpush

<script>
    $(document).ready(function() {
        debugger;

        $('#first_winner').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var ownerName = selectedOption.data('name');
            var ownerId = selectedOption.val();
            $('#first_winner').val(ownerName);
        });

        var ownerName = "{{ old('first_winner') }}";
         $('#first_winner').val(ownerName);
    });
</script>

<script>
    $(document).ready(function() {
        debugger;

        $('#second_winner').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var ownerName = selectedOption.data('name');
            var ownerId = selectedOption.val();
            $('#second_winner').val(ownerName);
        });

        var ownerName = "{{ old('second_winner') }}";
         $('#second_winner').val(ownerName);
    });
</script>

<script>
    $(document).ready(function() {
        debugger;

        $('#third_winner').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var ownerName = selectedOption.data('name');
            var ownerId = selectedOption.val();
            $('#third_winner').val(ownerName);
        });

        var ownerName = "{{ old('third_winner') }}";
         $('#third_winner').val(ownerName);
    });
</script>
