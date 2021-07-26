{{-- <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
</li> --}}
<li class="menu-header">Manajemen</li>
    <li class="dropdown {{ Request::is('quiz*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Soal</span></a>
        <ul class="dropdown-menu" style="">
          <li class="{{ Route::is('quiz.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('quiz.index') }}">Daftar Soal</a></li>
          <li class=""><a class="nav-link" href="dashboard-ecommerce.html">Generate Soal</a></li>
        </ul>
      </li>
