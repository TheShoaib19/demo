@extends('layout.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="col-4"> 
                <div class="row mb-2">
                    <div>
                        @if (session()->has('user_update'))
                            <div class="alert alert-danger" id="alert">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                {{ session()->get('user_update') }}
                            </div>
                        @endif
                    </div>
                    <h1>View Details</h1>
                    {{-- {{ dd(auth()->user()->roles->toArray()) }} --}}
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
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Leave Blank Unless You Want to Change Password">
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password">
                            <span class="text-danger">
                                @error('confirm_password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <select onchange="document.getElementById('phone').value=this.options[this.selectedIndex].text; document.getElementById('idValue').value=this.options[this.selectedIndex].value;">
                              <option></option>
                              <option>+92</option>
                              <option>+44</option>
                              <option>+1</option>
                              <option>+32</option>
                            </select>
                            <input type="text" maxlength="15" value="{{ $data->phone }}" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Enter/Select a country code as well">
                            <input name="idValue" id="idValue" type="hidden">
                            <span class="text-danger">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div>
                            <label class="form-label">Assign Role</label>
                        </div>
                        <div class="mb-3">
                            <select name="role" id="role" onchange="getSelectedValue()">
                                <option value selected>Select</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
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
    <script>
        const phoneField = document.getElementById('phone');
        phoneField.addEventListener('keydown', function(e){
            if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || ((e.keyCode == 187 && e.shiftKey) || e.keyCode == 107) || e.keyCode == 8 || e.keyCode == 9 || e.keyCode == 37 ||e.keyCode == 39){
                return true;
            }
            e.preventDefault();
        });
        function getSelectedValue() {
            const dropdown = document.getElementById("role");
            const selectedOption = dropdown.value;
            console.log(selectedOption);
        }
    </script>
    <script type="text/javascript">
        $("document").ready(function(){
            setTimeout(function(){
                $("div.alert").remove();
            }, 10000);
        });
    </script>
@endsection

<!-- You can remove the div of class col-4 but it will stretch the fields to the corners -->