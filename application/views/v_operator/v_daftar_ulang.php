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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Data berhasil melakukan daftar ulang</h3>
                              <a class="btn btn-sm btn-primary float-right ml-3" href="<?=base_url('operator/daftar_ulang/tambah')?>"><i class="fa fa-plus"></i> Tambah Daftar Ulang</a>
                              <a class="btn btn-sm btn-success float-right ml-3" href="<?=base_url('operator/daftar_ulang/rekap')?>"><i class="fa fa-download"></i> Download Rekap Daftar Ulang</a>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap" style="width: 15%">No.Pendaftaran</th>
                                 <th class="text-nowrap" style="width: 20%">Nama</th>
                                 <th class="text-nowrap" style="width: 15%">Jalur - Program Studi</th>
                                 <th class="text-nowrap" style="width: 15%">Tanggal</th>
                                 <th class="text-nowrap" style="width: 10%">Status</th>
                                 <th style="width: 10%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                              <?php 
                              $no = 1;
                              foreach ($daftar_ulang as $daftar) :
                                $tgl = DateTime::createFromFormat('Y-m-d H:i:s', $daftar['tanggal'])->format('d F Y');
                               ?>
                                <tr>
                                  <td><?=$no++?></td>
                                  <td><?=$daftar['no_pendaftaran']?></td>
                                  <td><?=ucwords($daftar['nama_lengkap'])?></td>
                                  <td><?=$daftar['nama_jalur_pendaftaran']?> - <?=$daftar['nama_program_studi']?></td>
                                  <td><?=$tgl?></td>
                                  <td>
                                    <?php 
                                    if ($daftar['status'] == 'sudah') {
                                      echo '<label class="btn btn-xs btn-success">Sudah</label>';
                                    }else{
                                      echo '<label class="btn btn-xs btn-danger">Belum</label>';
                                    }
                                     ?>
                                  </td>
                                  <td><a href="javascript:void(0)" data-toggle="modal" id="<?=$daftar['id_daftar_ulang']?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?=$daftar['id_daftar_ulang']?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <?php 
                                endforeach;
                                 ?>
                             </tbody>
                           </table>
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>
              </div>

              <div class="modal fade" id="modal-lg">
               <div class="modal-dialog">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h4 class="modal-title">Edit <span id="nama2"></span></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                     <div class="row">
                       <div class="col-md-12">
                         <!-- form start -->
                         <form action="<?= base_url('operator/daftar_ulang/update') ?>" method="post" role="form" enctype="multipart/form-data">
                           
                             <div class="form-group">
                               <label for="nama">Tanggal daftar Ulang</label>
                               <input type="text" class="form-control tgl" name="tgl" id="datepicker" placeholder="Pilih Tanggal" value="">
                               <small class="text-danger mt-2"><?= form_error('nama') ?></small>

                               <input type="hidden" name="id" class="id" value="" required>
                             </div>
                             <div class="form-group">
                               <label for="des">Status Daftar Ulang</label>
                               <select class="form-control status" name="status">
                                 <option value="sudah">Sudah</option>
                                 <option value="belum">Belum</option>
                               </select>
                               <small class="text-danger mt-2"><?= form_error('deskripsi') ?></small>
                             </div>
                           <!-- /.card-body -->
                       </div>
                     </div>
                   </div>
                   <div class="modal-footer justify-content-between">
                     <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                     </form>
                   </div>
                 </div>
                 <!-- /.modal-content -->
               </div>
               <!-- /.modal-dialog -->
             </div>
             <!-- /.modal -->
          </div>
      </section>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('templates/cdn_admin'); ?>

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
   $(function() {
     $("#example1").DataTable({});
     $('#example2').DataTable({
       "paging": true,
       "lengthChange": false,
       "searching": false,
       "ordering": true,
       "info": true,
       "autoWidth": false,
     });
   });
 </script>

  <script>
    $('.update').on('click', function() {
     var dataId = this.id;
     $.ajax({
       type: "post",
       url: "<?= base_url('operator/daftar_ulang/update') ?>",
       data: {
         'id': dataId
       },
       dataType: "json",
       success: function(data) {
         $('.id').val(data.id);
         $('.tgl').val(data.tgl);
         $('.status').val(data.status).trigger();
       },
     });
   })
  </script>

  <script>
    $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data daftar ulang',
       text: "Apakah anda yakin ingin data daftar ulang ini?",
       type: "warning",
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Ya, Hapus!'
     }).then(
       function(isConfirm) {
         if (isConfirm.value) {
           $.ajax({
             type: "post",
             url: "<?= base_url() ?>operator/daftar_ulang/delete/" + dataId,
             data: {
               'id_pengguna': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('operator/daftar_ulang') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('operator/daftar_ulang') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
  </script>