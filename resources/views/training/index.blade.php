@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Training</h1>
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if($word)
        <form id="answer-form" action="{{ route('words.checkAnswer') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="deutsch">{{ $word->deutsch }}</label>
                <input type="hidden" name="word_id" value="{{ $word->id }}">
                <input type="text" name="answer" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @else
        <p>No words available for training.</p>
    @endif
</div>

<!-- Modal -->
<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resultModalLabel">Result</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="resultMessage">
        <!-- Result message will be populated here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('answer-form').addEventListener('submit', function(event) {
        event.preventDefault();
        checkAnswer();
    });
});

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
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const resultMessage = document.getElementById('resultMessage');
        if (data.correct) {
            resultMessage.innerHTML = `<div class="alert alert-success">Correct! Your new score is ${data.newScore}.</div>`;
        } else {
            resultMessage.innerHTML = `<div class="alert alert-danger">Incorrect! The correct answer was ${data.correctAnswer}.</div>`;
        }
        $('#resultModal').modal('show');
        form.reset();
        loadNextWord();
    })
    .catch(error => console.error('Error checking answer:', error));
}

function loadNextWord() {
    fetch('{{ route('words.nextWord') }}')
        .then(response => response.json())
        .then(data => {
            if (data.word) {
                document.querySelector('label[for="deutsch"]').textContent = data.word.deutsch;
                document.querySelector('input[name="word_id"]').value = data.word.id;
            } else {
                document.getElementById('resultMessage').innerHTML = '<p>No words available for training.</p>';
                $('#resultModal').modal('show');
            }
        })
        .catch(error => console.error('Error loading next word:', error));
}
</script>
@endsection