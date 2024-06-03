<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">aesthetic.id</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Admin</li>
            <li class="dropdown {{ Request::routeIs('dashboard.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}" class="nav-link"><i
                        class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown {{ Request::routeIs('jam.index') ? 'active' : '' }}">
                <a href="{{ route('jam.index') }}" class="nav-link"><i class="fas fa-clock"></i><span>Waktu</span></a>
            </li>
            <li class="dropdown {{ Request::routeIs('slot.index') ? 'active' : '' }}">
                <a href="{{ route('slot.index') }}" class="nav-link"><i
                        class="fas fa-th-large"></i><span>Slot</span></a>
            </li>
            <li class="dropdown {{ Request::routeIs('jenis.index') ? 'active' : '' }}">
                <a href="{{ route('jenis.index') }}" class="nav-link"><i class="fas fa-tag"></i><span>Jenis</span></a>
            </li>
            <li class="dropdown {{ Request::routeIs('pendaftaran.index') ? 'active' : '' }}">
                <a href="{{ route('pendaftaran.index') }}" class="nav-link"><i
                        class="fas fa-file-alt"></i><span>Pendaftaran</span></a>
            </li>
            <li class="dropdown {{ Request::routeIs(['jadwal.index', 'jadwal.semua']) ? 'active' : '' }}">
                <a href="{{ route('jadwal.index') }}" class="nav-link"><i
                        class="fas fa-calendar-alt"></i><span>Jadwal</span></a>
            </li>

            <li class="dropdown {{ Request::routeIs('status.index') ? 'active' : '' }}">
                <a href="{{ route('status.index') }}" class="nav-link"><i class="fas fa-info-circle"></i><span>Status</span></a>
            </li>
            <li class="dropdown {{ Request::routeIs('laporan.index') ? 'active' : '' }}">
                <a href="" class="nav-link"><i class="fas fa-chart-bar"></i><span>Laporan</span></a>
            </li>
        </ul>
    </aside>
</div>
