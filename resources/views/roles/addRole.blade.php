@extends('layout.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="col-4"> 
                <div class="row mb-2">
                    <h1>Add New Role</h1>
                    <form action="{{ route('addRole') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Role Name</label>
                            <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"></label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('roles') }}" class="btn btn-dark">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const nameField = document.getElementById('name');
        nameField.addEventListener('keydown' , function(e){
            if((e.keyCode >= 65 && e.keyCode <= 90) || e.keyCode == 8 || e.keyCode == 32 || e.keyCode == 37 ||e.keyCode == 39){
                return true;
            }
            e.preventDefault();
        });
    </script>
@endsection

<!-- You can remove the div of class col-4 but it will stretch the fields to the corners -->