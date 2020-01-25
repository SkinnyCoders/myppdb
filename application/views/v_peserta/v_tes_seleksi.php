  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark">Tes Buta Warna</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="<?= base_url('peserta') ?>">Dashboard</a></li>
                          <li class="breadcrumb-item"><a href="<?= base_url('peserta/seleksi') ?>">Seleksi</a></li>
                          <li class="breadcrumb-item active">Tes</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <!-- left column -->
                  <div class="col-md-12">
                      <!-- general form elements -->
                      <div class="card">
                          <!-- <div class="card-header">
                              <h3 class="card-title"><i class="fa fa-user"></i> </h3>
                          </div> -->
                          <!-- /.card-header -->
                          <!-- form start -->
                              <div class="card-body">
                                <form action="" method="post">
                                  <input type="hidden" name="id_tes" value="<?php echo $this->uri->segment(4) ?>">
                                <?php 
                                $no = 1;
                                $no_jawab = 0;
                                foreach ($soal as $data_soal) :
                                 ?>
                                <!-- start of soal -->
                                <div class="row mb-4">
                                  
                                  <div class="col-md-12">
                                    <h4 class="card-title mb-3"><?=$no?>. <?=ucfirst($data_soal['soal_tes_seleksi'])?></h4><br>
                                    <div class="row mt-3">
                                      <?php if ($data_soal['file_tes'] !== 'default.png') : ?>
                                        <div style="width: 320px;">
                                          <img style="width: 300px; height: 300px;" src="<?=base_url('assets/img/seleksi_file/'.$data_soal['file_tes'])?>">
                                        </div>
                                      <?php endif; ?>
      
                                      <div>
                                        <div class="form-group">
                                          <div class="custom-control custom-radio mb-2">
                                            <label for="a<?=$no?>">A.</label>
                                            <input class="custom-control-input" value="a" type="radio" id="a<?=$no?>" name="jawaban<?=$no_jawab?>">
                                            <label for="a<?=$no?>" class="custom-control-label"><?=$data_soal['jawaban_a']?></label>
                                          </div>
                                          <div class="custom-control custom-radio mb-2">
                                            <label for="b<?=$no?>">B.</label>
                                            <input class="custom-control-input" value="b" type="radio" id="b<?=$no?>" name="jawaban<?=$no_jawab?>">
                                            <label for="b<?=$no?>" class="custom-control-label"><?=$data_soal['jawaban_b']?></label>
                                          </div>
                                          <div class="custom-control custom-radio mb-2">
                                            <label for="c<?=$no?>">C.</label>
                                            <input class="custom-control-input" value="c" type="radio" id="c<?=$no?>" name="jawaban<?=$no_jawab?>">
                                            <label for="c<?=$no?>" class="custom-control-label"><?=$data_soal['jawaban_c']?></label>
                                          </div>
                                          <div class="custom-control custom-radio mb-2">
                                            <label for="d<?=$no?>">D.</label>
                                            <input class="custom-control-input" value="d" type="radio" id="d<?=$no?>" name="jawaban<?=$no_jawab++?>">
                                            <label for="d<?=$no++?>" class="custom-control-label"><?=$data_soal['jawaban_d']?></label>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <input type="hidden" name="id_soal[]" value="<?=$data_soal['id_soal_tes_seleksi']?>">
                                          <input type="hidden" name="jawaban_benar[]" value="<?=$data_soal['jawaban_benar']?>" >
                                        </div>
                                      </div>
                                      <!-- end form -->
                                    </div>
                                  </div>
                                </div>
                                <hr>
                              <?php endforeach; ?>

                                <!-- end of soal -->
                                
                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right" name="selesai">SELESAI!</button>
                                
                              </div>
                              </form>
                      </div>
                      <!-- /.card -->
                  </div>
              </div>
          </div>
      </section>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('templates/cdn_admin'); ?>