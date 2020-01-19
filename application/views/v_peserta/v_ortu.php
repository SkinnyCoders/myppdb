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
                          <li class="breadcrumb-item active">Data Orang Tua</li>
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
                              <h3 class="card-title"><i class="fa fa-user"></i> Data Orang Tua Peserta</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form action="" method="post" role="form" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?php if (!empty($data_ortu)) {
                                                                        echo $data_ortu['id_ortu'];
                                                                    } ?>">
                              <div class="card-body">
                                  <div class="form-group">
                                      <label for="nama">Nama Lengkap Ayah<span class="text-danger">*</span> </label>
                                      <input type="text" class="form-control" name="nama_ayah" id="nama" placeholder="Masukkan Nama Lengkap Ayah" value="<?php if (!empty($data_ortu)) {
                                                                                                                                                        echo $data_ortu['nama_ortu_ayah'];
                                                                                                                                                    } else {
                                                                                                                                                        echo set_value('nama_ayah');
                                                                                                                                                    } ?>">
                                      <small class="text-danger mt-2"><?= form_error('nama_ayah') ?></small>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="nama">Perkerjaan Ayah<span class="text-danger">*</span> </label>
                                              <input type="text" class="form-control" name="pekerjaan_ayah" id="nama" placeholder="Masukkan Pekerjaan Ayah" value="<?php if (!empty($data_ortu)) {
                                                                                                                                                                        echo $data_ortu['pekerjaan_ortu_ayah'];
                                                                                                                                                                    } else {
                                                                                                                                                                        echo set_value('pekerjaan_ayah');
                                                                                                                                                                    } ?>">
                                              <small class="text-danger mt-2"><?= form_error('pekerjaan_ayah') ?></small>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="nama">No Telpon Ayah <span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" name="telp_ayah" id="nisn" placeholder="Masukkan No Telp Ayah" value="<?php if (!empty($data_ortu)) {
                                                                                                                                                        echo $data_ortu['no_hp_ortu_ayah'];
                                                                                                                                                    } else {
                                                                                                                                                        echo set_value('telp_ayah');
                                                                                                                                                    } ?>">
                                              <small class="text-danger mt-2"><?= form_error('telp_ayah') ?></small>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="misi">Alamat Ayah <span class="text-danger">*</span></label>
                                      <textarea id="misi" name="alamat_ayah" class="form-control" style="height: 150px;" placeholder="Masukkan Alamat Ayah"><?php if (!empty($data_ortu)) {
                                                                                                                                                                    echo $data_ortu['alamat_ortu_ayah'];
                                                                                                                                                                } else {
                                                                                                                                                                    echo set_value('alamat_ayah');
                                                                                                                                                                } ?></textarea>
                                      <small class="text-danger mt-2"><?= form_error('alamat') ?></small>
                                  </div>

                                  <hr>

                                  <div class="form-group">
                                      <label for="nama">Nama Lengkap ibu<span class="text-danger">*</span> </label>
                                      <input type="text" class="form-control" name="nama_ibu" id="nama" placeholder="Masukkan Nama Lengkap Ibu" value="<?php if (!empty($data_ortu)) {
                                                                                                                                                            echo $data_ortu['nama_ortu_ibu'];
                                                                                                                                                        } else {
                                                                                                                                                            echo set_value('nama_ibu');
                                                                                                                                                        } ?>">
                                      <small class="text-danger mt-2"><?= form_error('nama_ibu') ?></small>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="nama">Perkerjaan ibu<span class="text-danger">*</span> </label>
                                              <input type="text" class="form-control" name="pekerjaan_ibu" id="nama" placeholder="Masukkan Pekerjaan Ibu" value="<?php if (!empty($data_ortu)) {
                                                                                                                                                                    echo $data_ortu['pekerjaan_ortu_ibu'];
                                                                                                                                                                } else {
                                                                                                                                                                    echo set_value('pekerjaan_ibu');
                                                                                                                                                                } ?>">
                                              <small class="text-danger mt-2"><?= form_error('pekerjaan_ayah') ?></small>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="nama">No Telpon ibu <span class="text-danger">*</span></label>
                                              <input type="text" class="form-control" name="telp_ibu" id="nisn" placeholder="Masukkan No Telp Ibu" value="<?php if (!empty($data_ortu)) {
                                                                                                                                                        echo $data_ortu['no_hp_ortu_ibu'];
                                                                                                                                                    } else {
                                                                                                                                                        echo set_value('telp_ibu');
                                                                                                                                                    } ?>">
                                              <small class="text-danger mt-2"><?= form_error('telp_ibu') ?></small>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="misi">Alamat ibu <span class="text-danger">*</span></label>
                                      <textarea id="misi" name="alamat_ibu" class="form-control" style="height: 150px;" placeholder="Masukkan Alamat Ibu"><?php if (!empty($data_ortu)) {
                                                                                                                                                                echo $data_ortu['alamat_ortu_ibu'];
                                                                                                                                                            } else {
                                                                                                                                                                echo set_value('alamat_ibu');
                                                                                                                                                            } ?></textarea>
                                      <small class="text-danger mt-2"><?= form_error('alamat_ibu') ?></small>
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