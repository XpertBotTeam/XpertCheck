@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Edit Employee</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('updateEmployee', $employee->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Input fields for editing employee details -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $employee->user->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $employee->user->email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary"
                                value="{{ old('salary', $employee->salary) }}" required>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary">Update Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection