@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Create Project</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="project_name" class="form-label">Project Name</label>
                            <input type="text" id="project_name" name="project_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="client_id" class="form-label">Client</label>
                            <select id="client_id" name="client_id" class="form-select" required>
                                <option value="">Select Client</option>
                                @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="4"
                                required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="active">Active</option>
                                <option value="completed">Completed</option>
                                <option value="on_hold">On Hold</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" id="latitude" name="latitude" class="form-control"
                                value="{{ old('latitude') }}">
                        </div>

                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" id="longitude" name="longitude" class="form-control"
                                value="{{ old('longitude') }}">
                        </div>

                        <div class="mb-3">
                            <label for="radius" class="form-label">Radius (in kilometers)</label>
                            <input type="text" id="radius" name="radius" class="form-control"
                                value="{{ old('radius') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Create Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection