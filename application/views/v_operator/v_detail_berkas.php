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
              <li class="breadcrumb-item"><a href="<?= base_url('operator') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('operator/verifikasi/berkas') ?>">Berkas</a></li>
              <li class="breadcrumb-item active">Detail</li>
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
                <h3 class="card-title"><i class="far fa-dollar"></i>Konfirmasi verifikasi berkas</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Cari Peserta</label>
                      <select class="form-control select2bs4" style="width: 100%" name="cari" id="cari" data-placeholder="Pilih Peserta Terdaftar">
                        <option></option>
                        <?php 
                        foreach ($peserta as $p) {
                          echo '<option value="'.$p['id_peserta'].'">'.$p['no_pendaftaran'].' - '.ucwords($p['nama_lengkap']).'</option>';
                        }
                          ?>
                      </select>
                      <small class="text-danger"><?= form_error('cari')?></small>
                    </div>
                  </div>
                </div>
                <hr>

                <section class="mt-3" id="data-berkas">
                  <ul class="mailbox-attachments clearfix">
                      <li id="ijazah" style="display: none;">
                        <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                        <div class="mailbox-attachment-info">
                          <a id="berkas_ijazah" href="#" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> IJAZAH</a>
                        </div>
                      </li>
                      <li id="skhun" style="display: none;">
                        <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                        <div class="mailbox-attachment-info">
                          <a id="berkas_skhun" href="#" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> SKHUN</a>
                        </div>
                      </li>
                      <li id="kk" style="display: none;">
                        <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                        <div class="mailbox-attachment-info">
                          <a id="berkas_kk" href="" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Kartu Keluarga</a>

                        </div>
                      </li>
                      <li id="sk_sehat" style="display: none;">
                        <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                        <div class="mailbox-attachment-info">
                          <a id="berkas_sk_sehat" href="" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> SK SEHAT</a>

                        </div>
                      </li>
                      <li id="foto" style="display: none;">
                        <span class="mailbox-attachment-icon has-img"><img id="img_foto" class="img-file" src="" alt="Attachment"></span>

                        <div class="mailbox-attachment-info">
                          <a id="berkas_foto" href="" target="_blank" class="mailbox-attachment-name"><i class="fa fa-camera"></i> FOTO</a>

                        </div>
                      </li>
                  </ul>
                </section>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <div class="float-right" id="btn-verif" style="display: none;">
                  <a href="javascript:void(0)" id="" class="btn btn-danger float-right ml-4 tolak">Tolak!</a>
                  <a href="javascript:void(0)" id="" class=" btn btn-success float-right verif">Verifikasi!</a>
                </div>
              </div>
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
    $('#change').on('click', function() {
      $('#btn-verif').show();
      $('#notif-verif').hide();
    })
  </script>

  <script>
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
  </script>

  <script>
  $('#cari').on('change', function(){
    var id_berkas = $('#cari').val();

    $.ajax({
      type : "post",
      url : "<?=base_url()?>operator/verifikasi/berkas/get_berkas",
      data : {id_berkas : id_berkas},
      dataType : "json",
      success : function(data){
        $('#btn-verif').show();
        $('.tolak').attr('id', data.id_pendaftaran);
        $('.verif').attr('id', data.id_pendaftaran);

        if (data.ijazah != '') {
          $('#ijazah').show();
          $('#berkas_ijazah').attr('href', data.ijazah);
        }

        if (data.skhun !== '') {
          $('#skhun').show();
          $('#berkas_skhun').attr('href', data.skhun);
        }

        if (data.kk !== '') {
          $('#kk').show();
          $('#berkas_kk').attr('href', data.kk);
        }

        if (data.sk_sehat !== '') {
          $('#sk_sehat').show();
          $('#berkas_sk_sehat').attr('href', data.sk_sehat);
        }

        if (data.foto !== '') {
          $('#foto').show();
          $('#berkas_foto').attr('href', data.foto);
          $('#img_foto').attr('src', data.foto);
        }
      } 
    })
  })
</script>

  <script>
    $('.tolak').on('click', function(e) {
      e.preventDefault();
      var dataId = this.id;
      var ket = "tolak";
      Swal.fire({
        title: 'Tolak data berkas',
        text: "Apakah anda yakin ingin menolak data berkas!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Tolak!'
      }).then(
        function(isConfirm) {
          if (isConfirm.value) {
            $.ajax({
              type: "post",
              url: "<?= base_url() ?>operator/verifikasi/berkas/verify/" + dataId,
              data: {
                'status': ket
              },
              success: function(respone) {
                window.location.href = "<?= base_url('operator/verifikasi/berkas') ?>";
              },
              error: function(request, error) {
                window.location.href = "<?= base_url('operator/verifikasi/berkas') ?>";
              },
            });
          } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });
    });
  </script>

  <script>
    $('.verif').on('click', function(e) {
      e.preventDefault();
      var dataId = this.id;
      var ket = "verif";
      Swal.fire({
        title: 'Verifikasi data berkas',
        text: "Apakah anda yakin ingin memverifikasi data berkas!",
        type: "success",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Verifikasi!'
      }).then(
        function(isConfirm) {
          if (isConfirm.value) {
            $.ajax({
              type: "post",
              url: "<?= base_url() ?>operator/verifikasi/berkas/verify/" + dataId,
              data: {
                'status': ket
              },
              success: function(respone) {
                window.location.href = "<?= base_url('operator/verifikasi/berkas') ?>";
              },
              error: function(request, error) {
                window.location.href = "<?= base_url('operator/verifikasi/berkas') ?>";
              },
            });
          } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });
    });
  </script>