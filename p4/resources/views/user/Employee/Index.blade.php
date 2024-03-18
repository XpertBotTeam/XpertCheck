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
                <!-- Add other employee details here -->
                <form action="{{ route('checkInOut', ['employeeId' => $auth->id]) }}" method="POST">
                    @csrf
                    <!-- Button for checking in -->
                    <button type="submit" name="action" value="check_in" class="btn btn-primary">Check In</button>
                    <!-- Button for checking out -->
                    <button type="submit" name="action" value="check_out" class="btn btn-danger">Check Out</button>
                </form>
            </div>
        </div>
    </div>
@endsection
