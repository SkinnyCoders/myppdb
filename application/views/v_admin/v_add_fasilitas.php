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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/sekolah/fasilitas') ?>">Fasilitas</a></li>
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
                <h3 class="card-title"><i class="fa fa-user-plus"></i> Tambah fasilitas</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama">Nama Fasilitas</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Fasilitas" value="<?php echo set_value('nama'); ?>">
                    <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                  </div>
                  <div class="form-group">
                    <label for="des">Deskripsi Fasilitas</label>
                    <textarea id="des" name="deskripsi" class="form-control" style="height: 150px;" placeholder="Masukkan Deskripsi"><?php if (!empty($profile)) {
                                                                                                                                        echo $profile['visi_sekolah'];
                                                                                                                                      } ?></textarea>
                    <small class="text-danger mt-2"><?= form_error('deskripsi') ?></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Foto Fasilitas</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto" onchange="loadFile(event)" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <img class="mt-2 mb-2" style="width: 100%" src="" id="output">
                    </div>
                  </div>

                  <!--  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
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

  <script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
    };
  </script>