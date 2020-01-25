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
                              <h3 class="card-title"><i class="fa fa-user"></i> Data Akun Peserta</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form action="" method="post" role="form" enctype="multipart/form-data">
                              <div class="card-body">
                                <!-- <div class="form-group">
                                  <label for="misi">Username <span class="text-danger">*</span></label>
                                  <input type="text" name="username" class="form-control" placeholder="Username Peserta" value="<?php if(!empty($data_peserta)){
                                    echo $data_peserta['username_peserta'];
                                  } ?>">
                                  <small class="text-danger mt-2"><?= form_error('username') ?></small>
                                </div> -->
                                <div class="form-group">
                                  <label for="misi">Email <span class="text-danger">*</span></label>
                                  <input type="text" name="email" class="form-control" placeholder="Email Peserta" value="<?php if(!empty($data_peserta)){
                                    echo $data_peserta['email_peserta'];
                                  } ?>">
                                  <small class="text-danger mt-2"><?= form_error('email') ?></small>
                                </div>
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