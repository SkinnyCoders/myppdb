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
                              <h3 class="card-title"><i class="far fa-dollar"></i>Konfirmasi daftar ulang</h3>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12">
                                <form action="" method="POST">
                                  <div class="form-group">
                                    <label>Cari Peserta</label>
                                    <input type="text" class="form-control" name="cari" placeholder="Masukkan No Pendaftaran, NISN, Atau Nama Peserta">
                                    <small class="text-danger"><?= form_error('cari')?></small>
                                  </div>
                                  <button type="submit" class="btn btn-primary float-right" name="search">CARI PESERTA!</button>
                                </form>
                              </div>
                            </div>

                            <?php if (!empty($data_peserta)) : 
                              ?>
                            <div class="row mt-5">
                              <div class="col-md-12">
                                <table id="example1" class="table table-striped">
                                 <thead>
                                   <tr>
                                     <th class="text-nowrap" style="width: 5%">No</th>
                                     <th class="text-nowrap" style="width: 15%">No.Pendaftaran</th>
                                     <th class="text-nowrap" style="width: 20%">Nama</th>
                                     <th class="text-nowrap" style="width: 15%">Jalur Pendaftaran</th>
                                     <th class="text-nowrap" style="width: 15%">Program Studi</th>
                                     <th style="width: 10%">Aksi</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                  <?php 
                                  $no = 1;
                                  foreach ($data_peserta as $peserta) :?>
                                    <tr>
                                      <td><?=$no++?></td>
                                      <td><?=$peserta['no_pendaftaran']?></td>
                                      <td><?=ucwords($peserta['nama_lengkap'])?></td>
                                      <td><?=ucwords($peserta['nama_jalur_pendaftaran'])?></td>
                                      <td><?=ucwords($peserta['nama_program_studi'])?></td>
                                      <td><a href="javascript:void(0)" id="<?=$peserta['id_peserta']?>" class="btn btn-sm btn-success delete">Konfirmasi</a></td>
                                    </tr>
                                  <?php endforeach; ?>
                                 </tbody>
                               </table>
                              </div>
                            </div>
                          <?php endif; ?>
                          </div>
                          <!-- /.card-body -->
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
    $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Konfirmasi Peserta Daftar Ulang',
       text: "Apakah anda yakin ingin mengkonfirmasi peserta tersebut?",
       type: "warning",
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Ya, Daftar Ulang!'
     }).then(
       function(isConfirm) {
         if (isConfirm.value) {
           $.ajax({
             type: "post",
             url: "<?= base_url() ?>operator/daftar_ulang/konfirmasi/" + dataId,
             data: {
               'id_pengguna': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('operator/daftar_ulang') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('operator/daftar_ulang/tambah') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
  </script>