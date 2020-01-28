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

    <?php
    $peserta = $this->m_operator->getDetailPeserta($this->uri->segment(5));
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
                <p class="card-title">
                  <strong>No.Pendaftaran</strong> : <?= $peserta['no_pendaftaran'] ?><br>
                  <strong>Nama Peserta</strong> : <?= ucwords($peserta['nama_lengkap']) ?><br>
                </p>
              </div>
              <div class="card-body">
                <ul class="mailbox-attachments clearfix">
                  <?php if (!empty($berkas['ijazah_terakhir'])) { ?>
                    <li>
                      <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                      <div class="mailbox-attachment-info">
                        <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['ijazah_terakhir']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> IJAZAH</a>
                      </div>
                    </li>
                  <?php }
                  if (!empty($berkas['skhun'])) { ?>
                    <li>
                      <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                      <div class="mailbox-attachment-info">
                        <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['skhun']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> SKHUN</a>
                      </div>
                    </li>
                  <?php }
                  if (!empty($berkas['kartu_keluarga'])) { ?>
                    <li>
                      <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                      <div class="mailbox-attachment-info">
                        <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['kartu_keluarga']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Kartu Keluarga</a>

                      </div>
                    </li>
                  <?php }
                  if (!empty($berkas['keterangan_sehat'])) { ?>
                    <li>
                      <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                      <div class="mailbox-attachment-info">
                        <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['keterangan_sehat']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> SK SEHAT</a>

                      </div>
                    </li>
                  <?php }
                  if (!empty($berkas['pas_foto'])) { ?>
                    <li>
                      <span class="mailbox-attachment-icon has-img"><img class="img-file" src="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['pas_foto']) ?>" alt="Attachment"></span>

                      <div class="mailbox-attachment-info">
                        <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['pas_foto']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-camera"></i> FOTO</a>

                      </div>
                    </li>
                  <?php } ?>
                </ul>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <?php
                if ($peserta['status_verifikasi_berkas'] == 'sudah') {
                  $disable = 'none';
                ?>
                  <div class="row float-right" id="notif-verif">
                    <small class="text-muted">Data berkas ini sudah diverifikasi klik <button id="change" class="btn btn-xs btn-warning">Disini</button> untuk mengubah</small>
                  </div>
                <?php } ?>
                <div class="float-right" id="btn-verif" style="display: <?= $disable ?>">
                  <a href="javascript:void(0)" id="<?= $peserta['id_pendaftaran'] ?>" class="btn btn-danger float-right ml-4 tolak">Tolak!</a>
                  <a href="javascript:void(0)" id="<?= $peserta['id_pendaftaran'] ?>" class=" btn btn-success float-right verif">Verifikasi!</a>
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