<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">

      <h3 class="text-header text-info text-bold my-auto ml-2"><img class="image" style="width: 40px;" src="<?= base_url('assets/img/logo/logo-smk.png'); ?>"> PPDB SMK MUHAMMADIYAH MLATI</h3>
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
    <?php if ($this->session->userdata('role') == 4) { ?>
        <a href="<?= base_url('auth/logout_peserta') ?>" class="nav-link"><i class="fas fa-arrow-circle-right nav-icon"></i> Logout</a>
    <?php }else{ ?>
      <a href="<?= base_url('auth/logout') ?>" class="nav-link"><i class="fas fa-arrow-circle-right nav-icon"></i> Logout</a>
    <?php } ?>
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
        <?php if (!empty($this->session->userdata('foto'))) { ?>
          <img src="<?= base_url('assets/img/user/' . $this->session->userdata('foto')) ?>" class="img-circle elevation-2 mt-2" alt="User Image">
        <?php }else{ ?>
          <img src="<?= base_url('assets/img/user/default.png') ?>" class="img-circle elevation-2 mt-2" alt="User Image">
        <?php } ?>
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
<!--           <li class="nav-item">
            <a href="<?= base_url('kepsek/pendaftar') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Pendaftar
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="<?= base_url('kepsek/peserta/diterima') ?>" class="nav-link">
              <i class="nav-icon fa fa-check"></i>
              <p>
                Peserta Diterima
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('kepsek/peserta/dicadangkan') ?>" class="nav-link">
              <i class="nav-icon fa fa-bookmark"></i>
              <p>
                Peserta Dicadangkan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('kepsek/peserta/ditolak') ?>" class="nav-link">
              <i class="nav-icon fa fa-times"></i>
              <p>
                Peserta Ditolak
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?= base_url('kepsek/peserta/daftar_ulang') ?>" class="nav-link">
              <i class="nav-icon fa fa-undo"></i>
              <p>
                Peserta Daftar Ulang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('kepsek/peserta/cabut_berkas') ?>" class="nav-link">
              <i class="nav-icon fa fa-arrow-right"></i>
              <p>
                Peserta Cabut Berkas
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
              <a href="<?=base_url('kepsek/setting/profil')?>" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Profil</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="<?=base_url('kepsek/setting/password')?>" class="nav-link">
                  <i class="fas fa-key nav-icon"></i>
                  <p>Ubah Password</p>
                </a>
              </li>
            </ul>
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
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-bars"></i>
              <p>
                Sekolah
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
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
                <a href="<?= base_url('admin/sekolah/program_studi') ?>" class="nav-link">
                  <i class="nav-icon fa fa-graduation-cap"></i>
                  <p>
                    Program Studi
                  </p>
                </a>
              </li>
              
            </ul>
          </li>
          <!-- -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-bars"></i>
              <p>
                Pendaftaran
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/pendaftaran/kuota') ?>" class="nav-link">
                  <i class="nav-icon fa fa-graduation-cap"></i>
                  <p>
                    Kouta Pendaftaran
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/pendaftaran/jadwal') ?>" class="nav-link">
                  <i class="nav-icon fa fa-graduation-cap"></i>
                  <p>
                    Jadwal Pendaftaran
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/pendaftaran/jalur') ?>" class="nav-link">
                  <i class="nav-icon fa fa-graduation-cap"></i>
                  <p>
                    Jalur Pendaftaran
                  </p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="<?= base_url('admin/pendaftaran/petunjuk') ?>" class="nav-link">
                  <i class="nav-icon fa fa-graduation-cap"></i>
                  <p>
                    Petunjuk Pendaftaran
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/pendaftaran/biaya_masuk') ?>" class="nav-link">
                  <i class="nav-icon fa fa-graduation-cap"></i>
                  <p>
                    Biaya Masuk
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <!---->
          <li class="nav-item">
            <a href="<?= base_url('admin/pengguna') ?>" class="nav-link">
              <i class="nav-icon fa fa-user-circle"></i>
              <p>
                Pengguna
                
              </p>
            </a>
          </li>
          
          
          <li class="nav-item">
            <a href="<?= base_url('admin/sekolah/tahun_ajaran') ?>" class="nav-link">
              <i class="nav-icon fa fa-calendar"></i>
              <p>
                Tahun Ajaran
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('admin/informasi') ?>" class="nav-link">
              <i class="nav-icon fa fa-info"></i>
              <p>
                Informasi
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('admin/faq') ?>" class="nav-link">
              <i class="nav-icon fa fa-question"></i>
              <p>
                FAQ
               
              </p>
            </a>
          </li>
        
        <?php } elseif ($this->session->userdata('role') == 3) { ?>
          <li class="nav-item">
            <a href="<?= base_url('operator/dashboard') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p>
                Dashboard
                <span class="right badge badge-danger">Hot</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('operator/soal-seleksi') ?>" class="nav-link">
              <i class="nav-icon fa fa-circle"></i>
              <p>
                Soal Seleksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('operator/pendaftar/list') ?>" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Pendaftar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('operator/verifikasi/data') ?>" class="nav-link">
              <i class="nav-icon fa fa-hourglass-half"></i>
              <p>
                Verifikasi Data
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('operator/verifikasi/berkas') ?>" class="nav-link">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Verifikasi Berkas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('operator/pendaftar/penerimaan') ?>" class="nav-link">
              <i class="nav-icon fa fa-check"></i>
              <p>
                Penerimaan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('operator/pendaftar/cabut_berkas') ?>" class="nav-link">
              <i class="nav-icon fa fa-times"></i>
              <p>
                Cabut Berkas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('operator/daftar_ulang') ?>" class="nav-link">
              <i class="nav-icon fa fa-undo"></i>
              <p>
                Daftar Ulang
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
              <a href="<?=base_url('operator/setting/profil')?>" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Profil</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="<?=base_url('operator/setting/password')?>" class="nav-link">
                  <i class="fas fa-key nav-icon"></i>
                  <p>Ubah Password</p>
                </a>
              </li>
            </ul>
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
          <li class="nav-item">
            <a href="<?= base_url('peserta/cabut_berkas') ?>" class="nav-link">
              <i class="nav-icon fa fa-exclamation-circle"></i>
              <p>
                Cabut Berkas
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
              <a href="<?=base_url('peserta/setting/profil')?>" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Profil</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="<?=base_url('peserta/setting/password')?>" class="nav-link">
                  <i class="fas fa-key nav-icon"></i>
                  <p>Ubah Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('auth/logout_peserta') ?>" class="nav-link">
                  <i class="fas fa-arrow-circle-right nav-icon"></i>
                  <p>Keluar</p>
                </a>
              </li>
            </ul>
          </li>
          <?php
          $petunjuk = $this->db->get('petunjuk_pendaftaran')->row_array();
          if (!empty($petunjuk['file_petunjuk']) || $petunjuk['file_petunjuk'] !== NULL) : ?>
          <li class="nav-item">
            <a href="<?=base_url('assets/uploads/berkas_info/'.$petunjuk['file_petunjuk'])?>" class="btn btn-block btn-primary" target="_blank">
              <i class="nav-icon fa fa-download"></i>
                Download Petunjuk
            </a>
          </li>
        <?php endif; ?>
        <?php } ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>