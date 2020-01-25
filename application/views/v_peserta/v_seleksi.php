  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark"><?= ucwords($title) ?></h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                          <li class="breadcrumb-item active">Seleksi</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
            <?php foreach ($tes_seleksi as $tes) :
              $id_tes = $tes['id_tes_seleksi'];
              $hasil = $this->db->get_where('hasil_tes_seleksi', ['id_peserta' => $this->session->userdata('id_peserta'), 'id_tes_seleksi' => $id_tes])->row_array();

              $total_soal = $this->db->get_where('soal_tes_seleksi', ['id_tes_seleksi' => $id_tes])->num_rows();
              $tes_seleksi = $this->db->get_where('tes_seleksi', ['id_tes_seleksi' => $id_tes])->row_array();
              ?>
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
                          
                            <input type="hidden" name="id_tes" value="<?=$id_tes?>">
                              <div class="card-body">
                                <h4 class="card-title"><i style="color:orange;" class="fas fa-trophy"></i> <?=ucwords($tes_seleksi['nama_tes_seleksi'])?></h4> <br>
                                <p class="text-muted"><?=ucfirst($tes_seleksi['deskripsi_tes_seleksi'])?></p>

                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer">
                                <p class="float-left"><strong>bobot :</strong> <?=$tes_seleksi['bobot_tes']?>% <br><strong>Jumlah Soal :</strong> <?=$total_soal?></p>
                               <?php if ($hasil !== NULL) { ?>
                                 <p class="float-right"><strong>Jumlah Benar :</strong> <?=$hasil['nilai_benar']?><br><strong>Nilai Akhir :</strong> <?=$hasil['nilai_akhir']?><br><strong>Dinyatakan :</strong> 
                                  <?php if ($hasil['status'] == 'lulus') {
                                    $status = 'Lulus';
                                    echo '<i style="color: green" class="fa fa-check"></i>';
                                  }else{
                                    $status = 'Tidak Lulus';
                                    echo '<i style="color: red" class="fa fa-times"></i>';
                                  } ?>
                                  <?=ucwords($status)?></p>
                               <?php }else{ ?>
                                 <a href="<?=base_url('peserta/seleksi/token/'.$id_tes)?>" class="btn btn-primary float-right">Ikuti Tes!</a>
                               <?php } ?>
                              </div>

                      </div>
                      <!-- /.card -->
                  </div>
              </div>
            <?php endforeach; ?>
          </div>
      </section>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('templates/cdn_admin'); ?>