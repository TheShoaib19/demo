<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLTE 3 | Dashboard</title>
    @include('includes.css')
    @include('includes.js')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        @include('includes.header');
        <!-- Main Sidebar Container -->
        @include('includes.sidebar');
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

</body>
</html>