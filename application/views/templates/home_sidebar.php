    <!-- Start Sidebar Yayasan -->
    <ul class="navbar-nav sidebar sidebar-light bg-light pt-5" id="accordionSidebar">
        <!-- Heading -->
        <div class= mt-4></div>
        <!--<div class="sidebar-heading mt-3 d-none d-sm-block">
        Yayasan
        </div> -->

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(); ?>">
        <div class="sidebar-brand-icon">
            <!-- <img src="<?= base_url('uploads/foundation/default.jpg'); ?>"
                 width="30" height="30" class="d-inline-block align-top"> -->
        </div>
        <div class="sidebar-brand-text mx-3">
            <span class="font-weight-bold" id="clock"></span>
            <br>
            <span class="font-weight-bold"><?=$salam?></span>

        </div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Nav Item - Registration Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse"
           data-target="#collapseRegistration" aria-expanded="true" aria-controls="collapseRegistration">
            <i class="fa fa-fw fa-list-alt"></i>
            <span>Pendaftaran</span>
        </a>
        <div id="collapseRegistration" class="collapse" aria-labelledby="headingRegistration" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Informasi Pendaftaran:</h6>
            <a class="collapse-item tombol" id="petunjuk-pendaftaran">Petunjuk Pendaftaran</a>
            <a class="collapse-item tombol" id="jalur-pendaftaran">Jalur Pendaftaran</a>
            <a class="collapse-item tombol" id="biaya-pendaftaran">Biaya Pendidikan</a>
        </div>
        </li>

        <!-- Nav Item - About Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-landmark"></i>
            <span>Tentang</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tentang Kami:</h6>
            <a class="collapse-item tombol" id="profil">Profil</a>
            <a class="collapse-item tombol" id="fasilitas">Fasilitas</a>
            <a class="collapse-item tombol" id="penghargaan">Penghargaan</a>
        </div>
        </li>


        <!-- Nav Item - Pendidikan Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePendidikan"
           aria-expanded="true" aria-controls="collapsePendidikan">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>Jurusan</span>
        </a>
        <div id="collapsePendidikan" class="collapse" aria-labelledby="headingPendidikan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Jurusan Pendidikan:</h6>
                <?php 
                $jurusan = $this->db->get('program_studi')->result_array();
                foreach ($jurusan as $j) {
                    // $string = 'Teknik Kendaraan Ringan';
                    $hasil = str_word_count($j['nama_program_studi']);

                    if ($hasil > 1) {
                        $arr = explode(' ', strtoupper($j['nama_program_studi']));
                        $singkat = '';

                        foreach ($arr as $kata) {
                            $singkat.=substr($kata, 0,1);
                        }
                    }else{
                        $singkat = ucwords($j['nama_program_studi']);
                    }

                    echo ' <a class="collapse-item tombol" id="jurusan/'.$j['slug'].'">
                    '.$singkat.'
                </a>';
                }
                 ?>              
            </div>
        </div>
        </li>

        <!-- Nav Item - Informasi Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInformasi"
           aria-expanded="true" aria-controls="collapseInformasi">
            <i class="fas fa-fw fa-info-circle"></i>
            <span>Informasi</span>
        </a>
        <div id="collapseInformasi" class="collapse" aria-labelledby="headingInformasi" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Informasi Kami:</h6>
            <a class="collapse-item tombol" id="pengumuman">Informasi</a>
            <a class="collapse-item tombol" id="faq">FAQ</a>
            </div>
        </div>
        </li>

        <!-- Nav Item - Dasar Collapse Menu
        <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-address-book"></i>
            <span>Kontak</span>
        </a>
        </li>
        -->
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End Sidebar Peserta -->