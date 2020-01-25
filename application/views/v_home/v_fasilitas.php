


    <!-- Body Section -->
        <div class="row mt-3 mb-5 no-gutters">
        <?php if(!empty($fasilitas)) { ?>
            <?php foreach ($fasilitas as $f) : ?>
                    <div class="col-md-4">
                        <div class="card m-2">
                            <img class="card-img-top" style="height: 250px;" src="<?php echo base_url('/assets/img/uploads/'.$f['foto_fasilitas']) ?>"
                                 alt="Card image">
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold text-danger"><?=ucwords($f['nama_fasilitas'])?></h6>
                                <p class="card-text text-justify small"><?=$f['deskripsi_fasilitas']?></p>
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>
        <?php }else{ ?>
            <div class="col-md-12 mt-5">
                <h5 class="text-center">Belum Ada Data Fasilitas</h5>
            </div>

        <?php }  ?>
        </div>  

