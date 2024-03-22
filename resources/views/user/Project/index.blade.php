<!-- resources/views/projects/show.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $projects->project_name }}</div>
                    <div class="card-body">
                        <p><strong>Description:</strong> {{ $projects->description }}</p>
                        <p><strong>Start Date:</strong> {{ $projects->start_date }}</p>
                        <p><strong>Status:</strong> {{ $projects->status }}</p>
                        <p><strong>Client:</strong> {{ $projects->client->name }}</p>

                        <!-- Button to add project phase -->
                        <a href="{{ route('createProjectPhase', ['projectId' => $projects->id]) }}" class="btn btn-primary mb-3">Add Project Phase</a>
                        <!-- Button to add employees to the project -->
                        <a href="{{ route('assignEmployees', ['projectId' => $projects->id]) }}" class="btn btn-secondary mb-3">Assign Employees</a>

                        <!-- List of assigned employees -->
                        @if ($EmployeeProjectAssignments->count() > 0)
    <h4>Assigned Employees</h4>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Actions</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>
                @foreach ($EmployeeProjectAssignments as $assignment)
                    <tr>
                        <td>{{ $assignment->employee->name }}</td>
                        <td>
                            <!-- Edit button -->
                            <a href="{{ route('editEmployeeAssignment', ['projectId' => $assignment->project_id, 'assignmentId' => $assignment->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            <!-- Delete button -->
                            <form action="{{ route('deleteEmployeeAssignment', ['projectId' => $assignment->project_id, 'assignmentId' => $assignment->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>No employees assigned to this project.</p>
@endif


                        <!-- Table of project phases -->
                        @if ($projectphases->count() > 0)
                            <h4>Project Phases</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Phase Name</th>
                                            <th>Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Actions</th> <!-- New column for actions -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($projectphases as $phase)
                                            <tr>
                                                <td>{{ $phase->phase_name }}</td>
                                                <td>{{ $phase->description }}</td>
                                                <td>{{ $phase->start_date }}</td>
                                                <td>{{ $phase->end_date }}</td>
                                                <td>{{ $phase->status }}</td>
                                                <td>
                                                    <a href="{{ route('editProjectPhase', ['projectId' => $projects->id, 'phaseId' => $phase->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                                                    <form action="{{ route('deleteProjectPhase', ['projectId' => $projects->id, 'phaseId' => $phase->id]) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this phase?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No project phases found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
