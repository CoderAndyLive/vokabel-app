@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Words</div>

                <div class="card-body">
                    <a href="{{ route('words.create') }}" class="btn btn-primary">Add New Word</a>
                    <a href="{{ route('training') }}" class="btn btn-success ml-2">Start Training Session</a>
                    <div class="text-center mt-4">
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Word</th>
                                <th>Translation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($words as $word)
                                <tr id="word-row-{{ $word->id }}">
                                    <td class="word-deutsch">{{ $word->deutsch }}</td>
                                    <td class="word-englisch">{{ $word->englisch }}</td>
                                    <td>
                                        <a href="{{ route('words.show', $word->id) }}" class="btn btn-sm btn-info">View</a>
                                        <button class="btn btn-sm btn-primary" onclick="toggleEditForm({{ $word->id }})">Edit</button>
                                        <form action="{{ route('words.destroy', $word->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr id="edit-form-{{ $word->id }}" style="display: none;">
                                    <td colspan="3">
                                        <form id="update-form-{{ $word->id }}" method="POST" onsubmit="event.preventDefault(); updateWord({{ $word->id }});">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="word">Word</label>
                                                <input type="text" class="form-control" id="word-{{ $word->id }}" name="word" value="{{ $word->deutsch }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="translation">Translation</label>
                                                <input type="text" class="form-control" id="translation-{{ $word->id }}" name="translation" value="{{ $word->englisch }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="button" class="btn btn-secondary" onclick="toggleEditForm({{ $word->id }})">Cancel</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleEditForm(id) {
    var form = document.getElementById('edit-form-' + id);
    if (form.style.display === 'none') {
        form.style.display = 'table-row';
    } else {
        form.style.display = 'none';
    }
}

function updateWord(id) {
    var word = document.getElementById('word-' + id).value;
    var translation = document.getElementById('translation-' + id).value;

    fetch(`/words/${id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            deutsch: word,
            englisch: translation
        })
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text) });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            document.querySelector(`#word-row-${id} .word-deutsch`).innerText = word;
            document.querySelector(`#word-row-${id} .word-englisch`).innerText = translation;
            toggleEditForm(id);
        } else {
            alert('Failed to update word');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update word: ' + error.message);
    });
}
</script>
@endsection
