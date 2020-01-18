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
                          <li class="breadcrumb-item"><a href="<?= base_url('admin/jalur_pendaftaran') ?>">Jalur Pendaftaran</a></li>
                          <li class="breadcrumb-item active">Perbarui</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <?php
        $syarat = json_decode($jalur['persyaratan'], true);

        ?>

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <!-- left column -->
                  <div class="col-md-12">
                      <!-- general form elements -->
                      <div class="card card-default ">
                          <div class="card-header">
                              <h3 class="card-title"><i class="fa fa-plus"></i> Perbarui jalur pendaftaran</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form action="" method="post" role="form" enctype="multipart/form-data">
                              <div class="card-body">
                                  <div class="form-group">
                                      <label for="nama">Jalur Pendaftaran</label>
                                      <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Jalur Pendaftaran" value="<?= ucwords($jalur['nama_jalur_pendaftaran']) ?>">
                                      <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-8">
                                          <div class="form-group">
                                              <label for="des">Deskripsi Jalur Daftar</label>
                                              <textarea id="des" name="deskripsi" class="form-control" style="height: 150px;" placeholder="Masukkan Deskripsi"><?= ucwords($jalur['keterangan']) ?></textarea>
                                              <small class="text-danger mt-2"><?= form_error('deskripsi') ?></small>
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                          <div class="form-group">
                                              <label for="des">Persyaratan</label>
                                              <textarea id="des" name="persyaratan" class="form-control" style="height: 150px;" placeholder="Pisahkan dengan enter"><?php foreach ($syarat as $s) {
                                                                                                                                                                        echo trim($s) . PHP_EOL;
                                                                                                                                                                    } ?>
                                            </textarea>
                                              <small class="text-danger mt-2"><?= form_error('persyaratan') ?></small>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- /.card-body -->

                              <div class="card-footer">
                                  <button type="submit" class="btn btn-primary">Simpan!</button>
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