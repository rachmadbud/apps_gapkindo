@php
use App\Models\CustomClass;
@endphp

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    @auth
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars">
          Hello, {{ auth()->user()->name }}
        </i></a>
    </li>
  </ul>
  @endauth

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{app(CustomClass::class)->rootApp()}}/gantiPassword" class="dropdown-item">
            <i class="fas fa-key mr-2"></i> Ganti Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('signout') }}" class="dropdown-item dropdown-footer"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </li>
    </ul>

</nav>
<!-- /.navbar -->