<?php 
if (!empty($petunjuk['file_petunjuk']) || $petunjuk['file_petunjuk'] !== NULL) : ?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-primary text-center">
            <p>Anda dapat mendownload file panduan pendaftaran </p><a target="_blank" href="<?=base_url('assets/uploads/berkas_info/'.$petunjuk['file_petunjuk'])?>" class="btn btn-sm btn-flat btn-success"><i class=" fa fa-download"></i> Download Panduan</a>
        </div>
    </div>
</div>
<?php
endif;
 ?>
<div class="row">
    <div class="col-md-12">
    <!-- Registration Picture Foundation -->
    <?php if (!empty($petunjuk['gambar'])) : ?>
        <div class="row justify-content-center text-center my-3">
            <div class="col-md-11 border">
                <img src="<?= base_url('assets/img/uploads/'.$petunjuk['gambar'])?>"
                             class="img-fluid" alt="Image Content">
            </div>
        </div>
        <?php endif; ?>
        <!-- End Registration Picture Foundation -->

        <?php $petunjuk_json = json_decode($petunjuk['keterangan'], true); $no = 1;?>

        <!-- Registration Process Section -->
        <div class="row my-3 mb-3 justify-content-center">
            <?php foreach ($petunjuk_json as $i): ?>
            <div class="col-md-3 m-1 py-2 border rounded">
                <h3 class="d-none d-sm-inline text-danger font-weight-bold"><?= $no++; ?>. </h3>
                <h6 class="d-inline"><?= trim($i)?></h6>  
            </div>
            <?php endforeach; ?>
        </div>
        <!-- End Registration Process Section -->
    </div>
</div>