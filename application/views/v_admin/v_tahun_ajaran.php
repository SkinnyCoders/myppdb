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
             <li class="breadcrumb-item active">Tahun Ajaran</li>
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
         <div class="col-md-6">
           <div class="card">
             <div class="card-header">
               <h3 class="card-title">Tabel data pengguna</h3>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <table id="example1" class="table table-striped">
                 <thead>
                   <tr>
                     <th class="text-nowrap" style="width: 5%">No</th>
                     <th class="text-nowrap">Tahun Ajaran</th>
                     <th style="width: 25%">Aksi</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                    if (!empty($tahun_ajaran)) {
                      $no = 1;
                      foreach ($tahun_ajaran as $ta) {
                        ?>
                       <tr>
                         <td><?= $no++ ?></td>
                         <td><?= $ta['tahun_mulai'] . '/' . $ta['tahun_akhir'] ?></td>
                         <td><a href="javascript:void(0)" data-toggle="modal" id="<?= $ta['id_tahun_ajaran'] ?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?= $ta['id_tahun_ajaran'] ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
                       </tr>
                   <?php
                      }
                    }
                    ?>
                 </tbody>
               </table>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>

         <div class="col-md-6">
           <div class="card">
             <div class="card-header">
               <h3 class="card-title">Tambah Tahun Ajaran</h3>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <form action="" method="post">
                 <div class="row">
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="nama">Tahun Awal</label>
                       <input type="number" min="4" class="form-control nama2" name="tahun1" id="nama2" placeholder="Tahun Awal" value="<?= set_value('tahun1') ?>">
                       <small class="text-danger mt-2"><?= form_error('tahun1') ?></small>
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="nama">Tahun Akhir</label>
                       <input type="number" min="4" class="form-control nama2" name="tahun2" id="nama2" placeholder="Tahun Akhir" value="<?= set_value('tahun2') ?>">
                       <small class="text-danger mt-2"><?= form_error('tahun2') ?></small>
                     </div>
                   </div>
                 </div>
             </div>
             <div class="card-footer">
               <button type="submit" class="btn btn-primary float-right">Simpan</button>
             </div>
             </form>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>

         <div class="modal fade" id="modal-lg">
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h4 class="modal-title">Edit Tahun Ajaran <span id="nama2"></span></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <form action="<?= base_url('admin/sekolah/tahun_ajaran/update') ?>" method="POST">
                   <div class="row">
                     <div class="col-md-6">
                       <div class="form-group">
                         <label for="nama">Tahun Awal</label>
                         <input type="number" class="form-control tgl_mulai" name="tahun1" id="nama2" placeholder="Tahun Awal" value="">

                         <input type="hidden" class="form-control id_tahun" name="id" value="" required>
                         <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                       </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                         <label for="nama">Tahun Akhir</label>
                         <input type="number" class="form-control tgl_akhir" name="tahun2" id="nama2" placeholder="Tahun Akhir" value="">
                         <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                       </div>
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
     </div>
   </section>
 </div>
 <!-- /.content-wrapper -->

 <?php $this->load->view('templates/cdn_admin'); ?>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

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

   $(function() {
     //Date picker
     $('#datepicker').datepicker({
       autoclose: true
     })
   });

   var loadFile = function(event) {
     var output = document.getElementById('output');
     output.src = URL.createObjectURL(event.target.files[0]);
   };

   $('.update').on('click', function() {
     var dataId = this.id;
     $.ajax({
       type: "post",
       url: "<?= base_url('admin/sekolah/tahun_ajaran/update') ?>",
       data: {
         'id_get_update': dataId
       },
       dataType: "json",
       success: function(data) {
         $('.id_tahun').val(data.id_tahun_ajaran);
         $('.tgl_mulai').val(data.tahun_mulai);
         $('.tgl_akhir').val(data.tahun_akhir);
       },
     });
   })

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Tahun Ajaran',
       text: "Apakah anda yakin ingin menghapus data tahun ajaran ini?",
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
             url: "<?= base_url() ?>admin/sekolah/tahun_ajaran/delete/" + dataId,
             data: {
               'id_pengguna': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/sekolah/tahun_ajaran') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/sekolah/tahun_ajaran') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>