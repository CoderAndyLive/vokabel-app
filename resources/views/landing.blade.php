@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to Andy's Vokabel App</div>

                <div class="card-body">
                    <h1>Learn Vocabulary</h1>
                    <p>Track your progress and improve your language skills.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                    <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
