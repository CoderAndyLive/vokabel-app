@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Training</div>

                <div class="card-body">
                    <div id="training-app">
                        <p id="word">Loading...</p>
                        <form id="answer-form">
                            @csrf
                            <input type="hidden" id="word-id" name="word_id">
                            <div class="form-group">
                                <label for="answer">Your Answer:</label>
                                <input type="text" class="form-control" id="answer" name="answer" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <p id="message"></p>
                        <p id="score">Score: 0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadNextWord();

    document.getElementById('answer-form').addEventListener('submit', function(event) {
        event.preventDefault();
        checkAnswer();
    });
});

function loadNextWord() {
    fetch('{{ route('words.nextWord') }}')
        .then(response => response.json())
        .then(data => {
            document.getElementById('word').textContent = data.word.deutsch;
            document.getElementById('word-id').value = data.word.id;
        })
        .catch(error => console.error('Error loading next word:', error));
}

function checkAnswer() {
    const form = document.getElementById('answer-form');
    const formData = new FormData(form);

    fetch('{{ route('words.checkAnswer') }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        form.reset();
        document.getElementById('message').textContent = data.correct ? 'Correct!' : 'Incorrect!';
        document.getElementById('score').textContent = 'Score: ' + data.newScore;
        loadNextWord();
    })
    .catch(error => console.error('Error checking answer:', error));
}
</script>
@endsection