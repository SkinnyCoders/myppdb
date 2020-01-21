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
                              <h3 class="card-title"><i class="fa fa-key"></i> Perbarui Password</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form action="" method="post" role="form" enctype="multipart/form-data">
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="misi">Password Baru <span class="text-danger">*</span></label>
                                  <input type="password" name="pass1" class="form-control" placeholder="Password Baru">
                                  <small class="text-danger mt-2"><?= form_error('pass1') ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="misi">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                  <input type="password" name="pass2" class="form-control" placeholder="Ulangi Password Baru">
                                  <small class="text-danger mt-2"><?= form_error('pass2') ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="misi">Password Lama <span class="text-danger">*</span></label>
                                  <input type="password" name="pass3" class="form-control" placeholder="Password Lama">
                                  <small class="text-danger mt-2"><?= form_error('pass3') ?></small>
                                </div>
                              </div>

                              <!-- /.card-body -->
                              <div class="card-footer">
                                  <button type="submit" class="btn btn-primary float-right">Perbarui!</button>
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