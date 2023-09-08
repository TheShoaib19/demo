@extends('layout.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="heading">
                    <h1>Users</h1>
                    <div class="topButtons">
                        <a href="{{ route('newForm') }}" class="btn btn-success btn-sm mr-3">Add New</a>
                        <a class="btn btn-danger btn-sm mr-3 removeAll">Delete Selected</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @if ($message = Session::get('success'))
                    <div class="alert alert-info">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <table id="users" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkboxesMain"></th>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->count())
                            @foreach ($users as $key => $user)
                                <tr id="tr_{{ $user->id }}">
                                    <td><input type="checkbox" class="checkbox" data-id="{{ $user->id }}"></td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->age }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td><a href="{{ route('updateForm', $user->id) }}" class="btn btn-primary btn-sm">View</a></td>
                                    <td><a href="{{ route('deleteUser', $user->id) }}" class="btn btn-danger btn-sm">Delete</a></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection()