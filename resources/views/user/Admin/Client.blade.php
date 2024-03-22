@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body bg-light">
                        <a href="{{ route('createClient') }}" class="btn btn-primary mt-3">Add Client</a>
                    </div>
                    <div class="card-header bg-primary text-white">Client List</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                    <!-- New column for actions -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>
                                            <form action="{{ route('deleteClient', $client->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            <a href="{{ route('editClient', $client->id) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                        <!-- Add more client fields as needed -->
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
