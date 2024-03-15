@extends('layouts.app')

@section('title', "{$user->name}'s Profile")

@section('content')
    <div class="container">
        <h2>{{ $user->name }}'s Profile</h2>

        <!-- User information -->
        <div class="user-info mt-3">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
    </div>
@endsection
