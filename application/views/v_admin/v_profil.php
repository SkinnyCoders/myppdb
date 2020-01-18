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
              <li class="breadcrumb-item active">Profil Sekolah</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php $kontak = json_decode($profile['kontak_sekolah'], true);
    $misi = json_decode($profile['misi_sekolah'], true);
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
                <h3 class="card-title"><i class="fa fa-school"></i> Profil Sekolah</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama">Nama Sekolah</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Input Nama Sekolah Operator" value="<?php if (!empty($profile)) {
                                                                                                                                      echo $profile['nama_sekolah'];
                                                                                                                                    } ?>">
                    <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="visi">Visi Sekolah</label>
                        <textarea id="visi" name="visi" class="form-control" style="height: 150px;" placeholder="Input Visi"><?php if (!empty($profile)) {
                                                                                                                                echo $profile['visi_sekolah'];
                                                                                                                              } ?></textarea>
                        <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="misi">Misi Sekolah</label>
                        <textarea id="misi" name="misi" class="form-control" style="height: 150px;" placeholder="Pisahkan dengan enter"><?php if (!empty($profile)) {
                                                                                                                                          foreach ($misi as $m) {
                                                                                                                                            echo trim($m) . PHP_EOL;
                                                                                                                                          };
                                                                                                                                        } ?></textarea>
                        <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="profil">Profil Sekolah</label>
                    <textarea class="textarea form-control" id="profil" name="profil" placeholder="Place some text here" style="width: 100%; height: 250px; font-size: 14px; line-height: 50px; border: 1px solid #dddddd; padding: 10px;"><?php if (!empty($profile)) {
                                                                                                                                                                                                                                              echo $profile['profil_sekolah'];
                                                                                                                                                                                                                                            } ?></textarea>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="alamat">Alamat Sekolah</label>
                      <textarea id="alamat" name="alamat" class="form-control" style="height: 150px;" placeholder="Masukan Alamat Sekolah"><?php if (!empty($profile)) {
                                                                                                                                              echo $profile['alamat_sekolah'];
                                                                                                                                            } ?></textarea>
                      <small class="text-danger mt-2"><?= form_error('alamat') ?></small>
                    </div>
                    <div class="col-md-6">
                      <label for="misi">Kontak Sekolah</label>
                      <input class="form-control" type="number" name="telp" placeholder="Nomor Telp" value="<?= $kontak['telp'] ?>">
                      <input class="form-control mt-3" type="email" name="email" placeholder="Email" value="<?= $kontak['email'] ?>">
                      <input class="form-control mt-3" type="text" name="social" placeholder="Sosial Media" value="<?= $kontak['social'] ?>">
                      <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nama Kepala Sekolah</label>
                    <input type="text" class="form-control" name="kepsek" id="exampleInputPassword1" placeholder="Input nama kepsek" value="<?php if (!empty($profile)) {
                                                                                                                                              echo $profile['nama_kepala_sekolah'];
                                                                                                                                            } ?>">
                    <small class="text-danger mt-2"><?= form_error('kepsek') ?></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Sambutan Kepala sekolah</label>
                    <textarea id="visi" name="sambutan" class="form-control" style="height: 150px;" placeholder="Input Sambutan"><?php if (!empty($profile)) {
                                                                                                                                    echo $profile['sambutan_kepala_sekolah'];
                                                                                                                                  } ?></textarea>
                    <small class="text-danger mt-2"><?= form_error('password1') ?></small>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Logo Sekolah</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto2" onchange="loadFile1(event)" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                          </div>
                        </div>
                      </div>
                      <img class="mt-2 mb-2 img-preview" <?php if (!empty($profile['logo_sekolah'])) {
                                                            echo 'src="' . base_url() . 'assets/img/uploads/' . $profile["logo_sekolah"] . '"';
                                                          } else {
                                                            echo 'src="' . base_url() . 'assets/img/user/default.png"';
                                                          } ?> id="output1">

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Foto Kepala Sekolah</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto1" onchange="loadFile2(event)" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                          </div>
                        </div>
                      </div>
                      <img class="mt-2 mb-2 img-preview" <?php if (!empty($profile['foto_kepala_sekolah'])) {
                                                            echo 'src="' . base_url() . 'assets/img/uploads/' . $profile["foto_kepala_sekolah"] . '"';
                                                          } else {
                                                            echo 'src="' . base_url() . 'assets/img/user/default.png"';
                                                          } ?> id="output2">
                    </div>
                  </div>
                  <!--  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
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

  <!-- Summernote -->
  <script src="<?= base_url('assets/plugins/summernote/summernote-bs4.min.js') ?>"></script>
  <script>
    $(function() {
      // Summernote
      $('.textarea').summernote()
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