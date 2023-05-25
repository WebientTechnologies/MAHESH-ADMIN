@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Winner</h1>

        <form method="POST" action="{{ route('winners.update', $winner->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="quiz_id">Quiz:</label>
                <select name="quiz_id" id="quiz_id" class="form-control">
                    <option value="">Select Quiz</option>
                    @foreach ($quizzes as $quiz)
                        <option value="{{ $quiz->id }}" {{ $winner->quiz_id == $quiz->id ? 'selected' : '' }}>
                            {{ $quiz->title }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="first_winner">First Winner:</label>
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
                <label for="second_winner">Second Winner:</label>
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
                <label for="third_winner">Third Winner:</label>
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

            <button type="submit" class="btn btn-primary">Update Winner</button>
        </form>
    </div>
@endsection

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
