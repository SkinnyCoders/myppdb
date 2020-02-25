  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <style>
      .img-admin{
        background-image: url("<?=base_url()?>/assets/img/bg-admin.jpg");
        width: 100%;
        height: 200px;
        background-repeat: no-repeat;
      }

      .img-admin h3 {
        margin-top: 70px;
        font-family: arial;
      }
    </style>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="img-admin">
            <h3 class="text-center">Selamat Datang <br> <small class="text-muted">Admin</small> </h3>
          </div>
        </div>

        <div class="row mt-4">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-plus"></i> Tambah Informasi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama">Judul Informasi</label>
                    <input type="text" class="form-control" name="info" id="nama" placeholder="Judul Informasi" value="<?php echo set_value('nama'); ?>">
                    <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                  </div>
                  <div class="form-group">
                    <label for="des">Deskripsi Informasi</label>
                    <textarea class="form-control" id="profil" name="des" placeholder="Deskripsi Informasi" style="width: 100%; height: 100px;"></textarea>
                      <small class="text-danger mt-2"><?= form_error('des') ?></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File Informasi</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto" onchange="loadFile(event)" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <img class="mt-2 mb-2" style="width: 100%" src="" id="output">
                    </div>
                  </div>
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <?php $this->load->view('templates/cdn_admin');?>
  
