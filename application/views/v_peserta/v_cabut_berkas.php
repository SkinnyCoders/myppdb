  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark"><?=ucwords($title)?></h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('peserta') ?>">Dashboard</a></li>
                          <li class="breadcrumb-item active"><?=ucwords($title)?></li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>

      <div class="content">
          <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
                <div class="callout callout-warning">
                  <?php if (!empty($cabut)) { ?>
                    <a href="javascript:void(0)" id="<?=$this->session->userdata('id_peserta')?>" style="text-decoration: none;" class="btn btn-warning text-dark float-sm-right mt-3 batal"><strong>Batalkan Cabut berkas</strong></a>
                  <?php }else{ ?>
                    <button type="button" class="btn btn-warning text-dark float-sm-right mt-3" data-toggle="modal" data-target="#modal-default">
                      <strong>Cabut berkas <i class="fa fa-exclamation-triangle"></i></strong>
                    </button>
                    
                  <?php } ?>
                  <h4>Selamat datang pada halaman pencabutan berkas!</h4>

                  <p>Halaman ini diperuntukan jika anda ingin membatalkan pendaftaran.</p>

                </div>
              </div>
            </div>

            <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-body">
                    <div class="form-group">
                      <label>Keterangan cabut berkas <span class="text-danger">*</span></label>
                      <textarea class="form-control" id="ket" style="width: 100%; height: 200px;"></textarea>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <a href="javascript:void(0)" id="<?=$this->session->userdata('id_peserta')?>" style="text-decoration: none;" class="btn btn-warning text-dark float-sm-right delete mt-3"><strong>Cabut berkas <i class="fa fa-exclamation-triangle"></i></strong></a>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
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
    $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     var ket = $('#ket').val();
     Swal.fire({
       title: 'Pencabutan Berkas',
       text: "Apakah anda yakin ingin melakukan pencabutan berkas?, dengan menekan tombol ya berarti anda menyetujui untuk melakukan pencabutan berkas",
       type: "warning",
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Ya, Cabut Berkas!'
     }).then(
       function(isConfirm) {
         if (isConfirm.value) {
           $.ajax({
             type: "post",
             url: "<?= base_url() ?>peserta/cabut_berkas/cabut/" + dataId,
             data: {
               'keterangan': ket
             },
             success: function(respone) {
               window.location.href = "<?= base_url('peserta/cabut_berkas') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('peserta/cabut_berkas') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
  </script>

  <script>
    $('.batal').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     var ket = $('#ket').val();
     Swal.fire({
       title: 'Batal Cabutan Berkas',
       text: "Jika anda membatalkan pencabutan berkas maka anda akan dimasukan kedalam proses pendaftaran, namun anda diharuskan melengkapi berkas kembali!",
       type: "warning",
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Ya, Cabut Berkas!'
     }).then(
       function(isConfirm) {
         if (isConfirm.value) {
           $.ajax({
             type: "post",
             url: "<?= base_url() ?>peserta/cabut_berkas/batal/" + dataId,
             data: {
               'keterangan': ket
             },
             success: function(respone) {
               window.location.href = "<?= base_url('peserta/cabut_berkas') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('peserta/cabut_berkas') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
  </script>