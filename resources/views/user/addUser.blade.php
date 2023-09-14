@extends('layout.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="col-4"> 
                <div class="row mb-2">
                    <h1>Add New User</h1>
                    <form action="{{ route('add') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" name="first_name">
                            <span class="text-danger">
                                @error('first_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" name="last_name">
                            <span class="text-danger">
                                @error('last_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="text" value="{{ old('age') }}" class="form-control @error('age') is-invalid @enderror" name="age">
                            <span class="text-danger">
                                @error('age')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
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
                            <input type="text" maxlength="15" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Enter/Select a country code as well">
                            <input name="idValue" id="idValue" type="hidden">
                            <span class="text-danger">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"></label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('users') }}" class="btn btn-dark">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const phoneField = document.getElementById('phone');
        phoneField.addEventListener('keydown' , function(e){
            if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || ((e.keyCode == 187 && e.shiftKey) || e.keyCode == 107) || e.keyCode == 8 || e.keyCode == 9 || e.keyCode == 37 ||e.keyCode == 39){
                return true;
            }
            e.preventDefault();
        });
    </script>
@endsection

<!-- You can remove the div of class col-4 but it will stretch the fields to the corners -->