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
                          <li class="breadcrumb-item active">Dashboard Kepala Sekolah</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
          <div class="container-fluid">
              <div class="row my-3">
                  <?php if ($data_all == NULL || in_array(NULL, $data_all) || in_array(NULL, $berkas)) { ?>
                      <div class="col-md-12">
                          <div class="alert alert-danger alert-dismissible text-center">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              Kamu belum dapat mengikuti ujian karena masih ada persyaratan yang belum dilengkapi.
                          </div>
                      </div>
                  <?php } else { ?>
                      <div class="col-md-12">
                          <div class="alert alert-primary alert-dismissible text-center">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <h4 class="text-light"><strong>Token kamu</strong></h4>
                              <p class="text-light" id="copyText"><?= $token ?></p>
                              <button class="btn btn-xs btn-success" id="copyBtn">salin token</button>
                          </div>
                      </div>
                  <?php } ?>




                  <div class="col-md-12 text-center my-5">
                      <form action="">
                          <div class="form-group">
                              <input type="text" class="form-control" name="tempat_lahir" id="nama" placeholder="Masukkan Token Kamu" value="">
                              <small class="text-danger mt-2"><?= form_error('tempat_lahir') ?></small>
                          </div>

                          <button class="btn btn-primary">MULAI UJIAN</button>
                      </form>
                  </div>


              </div>
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

  <?php $this->load->view('templates/cdn_admin'); ?>

  <script>
      var copyTokenBtn = $('#copyBtn');

      copyTokenBtn.on('click', function(event) {
          var copyToken = $('#copyText');

          copyToken.focus();
          copyToken.select();

          try {
              var successful = document.execCommand('copy');
              var msg = successful ? 'successful' : 'unsuccessful';
              console.log(msg);
          } catch (err) {
              console.log('gagal');
          }
      })
  </script>