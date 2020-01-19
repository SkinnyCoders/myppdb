<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <h3 class="text-header text-info text-bold my-auto ml-2">PPDB SMK MUHAMMADIYAH MLATI</h3>
    </li>
    <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
  </ul>

  <!-- SEARCH FORM -->
  <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?= base_url('auth/logout') ?>" class="nav-link">Logout</a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link mx-auto">
    <span style="margin-left: 30%;" class="brand-text font-weight-light font-weight-bolder text-nowrap" id="clock"></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url('assets/img/user/' . $this->session->userdata('foto')) ?>" class="img-circle elevation-2 mt-2" alt="User Image">
      </div>
      <div class="info">
        <h5 class="text-nowrap d-block text-header text-white"><?= ucwords($this->session->userdata('nama')) ?></h5>
        <span><small class="d-block text-muted"><?= ucwords($this->session->userdata('nama_role')) ?></small></span>


      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <!--           <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/pengguna') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengguna</p>
                </a>
              </li>
            </ul>
          </li> -->
        <?php if ($this->session->userdata('role') == 1) { ?>
          <li class="nav-item">
            <a href="<?= base_url('kepsek') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger"><i class="fa fa-cog"></i></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('kepsek/pendaftar') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Pendaftar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('kepsek/pendaftar/diterima') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Peserta Diterima
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('kepsek/pendaftar/dicadangkan') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Peserta Dicadangkan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('kepsek/pendaftar/ditolak') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Peserta Ditolak
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('kepsek/pendaftar/daftar-ulang') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Peserta Daftar Ulang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('kepsek/pendaftar/ditolak') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Pembayaran
              </p>
            </a>
          </li>
        <?php } elseif ($this->session->userdata('role') == 2) {
        ?>
          <li class="nav-item">
            <a href="<?= base_url('admin') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger"><i class="fa fa-cog"></i></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/pengguna') ?>" class="nav-link">
              <i class="nav-icon fa fa-user-circle"></i>
              <p>
                Pengguna
                <span class="right badge badge-danger"><i class="fa fa-cog"></i></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/sekolah/profil') ?>" class="nav-link">
              <i class="nav-icon fa fa-school"></i>
              <p>
                Profil Sekolah
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/sekolah/penghargaan') ?>" class="nav-link">
              <i class="nav-icon fa fa-trophy"></i>
              <p>
                Penghargaan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/sekolah/fasilitas') ?>" class="nav-link">
              <i class="nav-icon fa fa-building"></i>
              <p>
                Fasilitas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/sekolah/tahun_ajaran') ?>" class="nav-link">
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                Tahun Ajaran
                <span class="right badge badge-danger"><i class="fa fa-cog"></i></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/sekolah/kuota') ?>" class="nav-link">
              <i class="nav-icon fa fa-cog"></i>
              <p>
                Kouta Pendaftaran
                <span class="right badge badge-danger"><i class="fa fa-cog"></i></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/sekolah/program_studi') ?>" class="nav-link">
              <i class="nav-icon fa fa-graduation-cap"></i>
              <p>
                Program Studi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/jalur_pendaftaran') ?>" class="nav-link">
              <i class="nav-icon fa fa-graduation-cap"></i>
              <p>
                Jalur Pendaftaran
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/jadwal_pendaftaran') ?>" class="nav-link">
              <i class="nav-icon fa fa-graduation-cap"></i>
              <p>
                Jadwal Pendaftaran
              </p>
            </a>
          </li>

        <?php } elseif ($this->session->userdata('role') == 3) { ?>
          <li class="nav-item">
            <a href="<?= base_url('admin/pengguna') ?>" class="nav-link">
              <i class="nav-icon fa fa-user-circle"></i>
              <p>
                Pengguna 2
                <span class="right badge badge-danger">Hot</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('operator/soal-seleksi') ?>" class="nav-link">
              <i class="nav-icon fa fa-check"></i>
              <p>
                Soal Seleksi
              </p>
            </a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a href="<?= base_url('peserta/dashboard') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Data Peserta
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('peserta/data_diri') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Diri</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('peserta/data_ortu') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Ortu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('peserta/sekolah_asal') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Sekolah</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('peserta/data_berkas') ?>" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Data Berkas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('peserta/seleksi') ?>" class="nav-link">
              <i class="nav-icon fa fa-trophy"></i>
              <p>
                Tes Seleksi
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Setting Akun
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-user-o nav-icon"></i>
                  <p>Profil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/pengguna') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Keluar</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>