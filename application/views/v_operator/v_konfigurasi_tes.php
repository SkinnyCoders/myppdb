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
                          <li class="breadcrumb-item"><a href="<?= base_url('operator/soal-seleksi') ?>">Soal Seleksi</a></li>
                         <li class="breadcrumb-item active">Konfigurasi</li>
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
                              <h3 class="card-title"><i class="fa fa-cog"></i> Konfigurasi Tes Seleksi</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
                          <form action="" method="post" role="form" enctype="multipart/form-data">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label >Tes Seleksi</label>
                                      <select name="tes" id="jalur" class="form-control select">
                                        <option value="">Pilih Tes Seleksi</option>
                                        <?php 
                                        if (!empty($tes)) {
                                          foreach ($tes as $j) {
                                            echo '<option value="'.$j['id_tes_seleksi'].'">'.$j['nama_tes_seleksi'].'</option>';
                                          }
                                        }
                                         ?>
                                      </select>
                                      <small class="text-danger mt-2"><?= form_error('tes') ?></small>
                                    </div>
                                  </div> 
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label >Program Studi (Jurusan)</label>
                                      <select name="prodi[]" id="prodi_ampas" class="form-control select2" multiple="multiple" data-placeholder="Pilih Program Studi">
                                        
                                        
                                      </select>
                                      <small class="text-danger mt-2"><?= form_error('prodi') ?></small>
                                    </div>
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

  <script src="<?=base_url('assets/plugins/select2/js/select2.full.min.js')?>"></script>

  <script>
    $(function(){
      //Initialize Select2 Elements
    $('.select2').select2()
    })
  </script>

    <script>
    $('#jalur').on('change', function(){
      var jalur = $('#jalur').val();

      $.ajax({
        type : "POST",
        url : "<?=base_url('operator/seleksi/get_prodi')?>",
        data : {'id_tes' : jalur},
        async : false,
        dataType : "json",
        success : function(data){
          var html = '';
          var i;

          for(i=0; i<data.length; i++){
          html += '<option value="'+data[i].id_program_studi+'">'+data[i].nama_program_studi+'</option>';
          }
              console.log(html);
              $("#prodi_ampas").html(html);
          }
      })
    });
  </script>