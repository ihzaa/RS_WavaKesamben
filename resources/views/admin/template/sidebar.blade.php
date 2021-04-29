<div class="sidebar">
    <!-- Sidebar user (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <i class="fas fa-hospital-alt" style="font-size: 3em; color: white;"></i>
        </div>
        <div class="info">
            <a href="#" class="d-block">Admin</a>
        </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
   with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard (JGN DIHAPUS INI CONTOH DULU)
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="../../index.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../index2.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v2</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../../index3.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v3</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="../widgets.html" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Widgets (JGN DIHAPUS INI CONTOH DULU)
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>
            <li class="nav-item {{ str_contains(Route::currentRouteName(), 'home') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ str_contains(Route::currentRouteName(), 'home') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Halaman Home
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.home.carousel.index') }}"
                            class="nav-link {{ str_contains(Route::currentRouteName(), 'carousel') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Banner</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.home.sambutanDirektur.index') }}"
                            class="nav-link {{ str_contains(Route::currentRouteName(), 'sambutanDirektur') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Sambutan Direktur</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.home.angket.index') }}"
                            class="nav-link {{ str_contains(Route::currentRouteName(), 'angket') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Angket</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.home.galeri.index') }}"
                            class="nav-link {{ str_contains(Route::currentRouteName(), 'galeri') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Galeri</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.home.instagram.index') }}"
                            class="nav-link {{ str_contains(Route::currentRouteName(), 'instagram') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Galeri Instagram</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.profile.index') }}"
                    class="nav-link {{ str_contains(Route::currentRouteName(), 'profile') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-hospital-user"></i>
                    <p>
                        Profil
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.featuredproduct.index') }}"
                    class="nav-link {{ str_contains(Route::currentRouteName(), 'featuredproduct') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-people-carry"></i>
                    <p>
                        Produk Unggulan
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.department.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Klinik Spesialis
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
