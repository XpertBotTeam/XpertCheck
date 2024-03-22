@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f9fa; /* Dark background color */
        font-family: 'Arial', sans-serif;
        color: #000000; /* Black text color */
    }

    .card {
        background-color: #ffffff; /* Dark card background color */
        color: #000000; /* Black text color */
        border-radius: 8px; /* Rounded corners for the card */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
        max-width: 400px; /* Set the maximum width of the card */
    }

    .card-header {
        background-color: #2c3e50; /* Facebook blue for the header */
        border-bottom: none; /* No border at the bottom of the header */
        border-top-left-radius: 8px; /* Rounded corners for the top-left of the header */
        border-top-right-radius: 8px; /* Rounded corners for the top-right of the header */
        color: #000000; /* Black text color for the header */
    }

    .btn-primary {
        background-color: #2c3e50; /* Facebook blue for the primary button */
        border-color: #3b5998; /* Matching border color */
        transition: background-color 0.3s ease; /* Smooth transition on hover */
        border-radius: 8px; /* Rounded corners for the button */
    }

    .btn-primary:hover {
        background-color: #1c2833; /* Darker blue on hover */
    }

    .form-label {
        font-weight: bold;
        color: #000000; /* Black text color for the labels */
    }

    .invalid-feedback {
        color: #dc3545; /* Red error message color */
    }
        /* Center the button */
    .btn-container {
        text-align: center;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
            <div class="card-header bg-primary text-white text-center h4">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="btn-container"> <!-- Center the button -->
                            <button type="submit" class="btn bg-primary text-white btn-block">{{ __('Register') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
