<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/images/logo_ipb.svg') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">IPB Transkrip Nilai</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Aliamat Parinduri</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == "dashboard" ? "active" : "" ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">Data Master</li>
                <li class="nav-item">
                    <a href="<?= base_url('jurusan') ?>" class="nav-link <?= $this->uri->segment(1) == "jurusan" ? "active" : "" ?>">
                        <i class="fas fa-fw fa-graduation-cap"></i>
                        <p>
                            Data Jurusan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('mata_kuliah') ?>" class="nav-link <?= $this->uri->segment(1) == "mata_kuliah" ? "active" : "" ?>">
                        <i class="fas fa-book-open"></i>
                        <p>
                            Data Mata Kuliah
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('mahasiswa') ?>" class="nav-link <?= $this->uri->segment(1) == "mahasiswa" ? "active" : "" ?>">
                        <i class="fas fa-fw fa-users"></i>
                        <p>
                            Data Mahasiswa
                        </p>
                    </a>
                </li>
                <li class="nav-header">Data Transaksi</li>

                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link <?= $this->uri->segment(1) == "transkrip_nilai" ? "active" : "" ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Data Transkrip Nilai
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('transkrip_nilai/add_transkrip') ?>" class="nav-link <?= $this->uri->segment(1) == "transkrip_nilai" && $this->uri->segment(2) == "add_transkrip" ? "active" : "" ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Data Transkrip</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('transkrip_nilai') ?>" class="nav-link <?= $this->uri->segment(1) == "transkrip_nilai" && $this->uri->segment(2) == null ? "active" : "" ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lihat Data Transkrip</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">Data Report</li>

                <li class="nav-item">
                    <a href="<?= base_url('report') ?>" class="nav-link <?= $this->uri->segment(1) == "report" ? "active" : "" ?>">
                        <i class="fas fa-file-pdf"></i>
                        <p>
                            Report Transkrip Nilai
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>