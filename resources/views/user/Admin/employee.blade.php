@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body bg-light">
                        <a href="{{ route('createEmployee') }}" class="btn btn-primary mt-3">Add Employee</a>
                    </div>
                    <div class="card-header bg-primary text-white">Employee List</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Salary</th>
                                    <th>Action</th> <!-- New column for actions -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->salary }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('editEmployee', $employee->id) }}" class="btn btn-info">Edit</a>
                                                <form action="{{ route('deleteEmployee', $employee->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
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
