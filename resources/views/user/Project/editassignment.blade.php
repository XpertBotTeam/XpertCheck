<!-- edit-assignment.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Employee Assignment</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('updateEmployeeAssignment', ['projectId' => $assignment->project_id, 'assignmentId' => $assignment->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="employee_id">Employee Name:</label>
                                <select class="form-control" id="employee_id" name="employee_id">
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $assignment->employee_id == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Add more form fields as needed -->
                            <button type="submit" class="btn btn-primary">Update Assignment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
