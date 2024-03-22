<!-- resources/views/projects/assignEmployees.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Assign Employees to {{ $project->project_name }}</div>
                    <div class="card-body">
                        <form action="{{ route('storeAssignment', ['projectId' => $project->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="employee_id">Select Employees:</label>
                                <select name="employee_id[]" id="employee_id" class="form-control" multiple required>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="assignment_date">Assignment Date:</label>
                                <input type="date" name="assignment_date" id="assignment_date" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Assign Employees</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
