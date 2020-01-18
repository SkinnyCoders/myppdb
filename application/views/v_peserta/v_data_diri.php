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
                          <li class="breadcrumb-item active">Data Diri</li>
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
                              <h3 class="card-title"><i class="fa fa-user"></i> Data Diri Peserta</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form action="" method="post" role="form" enctype="multipart/form-data">
                              <div class="card-body">
                                  <div class="row">
                                      <div class="col-md-8">
                                          <div class="form-group">
                                              <label for="nama">Nama Lengkap <span class="text-danger">*</span> </label>
                                              <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Lengkap" value="<?php if (!empty($data_diri)) {
                                                                                                                                                            echo $data_diri['nama_lengkap'];
                                                                                                                                                        } else {
                                                                                                                                                            echo set_value('nama');
                                                                                                                                                        } ?>">
                                              <small class="text-danger mt-2"><?= form_error('nama') ?></small>

                                              <input type="hidden" name="id" value="<?php if (!empty($data_diri)) { echo $data_diri['id_data_diri'];} ?>">
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="nama">NISN <span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" name="nisn" id="nisn" placeholder="Masukkan NISN" value="<?php if (!empty($data_diri)) {
                                                                                                                                                    echo $data_diri['nisn'];
                                                                                                                                                } else {
                                                                                                                                                    echo set_value('nisn');
                                                                                                                                                } ?>">
                                              <small class="text-danger mt-2"><?= form_error('nisn') ?></small>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputPassword1">Jenis Kelamin <span class="text-danger">*</span></label>
                                      <div class="custom-control custom-radio">
                                          <input class="custom-control-input" value="L" type="radio" id="male" name="gender" <?php if($data_diri['jenis_kelamin'] == 'L'){ echo 'checked'; }?>>
                                          <label for="male" class="custom-control-label">Laki - Laki</label>
                                      </div>
                                      <div class="custom-control custom-radio">
                                          <input class="custom-control-input" value="P" type="radio" id="female" name="gender" <?php if($data_diri['jenis_kelamin'] == 'P'){ echo 'checked'; }?>>
                                          <label for="female" class="custom-control-label">Perempuan</label>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="nama">No Telpon</label>
                                              <input type="text" class="form-control" name="telp" id="nama" placeholder="Masukkan No Telp" value="<?php if (!empty($data_diri)) {
                                                                                                                                                        echo $data_diri['no_hp'];
                                                                                                                                                    } else {
                                                                                                                                                        echo set_value('telp');
                                                                                                                                                    } ?>">
                                              <small class="text-danger mt-2"><?= form_error('telp') ?></small>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="nama">Agama <span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" name="agama" id="nama" placeholder="Masukkan Agama" value="<?php if (!empty($data_diri)) {
                                                                                                                                                        echo $data_diri['agama'];
                                                                                                                                                    } else {
                                                                                                                                                        echo set_value('agama');
                                                                                                                                                    } ?>">
                                              <small class="text-danger mt-2"><?= form_error('agama') ?></small>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col-md-8">
                                          <div class="form-group">
                                              <label for="visi">Tempat Lahir <span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" name="tempat_lahir" id="nama" placeholder="Masukkan Tempat Lahir" value="<?php if (!empty($data_diri)) {
                                                                                                                                                                    echo $data_diri['tempat_lahir'];
                                                                                                                                                                } else {
                                                                                                                                                                    echo set_value('tempat_lahir');
                                                                                                                                                                } ?>">
                                              <small class="text-danger mt-2"><?= form_error('tempat_lahir') ?></small>
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Tanggal Lahir <span class="text-danger">*</span></label>
                                              <div class="input-group">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                          <i class="far fa-calendar-alt"></i>
                                                      </span>
                                                  </div>
                                                  <input type="text" name="tgl_lahir" class="form-control float-right" placeholder="Pilih tanggal" id="datepicker" value="<?php if (!empty($data_diri)) {
                                                                                                                                                            echo DateTime::createFromFormat('Y-m-d', $data_diri['tgl_lahir'])->format('m/d/Y'); 
                                                                                                                                                        } else {
                                                                                                                                                            echo set_value('tgl_lahir');
                                                                                                                                                        } ?>">
                                              </div>
                                              <!-- /.input group -->
                                              <small class="text-danger mt-2"><?= form_error('tgl_lahir') ?></small>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="misi">Alamat Rumah <span class="text-danger">*</span></label>
                                      <textarea id="misi" name="alamat" class="form-control" style="height: 150px;" placeholder="Masukkan Alamat Rumah"><?php if (!empty($data_diri)) {
                                                                                                                                                            echo $data_diri['alamat_rumah'];
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
              autoclose: true
          })
      })
  </script>

  <script>
      var loadFile1 = function(event) {
          var output = document.getElementById('output1');
          output.src = URL.createObjectURL(event.target.files[0]);
      };

      var loadFile2 = function(event) {
          var output = document.getElementById('output2');
          output.src = URL.createObjectURL(event.target.files[0]);
      };
  </script>