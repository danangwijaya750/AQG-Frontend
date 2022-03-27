{{-- <li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
</li> --}}
@if(Auth()->user()->role->name == 'user')
<li class="menu-header">Manajemen</li>
<li class="dropdown {{ Request::is('quiz*') ? 'active' : '' }}">
    <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i><span>Soal</span></a>
    <ul class="dropdown-menu" style="">
        <li class="{{ Route::is('quiz.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('quiz.index') }}">Daftar Soal</a></li>
        <li class="{{ Route::is('quiz.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('quiz.create') }}">Generate Soal</a></li>
    </ul>
</li>

<li class="dropdown {{ Request::is('study*') ? 'active' : '' }}">
    <a href="{{ route('study.index') }}" class="nav-link"><i class="fas fa-lightbulb"></i><span>Materi</span></a>
</li>

@else
<li class="menu-header">Manajemen</li>
<li class="dropdown {{ Request::is('admin/quiz*') ? 'active' : '' }}">
    <a href="{{ route('admin.quiz.index') }}" class="nav-link"><i class="fas fa-th"></i><span>Soal</span></a>
</li>

<li class="dropdown {{ Request::is('admin/study*') ? 'active' : '' }}">
    <a href="{{ route('admin.study.index') }}" class="nav-link"><i class="fas fa-lightbulb"></i><span>Materi</span></a>
</li>

<li class="dropdown {{ Request::is('admin/user*') ? 'active' : '' }}">
    <a href="{{ route('admin.user.index') }}" class="nav-link"><i class="fas fa-users"></i><span>Pengguna</span></a>
</li>

<li class="dropdown {{ Request::is('admin/lesson*') ? 'active' : '' }}">
    <a href="{{ route('admin.lesson.index') }}" class="nav-link"><i class="fas fa-graduation-cap"></i><span>Mata Pelajaran</span></a>
</li>


<li class="dropdown {{ Request::is('admin/level*') ? 'active' : '' }}">
    <a href="{{ route('admin.level.index') }}" class="nav-link"><i class="fas fa-school"></i><span>Tingkat Pendidikan</span></a>
</li>
@endif

