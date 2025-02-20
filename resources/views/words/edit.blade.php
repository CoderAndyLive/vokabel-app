@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Word</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('words.update', $word->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="word">Word</label>
                            <input type="text" class="form-control" id="word" name="word" value="{{ $word->word }}" required>
                        </div>

                        <div class="form-group">
                            <label for="translation">Translation</label>
                            <input type="text" class="form-control" id="translation" name="translation" value="{{ $word->translation }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
