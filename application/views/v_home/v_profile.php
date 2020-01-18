
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Picture Foundation -->
                 <div class="row justify-content-center text-center my-3">
                    <div class="col-md-10 pt-3">
                    <a class="navbar-brand ml-2" href="">
                        <img src="<?= base_url('assets/img/logo/LOGO-SMK.png'); ?>" width="70%">
                    </a>
                    </div>
                </div>
                <!-- End Profile Picture Foundation -->

                <!-- Profile Foundation Section -->
                <div class="row mx-1 my-3">
                    <div class="col-md-12 py-2">
                        <h5 class="font-weight-bold text-dark"><?php echo ucwords($profil['nama_sekolah'])?></h5>
                        <hr class="m-0">
                        <p class="text-justify mx-2 text-secondary"><?php echo ucwords($profil['profil_sekolah'])?></p>
                    </div>
                </div>
                <!-- End Profile Foundation Section -->

                <!-- Vision and Mission Foundation Section -->
                <div class="row mx-1 my-3">
                    <div class="col-md-6 py-2">
                        <h6 class="font-weight-bold text-danger">Visi</h6>
                        <hr class="m-0">
                        <p class="text-justify mx-2 text-secondary"><?php echo ucwords($profil['visi_sekolah'])?></p>
                    </div>
                    <div class="col-md-6 py-2">
                        <h6 class="font-weight-bold text-danger">Misi</h6>
                        <hr class="m-0">
                        <ol class="text-secondary mx-0">
                        <?php 
                        $misi = json_decode($profil['misi_sekolah'], true);

                        foreach ($misi as $m) {
                            echo '<li>'.$m.'</li>';
                        }
                        ?>
                        </ol>
                    </div>
                </div>
                <!-- End Vision and Mission Foundation Section -->

                <!-- Head of Foundation Section -->
                <div class="row text-center p-3 my-3">
                    <div class="col-md-12 text-justify">
                        <h5 class="font-weight-bold text-dark">Ketua Yayasan</h5>
                        <hr class="m-0">
                    </div>
                    <img src="<?= base_url('assets/img/uploads/'.$profil['foto_kepala_sekolah']); ?>" alt="Head of Foundation" class="col-md-2 my-3 mx-1 rounded-circle">
                    <div class="col-md text-justify">
                        <h4 class="mt-2"><?php echo ucwords($profil['nama_kepala_sekolah'])?></h4>
                        <p class="mx-2 text-secondary"><?php echo ucwords($profil['sambutan_kepala_sekolah'])?></p>
                    </div>
                </div>
                <!-- End Head of Foundation Section -->

                <div class="row">
                    <div class="col-md-6">
                        <span>
                            <h6 class="text-danger font-weight-bold">Alamat</h6>
                            <address>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</address>
                        </span>
                    </div> 
                    <div class="col-md-6">
                        <span>
                            <h6 class="text-danger font-weight-bold">Kontak</h6>
                            <ul>
                                <?php 
                                $kontak = json_decode($profil['kontak_sekolah'], true);
                                 ?>
                                <li><b>No Telp</b> <?=$kontak['telp']?></li>
                                <li><b>Email</b> <?=$kontak['email']?></li>
                                <li><b>Sosial Media </b><?=$kontak['social']?></li>
                            </ul>
                        </span>
                    </div>   
                </div>
                
                

            </div>
        </div>