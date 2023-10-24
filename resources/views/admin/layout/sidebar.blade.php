<nav class="navbar-vertical navbar">
    <div class="nav-scroller">
        <!-- Brand logo -->
        <a class="navbar-brand" href="./index.html">
            {{-- <img src="./assets-admin/images/brand/logo/logo.svg" alt="" /> --}}
            <h1 class="text-white fw-bold">SiParkir</h1>
        </a>
        <!-- Navbar nav -->
        <ul class="navbar-nav flex-column" id="sideNavbar">
            <li class="nav-item">
                <a class="nav-link has-arrow=" href="/dashboard">
                    <i data-feather="home" class="nav-icon icon-xs me-2"></i>  Dashboard
                </a>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <div class="navbar-heading">Manajemen</div>
            </li>
            <!-- Nav item -->
            <li class="nav-item">
                <a class="nav-link has-arrow  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navPages" aria-expanded="false" aria-controls="navPages">
                    <i data-feather="layers" class="nav-icon icon-xs me-2"></i> Data Parkir
                </a>

                <div id="navPages" class="collapse " data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="/lahanParkir">Data Lahan Parkir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow"  href="/logParkir" >Log Histori Parkir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link has-arrow"  href="/maintenancealat" >Maintenance Alat IoT</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="./pages/layout.html">
                    <i data-feather="layers" class="nav-icon icon-xs me-2">
                    </i>Layouts
                </a>
            </li>
        </ul>
    </div>
</nav>