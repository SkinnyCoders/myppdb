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
              <li class="breadcrumb-item"><a href="<?= base_url('admin/pendaftaran/biaya_masuk') ?>">Biaya Masuk</a></li>
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
                <h3 class="card-title"><i class="fa fa-plus"></i> Tambah Biaya Masuk</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="biaya">Biaya Masuk</label>
                        <input type="text" class="form-control" name="biaya" id="biaya" placeholder="Biaya Masuk" value="<?php echo set_value('nama'); ?>">
                        <small class="text-danger mt-2"><?= form_error('biaya') ?></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="tahun">Tahun Ajaran</label>
                        <select id="tahun" class="form-control select2bs4" name="tahun_ajaran" style="width: 100%;" data-placeholder="Pilih Tahun Ajaran">
                          <option></option>
                          <?php foreach ($tahun_ajaran as $tahun) {
                            echo '<option value="'.$tahun['id_tahun_ajaran'].'">'.$tahun['tahun_mulai'].'/'.$tahun['tahun_akhir'].'</option>';
                          } ?>
                        </select>
                        <small class="text-danger mt-2"><?= form_error('tahun_ajaran') ?></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nama">Program Studi</label>
                        <select class="form-control select2bs4" id="jurusan" name="jurusan" style="width: 100%;" data-placeholder="Pilih Program Studi">
                          <option></option>
                          <?php 
                            foreach ($jurusan as $j) {
                              echo '<option value="'.$j['id_program_studi'].'">'.$j['nama_program_studi'].'</option>';
                            }
                           ?>
                        </select>
                        <small class="text-danger mt-2"><?= form_error('jurusan') ?></small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nama">Jalur Pendaftaran</label>
                        <select class="form-control select2bs4 jalur" name="jalur" id="jalur" style="width: 100%;" data-placeholder="Pilih Jalur Pendaftaran">
                          <option></option>
                        </select>
                        <small class="text-danger mt-2"><?= form_error('jalur') ?></small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="jumlah">Jumlah Biaya</label>
                        <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah Rp." value="<?php echo set_value('jumlah'); ?>">
                        <small class="text-danger mt-2"><?= form_error('jumlah') ?></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Batas Pembayaran</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="text" name="batas" class="form-control float-right" id="datepicker">
                        </div>
                        <!-- /.input group -->
                        <small class="text-danger mt-2"><?= form_error('batas') ?></small>
                      </div>                    
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
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  </script>

  <!-- bootstrap datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script>
    $(function() {
      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      })
    })
  </script>

  <script>
    $('#jurusan').on('change', function(){
      var id_jurusan = $('#jurusan').val();

      $.ajax({
        type : "POST",
        url : "<?=base_url('admin/pendaftaran/biaya_masuk/get_jalur')?>",
        data : {'id':id_jurusan},
        dataType : "json",
        success : function(data){
          var html = '';
          var i;

          for (i=0;i<data.length; i++) {
            html += '<option value="'+data[i].id_jalur_pendaftaran+'">'+data[i].nama_jalur_pendaftaran+'</option>';
          }

          $('#jalur').html(html);
        }
      })
    });
  </script>