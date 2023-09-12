<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    @include('includes.css')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #4070f4;
        }
        .wrapper {
            position: relative;
            max-width: 430px;
            width: 100%;
            background: #fff;
            padding: 34px;
            border-radius: 6px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .wrapper h2 {
            position: relative;
            font-size: 22px;
            font-weight: 600;
            color: #333;
        }
        .wrapper h2::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 28px;
            border-radius: 12px;
            background: #4070f4;
        }
        .wrapper form {
            margin-top: 30px;
        }
        .wrapper form .input-box {
            height: 52px;
            margin: 18px 0;
        }

        form .input-box input {
            height: 100%;
            width: 100%;
            outline: none;
            padding: 0 15px;
            font-size: 17px;
            font-weight: 400;
            color: #333;
            border: 1.5px solid #C7BEBE;
            border-bottom-width: 2.5px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .input-box input:focus,
        .input-box input:valid {
            border-color: #4070f4;
        }

        form h3 {
            color: #707070;
            font-size: 14px;
            font-weight: 500;
            margin-left: 10px;
        }

        .input-box.button input {
            color: #fff;
            letter-spacing: 1px;
            border: none;
            background: #4070f4;
            cursor: pointer;
        }

        .input-box.button input:hover {
            background: #0e4bf1;
        }

        form .text h3 {
            color: #333;
            width: 100%;
            text-align: center;
        }

        form .text h3 a {
            color: #4070f4;
            text-decoration: none;
        }

        form .text h3 a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Registration</h2>
        <form action="" method="POST">
            @csrf
            <div class="input-box mb-4">
                <input type="text" placeholder="Enter your first name" name="first_name" value="{{ old('first_name') }}">
                <div class="text-danger">
                    @if (!empty(session()->get('errors')))
                    {{ implode(' ' ,session()->get('errors')->get('first_name')) }}
                    @endif
                </div>
            </div>
            <div class="input-box mb-4">
                <input type="text" placeholder="Enter your last name" name="last_name" value="{{ old('last_name') }}">
                <div class="text-danger">
                    @if (!empty(session()->get('errors')))
                    {{ implode(' ' ,session()->get('errors')->get('last_name')) }}
                    @endif
                </div>
            </div>
            <div class="input-box mb-4">
                <input type="text" placeholder="Enter your age" name="age" value="{{ old('age') }}">
                <div class="text-danger">
                    @if (!empty(session()->get('errors')))
                    {{ implode(' ' ,session()->get('errors')->get('age')) }}
                    @endif
                </div>
            </div>
            <div class="input-box mb-4">
                <input type="number" placeholder="Enter your phone number" name="phone" value="{{ old('phone') }}">
                <div class="text-danger">
                    @if (!empty(session()->get('errors')))
                    {{ implode(' ' ,session()->get('errors')->get('phone')) }}
                    @endif
                </div>
            </div>
            <div class="input-box mb-4">
                <input type="email" placeholder="Enter your email" name="email" value="{{ old('email') }}">
                <div class="text-danger">
                    @if (!empty(session()->get('errors')))
                    {{ implode(' ' ,session()->get('errors')->get('email')) }}
                    @endif
                </div>
            </div>
            <div class="input-box mb-4">
                <input type="password" placeholder="Create password" name="password">
                <div class="text-danger">
                    @if (!empty(session()->get('errors')))
                    {{ implode(' ' ,session()->get('errors')->get('password')) }}
                    @endif
                </div>
            </div>
            <div class="input-box mb-4">
                <input type="password" placeholder="Confirm password" name="confirmPassword">
                <div class="text-danger">
                    @if (!empty(session()->get('errors')))
                    {{ implode(' ' ,session()->get('errors')->get('confirmPassword')) }}
                    @endif
                </div>
            </div>
            <div class="input-box button">
                <input type="Submit" value="Register Now">
            </div>
            <div class="text">
                <h3>Already have an account? <a href="{{ route('login') }}">Login now</a></h3>
            </div>
        </form>
    </div>
</body>

</html>