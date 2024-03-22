<!-- edit-phase.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Project Phase</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('updateProjectPhase', ['projectId' => $projectPhase->project_id, 'phaseId' => $projectPhase->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="phase_name">Phase Name</label>
                                <input type="text" class="form-control" id="phase_name" name="phase_name" value="{{ $projectPhase->phase_name }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description">{{ $projectPhase->description }}</textarea>
                            </div>

                            <!-- Add other fields as needed -->

                            <button type="submit" class="btn btn-primary">Update Phase</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
