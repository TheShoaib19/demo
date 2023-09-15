@extends('layout.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="col-4"> 
                <div class="row mb-2">
                    {{-- <div>
                        @if (session()->has('user_update'))
                            <div class="alert alert-danger" id="alert">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                {{ session()->get('user_update') }}
                            </div>
                        @endif
                    </div> --}}
                    <h1>View Roles</h1>
                    <form action="{{ route('updateRole', $data->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input type="text" value="{{ $data->id }}" class="form-control @error('id') is-invalid @enderror" name="id" readonly>
                            <span class="text-danger">
                                @error('id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role Name</label>
                            <input type="text" value="{{ $data->name }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"></label>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('roles') }}" class="btn btn-dark">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const nameField = document.getElementById('name');
        nameField.addEventListener('keydown', function(e){
            if((e.keyCode >= 65 && e.keyCode <= 90) || e.keyCode == 8 || e.keyCode == 32 || e.keyCode == 37 ||e.keyCode == 39){
                return true;
            }
            e.preventDefault();
        });
    </script>
    <script type="text/javascript">
        $("document").ready(function(){
            setTimeout(function(){
                $("div.alert").remove();
            }, 10000);
        });
    </script>
@endsection