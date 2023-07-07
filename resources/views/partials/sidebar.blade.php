<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3"></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  @if(Auth::check() && Auth::user()->roles == 'admin')
  <li class="nav-item {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
    <a class="nav-link " href="{{ route('dashboard.admin') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider">
  <!-- Heading -->
  <div class="sidebar-heading">
    Manage Data
  </div>
  <!-- Nav Item - Charts -->
  <li class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('kategori.index') }}">
      <i class="fas fa-fw fa-table"></i>
      <span>Kategori</span></a>
  </li>
  <li class="nav-item {{ request()->routeIs('news.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('news.index') }}">
      <i class="fas fa-fw fa-newspaper"></i>
      <span>Berita</span></a>
  </li>
  <li class="nav-item {{ request()->routeIs('galeri.*') || request()->routeIs('slider.*') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
      <i class="fas fa-fw fa-images"></i>
      <span>Galeri</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Manage:</h6>
        <a class="collapse-item {{ request()->routeIs('galeri.*') ? 'active' : '' }}" href="/dashboard/admin/galeri">Galeri</a>
        <a class="collapse-item {{ request()->routeIs('slider.*') ? 'active' : '' }}" href="/dashboard/admin/slider">Slider</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/dashboard/admin/events">
      <i class="fas fa-fw fa-bullhorn"></i>
      <span>Events</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/dashboard/admin/umkm">
      <i class="fas fa-fw fa-users"></i>
      <span>UMKM</span></a>
  </li>
  <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
    <a class="nav-link" href="/dashboard/admin/users">
      <i class="fas fa-fw fa-users"></i>
      <span>Users</span></a>
  </li>
  @elseif(Auth::check() && Auth::user()->roles == 'user')
  <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('dashboard.user') ? 'active' : '' }}" href="{{ route('dashboard.user') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <li class="nav-item {{ request()->routeIs('user.news.*') ? 'active' : '' }}">
    <a class="nav-link" href="/dashboard/user/news">
      <i class="fas fa-fw fa-newspaper"></i>
      <span>Berita</span></a>
  </li>
  @elseif(Auth::check() && Auth::user()->roles == 'superAdmin')
  <li class="nav-item {{ request()->routeIs('dashboard.sa') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard.sa') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <div class="sidebar-heading">
    Manage Data
  </div>
  <li class="nav-item {{ request()->routeIs('sa.users.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('sa.users.index') }}">
      <i class="fas fa-fw fa-users"></i>
      <span>Users</span></a>
  </li>
  @endif
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>