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
                          <li class="breadcrumb-item active">Petunjuk Pendaftaran</li>
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
                              <h3 class="card-title"><i class="fa fa-user"></i>Petunjuk Pendaftaran</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form action="" method="post" role="form" enctype="multipart/form-data">
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="petunjuk">Petunjuk Pendaftaran</label>
                                  <textarea name="petunjuk" id="petunjuk" class="form-control" style="height: 200px;" name="petujuk" placeholder="Pisahkan dengan enter"><?php if(!empty($petunjuk)){ 
                                    $pet = json_decode($petunjuk['keterangan'], true);
                                    foreach ($pet as $p) {
                                      echo ucfirst(trim($p)).PHP_EOL;
                                    }
                                     }?></textarea>
                                  <small class="text-danger mt-2"><?= form_error('petunjuk') ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputFile">File Petunjuk</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" name="file" id="file">
                                      <label class="custom-file-label" for="file">Pilih File</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputFile">Gambar Petunjuk</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" name="foto" onchange="loadFile(event)" id="exampleInputFile">
                                      <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <img class="mt-2 mb-2" style="width: 100%" src="<?=base_url('assets/img/uploads/'.$petunjuk['gambar'])?>" id="output">
                                  </div>
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

   <script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
    };
  </script>