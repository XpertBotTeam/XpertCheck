@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f9fa; /* Light background color */
        font-family: 'Arial', sans-serif;
        color: #000000; /* Black text color */
    }

    .card {
        background-color: #ffffff; /* Darker card background color */
        color: #000000;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #2c3e50; /* Darker header color */
        border-bottom: none;
    }

    .btn-primary {
        background-color: #2c3e50; /* Custom dark button color */
        border-color: #2c3e50;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #1c2833; /* Darker hover state color */
    }

    .form-label {
        font-weight: bold;
        color: #000000; /* Black label text color */
    }

    .invalid-feedback {
        color: #e74c3c; /* Red error message color */
    }

    .btn-link {
        color: #2c3e50; /* Custom dark link color */
    }

    .btn-link:hover {
        text-decoration: underline;
    }

    /* Center the button */
    .btn-container {
        text-align: center;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-header bg-primary text-white text-center h4">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>

                        <div class="btn-container"> <!-- Center the button -->
                            <button type="submit" class="btn bg-primary text-white btn-block">{{ __('Login') }}</button>
                        </div>

                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
