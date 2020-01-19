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
                          <li class="breadcrumb-item active">Data Sekolah Asal</li>
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
                              <h3 class="card-title"><i class="fa fa-user"></i> Data Sekolah Asal Peserta</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form action="" method="post" role="form" enctype="multipart/form-data">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col-md-8">
                                          <div class="form-group">
                                              <label for="misi">Sekolah Asal <span class="text-danger">*</span></label>
                                              <input type="text" name="nama" class="form-control" placeholder="Nama Sekolah Asal" value="<?php if (!empty($data_sekolah)) {
                                                                                                                                                        echo $data_sekolah['nama_sekolah_asal'];
                                                                                                                                                    } else {
                                                                                                                                                        echo set_value('nama');
                                                                                                                                                    } ?>">
                                              <small class="text-danger mt-2"><?= form_error('nama') ?></small>


                                              <input type="hidden" name="id" class="form-control" value="<?php if (!empty($data_sekolah)) { echo $data_sekolah['id_data_sekolah_asal']; } ?>">
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="misi">No Telepon Sekolah <span class="text-danger">*</span></label>
                                              <input type="text" name="telp" class="form-control" placeholder="No Telp" value="<?php if (!empty($data_sekolah)) {
                                                                                                                                                        echo $data_sekolah['no_telp_sekolah_asal'];
                                                                                                                                                    } else {
                                                                                                                                                        echo set_value('telp');
                                                                                                                                                    } ?>">
                                              <small class="text-danger mt-2"><?= form_error('telp') ?></small>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Tahun Masuk</label>
                                              <div class="input-group">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                          <i class="far fa-calendar-alt"></i>
                                                      </span>
                                                  </div>
                                                  <input type="text" name="thn_masuk" class="form-control float-right" placeholder="Pilih Tahun" id="datepicker" value="<?php if (!empty($data_sekolah)) {
                                                                                                                                                        echo $data_sekolah['tahun_masuk_sekolah_asal'];
                                                                                                                                                    } else {
                                                                                                                                                        echo set_value('thn_masuk');
                                                                                                                                                    } ?>">
                                              </div>
                                              <!-- /.input group -->
                                              <small class="text-danger mt-2"><?= form_error('thn_masuk') ?></small>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Tahun Lulus</label>
                                              <div class="input-group">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                          <i class="far fa-calendar-alt"></i>
                                                      </span>
                                                  </div>
                                                  <input type="text" name="thn_lulus" class="form-control float-right" placeholder="Pilih Tahun" id="datepicker2" value="<?php if (!empty($data_sekolah)) {
                                                                                                                                                        echo $data_sekolah['tahun_lulus_sekolah_asal'];
                                                                                                                                                    } else {
                                                                                                                                                        echo set_value('thn_lulus');
                                                                                                                                                    } ?>">
                                              </div>
                                              <!-- /.input group -->
                                              <small class="text-danger mt-2"><?= form_error('thn_lulus') ?></small>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Alamat Sekolah</label>
                                      <textarea name="alamat" id="alamat" style="height: 150px;" class="form-control" placeholder="Alamat Sekolah Asal"><?php if (!empty($data_sekolah)) {
                                                                                                                                                        echo $data_sekolah['alamat_sekolah_asal'];
                                                                                                                                                    } else {
                                                                                                                                                        echo set_value('alamat');
                                                                                                                                                    } ?></textarea>
                                      <small class="text-danger mt-2"><?= form_error('alamat') ?></small>
                                  </div>
                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer">
                                  <button type="submit" class="btn btn-primary float-right">Simpan!</button>
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
              autoclose: true,
              format: 'yyyy',
              viewMode: "years",
              minViewMode: "years"
          })
      })
  </script>

  <script>
      $(function() {
          //Date picker
          $('#datepicker2').datepicker({
              autoclose: true,
              format: 'yyyy',
              viewMode: "years",
              minViewMode: "years"
          })
      })
  </script>