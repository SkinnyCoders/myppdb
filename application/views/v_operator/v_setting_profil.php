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
                          <li class="breadcrumb-item active">Setting Akun</li>
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
                              <h3 class="card-title"><i class="fa fa-user"></i> Data Akun Operator</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form action="" method="post" role="form" enctype="multipart/form-data">
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="misi">Nama <span class="text-danger">*</span></label>
                                  <input type="text" name="nama" class="form-control" placeholder="Username Peserta" value="<?php if(!empty($data_peserta)){
                                    echo $data_peserta['nama_pengguna'];
                                  } ?>">
                                  <small class="text-danger mt-2"><?= form_error('username') ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="misi">Email <span class="text-danger">*</span></label>
                                  <input type="text" name="email" class="form-control" placeholder="Email Peserta" value="<?php if(!empty($data_peserta)){
                                    echo $data_peserta['email_pengguna'];
                                  } ?>">
                                  <small class="text-danger mt-2"><?= form_error('email') ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Jenis Kelamin</label>
                                  <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value="L" type="radio" id="male" name="gender" <?php if($data_peserta['jenis_kelamin'] == 'L'){ echo 'checked';}?>>
                                    <label for="male" class="custom-control-label">Laki - Laki</label>
                                  </div>
                                  <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value="P" type="radio" id="female" name="gender" <?php if($data_peserta['jenis_kelamin'] == 'P'){ echo 'checked';}?>>
                                    <label for="female" class="custom-control-label">Perempuan</label>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputFile">Foto Pengguna</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" name="foto" onchange="loadFile(event)" id="exampleInputFile">
                                      <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                                    </div>
                                  </div>
                                </div>
                                <img class="mt-2 mb-2 img-preview" src="<?=base_url('assets/img/user/'.$data_peserta['foto_pengguna'])?>" id="output">
                                <!-- <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="misi">Password Baru <span class="text-danger">*</span></label>
                                      <input type="text" name="email" class="form-control" placeholder="Email Peserta">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="misi">Ulangi Password Baru <span class="text-danger">*</span></label>
                                      <input type="text" name="email" class="form-control" placeholder="Email Peserta">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="misi">Password lama <span class="text-danger">*</span></label>
                                      <input type="text" name="email" class="form-control" placeholder="Email Peserta">
                                    </div>
                                  </div>
                                </div> -->
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

  <script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
    };
  </script>