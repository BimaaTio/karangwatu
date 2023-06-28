<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3"></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  @if(Auth::check() && Auth::user()->roles == 'admin')
  <li class="nav-item active">
    <a class="nav-link {{ request()->routeIs('dashboard.admin.*') ? 'active' : '' }}" href="{{ route('dashboard.admin') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    Manage
  </div>
  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}" href="/dashboard/admin/news">
      <i class="fas fa-fw fa-newspaper"></i>
      <span>Berita</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/dashboard/admin/galeri">
      <i class="fas fa-fw fa-images"></i>
      <span>Galeri</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/dashboard/admin/events">
      <i class="fas fa-fw fa-images"></i>
      <span>Events</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/dashboard/admin/umkm">
      <i class="fas fa-fw fa-users"></i>
      <span>UMKM</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/dashboard/admin/users">
      <i class="fas fa-fw fa-users"></i>
      <span>Users</span></a>
  </li>
  @elseif(Auth::check() && Auth::user()->roles == 'user')
  <li class="nav-item active">
    <a class="nav-link {{ request()->routeIs('dashboard.user.*') ? 'active' : '' }}" href="{{ route('dashboard.user') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('news.*') ? 'active' : '' }}" href="/dashboard/user/news">
      <i class="fas fa-fw fa-newspaper"></i>
      <span>Berita</span></a>
  </li>
  @endif
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>