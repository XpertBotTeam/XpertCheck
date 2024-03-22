<!-- resources/views/employees/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Employee Details
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $auth->name }}</h5>
                <p class="card-text">Email: {{ $auth->email }}</p>
                <p class="card-text">Salary: {{ $auth->salary }}</p>
            </div>
        </div>
    </div>
@endsection
