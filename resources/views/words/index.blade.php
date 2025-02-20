@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Words</div>

                <div class="card-body">
                    <a href="{{ route('words.create') }}" class="btn btn-primary">Add New Word</a>
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
                                <tr>
                                    <td>{{ $word->word }}</td>
                                    <td>{{ $word->translation }}</td>
                                    <td>
                                        <a href="{{ route('words.show', $word->id) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('words.edit', $word->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('words.destroy', $word->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
@endsection
