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
                          <li class="breadcrumb-item"><a href="<?= base_url('admin/jadwal_pendaftaran') ?>">Jadwal Pendaftaran</a></li>
                          <li class="breadcrumb-item active">Tambah</li>
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
                      <div class="card card-default ">
                          <div class="card-header">
                              <h3 class="card-title"><i class="fa fa-plus"></i> Tambah jadwal pendaftaran</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form action="" method="post" role="form" enctype="multipart/form-data">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col-md-8">
                                          <label for="nama">Nama Kegiatan</label>
                                          <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kegiatan" value="<?php echo set_value('nama'); ?>">
                                          <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="des">Jalur Pendaftaran</label>
                                              <select name="jalur" id="" class="form-control">
                                                  <option value="">Pilih Jalur Pendaftaran</option>
                                                  <?php foreach ($jalur as $j) { ?>
                                                      <option value="<?= $j['id_jalur_pendaftaran'] ?>"><?= ucwords($j['nama_jalur_pendaftaran']) ?></option>
                                                  <?php } ?>
                                              </select>
                                              <small class="text-danger mt-2"><?= form_error('jalur') ?></small>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Tanggal Mulai</label>
                                              <div class="input-group">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                          <i class="far fa-calendar-alt"></i>
                                                      </span>
                                                  </div>
                                                  <input type="text" name="tgl_mulai" class="form-control float-right" placeholder="Pilih Tanggal" id="datepicker">
                                              </div>
                                              <!-- /.input group -->
                                              <small class="text-danger mt-2"><?= form_error('tgl_mulai') ?></small>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Tanggal Berakhir</label>
                                              <div class="input-group">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                          <i class="far fa-calendar-alt"></i>
                                                      </span>
                                                  </div>
                                                  <input type="text" name="tgl_akhir" class="form-control float-right" placeholder="Pilih Tanggal" id="datepicker2">
                                              </div>
                                              <!-- /.input group -->
                                              <small class="text-danger mt-2"><?= form_error('tgl_akhir') ?></small>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- /.card-body -->

                              <div class="card-footer">
                                  <button type="submit" class="btn btn-primary">Tambahkan!</button>
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
  <!-- bootstrap datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script>
      $(function() {
          //Date picker
          $('#datepicker').datepicker({
              autoclose: true
          })
      })
  </script>

  <script>
      $(function() {
          //Date picker
          $('#datepicker2').datepicker({
              autoclose: true
          })
      })
  </script>