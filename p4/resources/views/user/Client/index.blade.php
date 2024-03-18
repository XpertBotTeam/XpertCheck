<!-- resources/views/employees/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body bg-light">
                        <a href="{{ route('createEmployee') }}" class="btn btn-primary mt-3">Add Employee</a>
                        <a href="{{ route('createProject') }}" class="btn btn-primary mt-3">Add Project</a>
                    </div>
                    <div class="card-header bg-primary text-white">Employee List</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    @auth
                                        @if($employee->client_id == auth()->id())
                                            <tr>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>{{ $employee->salary }}</td>
                                            </tr>
                                        @endif
                                    @endauth
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-header bg-success text-white">Project List</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                    @auth
                                        @if($project->client_id == auth()->id())
                                            <tr>
                                                <td><a href="{{ route('projectDetails', ['id' => $project->id]) }}">{{ $project->project_name }}</a></td>
                                                <td>{{ $project->description }}</td>
                                                <td>{{ $project->start_date }}</td>
                                                <td>{{ $project->status }}</td>
                                            </tr>
                                        @endif
                                    @endauth
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
