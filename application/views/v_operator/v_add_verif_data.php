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
                          <li class="breadcrumb-item active"><?= ucwords($title) ?></li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i>Konfirmasi verifikasi data</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
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

                            <div class="section" style="display: none;" id="table-data"> 
                              <div class="row mt-5">
                                <div class="col-md-12">
                                  <h5 class="text-header">Data Diri Peserta</h5>
                                  <table id="example1" class="table table-striped">
                                   <thead>
                                     <tr>
                                       <th class="text-nowrap" style="width: 15%">Nama</th>
                                       <th class="text-nowrap" style="width: 10%">NISN</th>
                                       <th class="text-nowrap" style="width: 10%">Gender</th>
                                       <th class="text-nowrap" style="width: 10%">Tanggal - Tempat Lahir</th>
                                       <th class="text-nowrap" style="width: 10%">No Telp</th>
                                       <th class="text-nowrap" style="width: 10%">Agama</th>
                                       <th class="text-nowrap" style="width: 30%">Alamat</th>
                                     </tr>
                                   </thead>
                                   <tbody>
                                      <tr>
                                        <td><span id="nama"></span></td>
                                        <td><span id="nisn"></span></td>
                                        <td><span id="gender"></span></td>
                                        <td><span id="tgl_lahir"></span> - <span id="tempat_lahir"></span></td>
                                        <td><span id="no_telp"></span></td>
                                        <td><span id="agama"></span></td>
                                        <td><span id="alamat"></span></td>
                                      </tr>
                                   </tbody>
                                 </table>
                                </div>
                              </div>

                              <div class="row mt-4">
                                <div class="col-md-6">
                                  <h5 class="text-header">Data Orang Tua Peserta</h5>
                                  <table id="example1" class="table table-striped">
                                    <tbody>
                                      <tr><th>Nama Ayah</th><td><span id="nama_ayah"></span></td></tr>
                                      <tr><th>Pekerjaan Ayah</th><td><span id="pekerjaan_ayah"></span></td></tr>
                                      <tr><th>Alamat Ayah</th><td><span id="alamat_ayah"></span></td></tr>
                                      <tr><th>No telp Ayah</th><td><span id="telp_ayah"></span></td></tr>
                                      <tr><th>Nama Ibu</th><td><span id="nama_ibu"></span></td></tr>
                                      <tr><th>Pekerjaan Ibu</th><td><span id="pekerjaan_ibu"></span></td></tr>
                                      <tr><th>Alamat Ibu</th><td><span id="alamat_ibu"></span></td></tr>
                                      <tr><th>No telp Ibu</th><td><span id="telp_ibu"></span></td></tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="col-md-6">
                                  <h5 class="text-header">Data Sekolah Asal Peserta</h5>
                                  <table id="example1" class="table table-striped">
                                    <tbody>
                                      <tr><th>Nama Sekolah</th><td><span id="nama_sekolah"></span></td></tr>
                                      <tr><th>Alamat Sekolah</th><td><span id="alamat_sekolah"></span></td></tr>
                                      <tr><th>No Telp Sekolah</th><td><span id="telp_sekolah"></span></td></tr>
                                      <tr><th>Tahun Masuk</th><td><span id="tahun_masuk"></span></td></tr>
                                      <tr><th>Tahun Lulus</th><td><span id="tahun_lulus"></span></td></tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.card-body -->

                          <div class="card-footer" id="verifi-btn" style="display: none;">
                            <!-- <div class="row float-right" id="notif-verif">
                              <small class="text-muted">Data berkas ini sudah diverifikasi klik <button id="change" class="btn btn-xs btn-warning">Disini</button> untuk mengubah</small>
                            </div> -->
                          <div class="float-right" id="btn-verif">
                            <a href="javascript:void(0)" id="1" class="btn btn-danger float-right ml-4 tolak">Tolak!</a>
                            <a href="javascript:void(0)" id="1" class=" btn btn-success float-right verif">Verifikasi!</a>
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
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>

<script>
  $('#cari').on('change', function(){
    var id_peserta = $('#cari').val();

    $.ajax({
      type : "post",
      url : "<?=base_url()?>operator/verifikasi/data/get_peserta",
      data : {id_peserta : id_peserta},
      dataType : "json",
      success : function(data){
        if (data !== '') {
          $('#table-data').show();
          $('#verifi-btn').show();
          $('#nama').text(data.nama_lengkap);
          $('#nisn').text(data.nisn);
          if (data.jenis_kelamin == "P") {
            var gender = "Perempuan";
          }else{
            var gender = "Laki - Laki";
          }
          $('#gender').text(gender);
          $('#tgl_lahir').text(data.tgl_lahir);
          $('#tempat_lahir').text(data.tempat_lahir);
          $('#no_telp').text(data.no_hp);
          $('#agama').text(data.agama);
          $('#alamat').text(data.alamat_rumah);
          $('#nama_sekolah').text(data.nama_sekolah_asal);
          $('#alamat_sekolah').text(data.alamat_sekolah_asal);
          $('#telp_sekolah').text(data.no_telp_sekolah_asal);
          $('#tahun_masuk').text(data.tahun_masuk_sekolah_asal);
          $('#tahun_lulus').text(data.tahun_lulus_sekolah_asal);
          $('#nama_ayah').text(data.nama_ortu_ayah);
          $('#pekerjaan_ayah').text(data.pekerjaan_ortu_ayah);
          $('#alamat_ayah').text(data.alamat_ortu_ayah);
          $('#telp_ayah').text(data.no_hp_ortu_ayah);
          $('#nama_ibu').text(data.nama_ortu_ibu);
          $('#pekerjaan_ibu').text(data.pekerjaan_ortu_ibu);
          $('#alamat_ibu').text(data.alamat_ortu_ibu);
          $('#telp_ibu').text(data.no_hp_ortu_ibu);
          $('.tolak').attr('id', data.id_pendaftaran);
          $('.verif').attr('id', data.id_pendaftaran);
        }
      } 
    })
  })
</script>


  <script>
    $('.verif').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     console.log(dataId);
     Swal.fire({
       title: 'Verifikasi Data Peserta',
       text: "Apakah anda yakin ingin memverifikasi data peserta?",
       type: "warning",
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Ya, Verifikasi!'
     }).then(
       function(isConfirm) {
         if (isConfirm.value) {
           $.ajax({
             type: "post",
             url: "<?= base_url() ?>operator/verifikasi/data/verif/" + dataId,
             data: {
               'id_pengguna': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('operator/verifikasi/data') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('operator/verifikasi/data') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
  </script>

    <script>
    $('.tolak').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;

     Swal.fire({
       title: 'Verifikasi Data Peserta',
       text: "Apakah anda yakin ingin menolak data peserta?",
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
             url: "<?= base_url() ?>operator/verifikasi/data/tolak/" + dataId,
             data: {
               'id_pengguna': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('operator/verifikasi/data') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('operator/verifikasi/data') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
  </script>