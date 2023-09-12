@extends('layout.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="col-4"> 
                <div class="row mb-2">
                    <h1>View Details</h1>
                    <form action="{{ route('updateUser', $data->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" value="{{ $data->first_name }}" class="form-control @error('first_name') is-invalid @enderror" name="first_name">
                            <span class="text-danger">
                                @error('first_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" value="{{ $data->last_name }}" class="form-control @error('last_name') is-invalid @enderror" name="last_name">
                            <span class="text-danger">
                                @error('last_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" value=" {{ $data->email }}" class="form-control" name="email" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="text" value=" {{ $data->age }}" class="form-control @error('age') is-invalid @enderror" name="age">
                            <span class="text-danger">
                                @error('age')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" value="{{ $data->password }}" class="form-control @error('city') is-invalid @enderror" name="password">
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="number" value="{{ $data->phone }}" class="form-control @error('phone') is-invalid @enderror" name="phone">
                            <span class="text-danger">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"></label>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('users') }}" class="btn btn-dark">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- You can remove the div of class col-4 but it will stretch the fields to the corners -->