@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Client</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('storeClient') }}">
                        @csrf

                        <div class="form-group">
                            <label for="user_id">Select User</label>
                            <select id="user_id" name="user_id" class="form-control" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- You can remove the name, email, and password fields -->
                        <!-- as they will be fetched from the selected user -->

                        <!-- Add more fields as needed -->

                        <button type="submit" class="btn btn-primary">Create Client</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
