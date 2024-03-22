@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Edit Client</div>
                    <div class="card-body">
                        <form action="{{ route('updateClient', $client->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}">
                            </div>
                            <!-- Add more fields as needed -->
                            <button type="submit" class="btn btn-primary">Update Client</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
