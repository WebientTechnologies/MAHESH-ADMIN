@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Create Quiz</div>
            <div class="card-body">
                <form method="POST" action="{{ route('quizzes.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input type="datetime-local" class="form-control" name="start_time" id="start_time" required>
                    </div>

                    <div class="form-group">
                        <label for="end_time">End Time</label>
                        <input type="datetime-local" class="form-control" name="end_time" id="end_time" required>
                    </div>

                    <div class="form-group">
                        <label for="questions">Questions</label>
                        <div id="questions">
                            <div class="form-group">
                                <input type="text" class="form-control" name="questions[0][question]" placeholder="Question" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="questions[0][options][]" placeholder="Option 1" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="questions[0][options][]" placeholder="Option 2" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="questions[0][options][]" placeholder="Option 3" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="questions[0][options][]" placeholder="Option 4" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="questions[0][answer]" placeholder="Correct Answer" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addQuestion()">Add Question</button>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Quiz</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let questionIndex = 1;

        function addQuestion() {
            let html = `
                <div class="form-group">
                    <input type="text" class="form-control" name="questions[${questionIndex}][question]" placeholder="Question" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Option 1" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Option 2" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Option 3" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="questions[${questionIndex}][options][]" placeholder="Option 4" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="questions[${questionIndex}][answer]" placeholder="Correct Answer" required>
                </div>
            `;

            let questionDiv = document.createElement('div');
            questionDiv.innerHTML = html;

            let questionsDiv = document.getElementById('questions');
            questionsDiv.appendChild(questionDiv);

            questionIndex++;
        }
        </script>
@endsection