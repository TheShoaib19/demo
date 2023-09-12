<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>
  <a href="/dashboard" class="brand-link">
    <img src="{{ asset('assets/dist/img/dashboard1.png') }}" alt="Dashboard Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Dashboard</span>
  </a>

  <a href="{{ route('users') }}" class="brand-link">
    <img src="{{ asset('assets/dist/img/database.png') }}" alt="Data Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Users</span>
  </a>
  <a href="{{ route('logout') }}" class="brand-link">
    <img src="{{ asset('assets/dist/img/logout.png') }}" alt="Logout Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Logout</span>
  </a>
</aside>