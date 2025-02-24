@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Word Details</div>

                <div class="card-body">
                    <p><strong>Word:</strong> {{ $word->deutsch }}</p>
                    <p><strong>Translation:</strong> {{ $word->englisch }}</p>
                    <a href="{{ route('words.index') }}" class="btn btn-primary">Back to My Words</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
