
    <!-- Body Section -->
        <div class="row mt-3 mb-5 no-gutters">
        <?php if(!empty($penghargaan)) { ?>
            <?php foreach ($penghargaan as $archive) : ?>
                    <div class="col-md-4">
                        <div class="card m-2">
                            <img class="card-img-top" style="height: 250px;" src="<?php echo base_url('/assets/img/uploads/'.$archive['foto_penghargaan']) ?>"
                                 alt="Card image">
                            <div class="card-body">
                                <h6 class="card-title font-weight-bold text-danger"><?=ucwords($archive['nama_penghargaan'])?></h6>
                                <p class="card-text text-justify small"><?=$archive['deskripsi_penghargaan']?></p>
                                <small class="text-muted">Diterima pada <?=$archive['tanggal_penghargaan']?></small>
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>
        <?php }else{ ?>
            <div class="col-md-12 mt-5">
                <h5 class="text-center">Belum Ada Data Penghargaan</h5>
            </div>
        <?php }  ?>
        </div>  