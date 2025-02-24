@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Word</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('words.store') }}">
                        @csrf

                        <div class="form-group">
    <label for="deutsch">Deutsch</label>
    <input type="text" class="form-control" id="deutsch" name="deutsch" required>
</div>

<div class="form-group">
    <label for="englisch">Englisch</label>
    <input type="text" class="form-control" id="englisch" name="englisch" required>
</div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
