@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body bg-light">
                        <a href="{{ route('createProject') }}" class="btn btn-primary mt-3">Add Project</a>
                    </div>
                    <div class="card-header bg-primary text-white">Project List</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>Status</th>
                                    <th>Actions</th> <!-- New column for actions -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $project)
                                    <tr>
                                        <td><a href="{{ route('projectDetails', ['id' => $project->id]) }}">{{ $project->project_name }}</a></td>
                                        <td>{{ $project->description }}</td>
                                        <td>{{ $project->start_date }}</td>
                                        <td>{{ $project->status }}</td>
                                        <td>
                                            <form action="{{ route('deleteProject', $project->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            <a href="{{ route('editProject', ['id' => $project->id]) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
