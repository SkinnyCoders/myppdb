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
                         <li class="breadcrumb-item active">Soal Seleksi</li>
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
                     <div class="card">
                         <div class="card-header">
                             <h3 class="card-title">Tabel data Seleksi</h3>
                             <a class="btn btn-sm btn-primary float-right ml-3" href="<?= base_url('operator/soal-seleksi/tambah') ?>"><i class="fa fa-user-plus"></i> Tambah Tes Seleksi</a>
                             <a class="btn btn-sm btn-primary float-right" href="<?= base_url('operator/soal-seleksi/konfigurasi') ?>"><i class="fa fa-cog"></i> Konfigurasi Tes Seleksi</a>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <table id="example1" class="table table-striped">
                                 <thead>
                                     <tr>
                                         <th class="text-nowrap" style="width: 5%">No</th>
                                         <th class="text-nowrap">Nama Tes</th>
                                         <th class="text-nowrap">Deskripsi</th>
                                         <th class="text-nowrap">Bobot Tes</th>
                                         <th style="width: 18%">Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        $no = 1;

                                        foreach ($seleksi as $f) : ?>
                                         <tr>
                                             <td><?= $no++ ?></td>
                                             <td><?= ucwords($f['nama_tes_seleksi']) ?></td>
                                             <td><?= ucwords($f['deskripsi_tes_seleksi']) ?></td>
                                             <td><?= ucwords($f['bobot_tes']) ?></td>
                                             <td><a href="<?= base_url('') ?>operator/soal-seleksi/detail/<?= $f['id_tes_seleksi'] ?>" id="<?= $f['id_tes_seleksi'] ?>" class="btn btn-sm btn-warning mr-3 update">Soal</a><a href="<?= base_url('') ?>operator/soal-seleksi/ubah/<?= $f['id_tes_seleksi'] ?>" id="<?= $f['id_tes_seleksi'] ?>" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-user-edit"></i></a><a href="javascript:void(0)" id="<?= $f['id_tes_seleksi'] ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
                                         </tr>
                                     <?php endforeach; ?>
                                 </tbody>
                             </table>
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

     $('.delete').on('click', function(e) {
         e.preventDefault();
         var dataId = this.id;
         Swal.fire({
             title: 'Hapus Data Fasilitas',
             text: "Apakah anda yakin ingin menghapus data Soal Seleksi ini?",
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
                         url: "<?= base_url() ?>operator/seleksi/delete/",
                         data: {
                             'id': dataId
                         },
                         success: function(respone) {
                             window.location.href = "<?= base_url('operator/soal-seleksi') ?>";
                         },
                         error: function(request, error) {
                             window.location.href = "<?= base_url('operator/soal-seleksi') ?>";
                         },
                     });
                 } else {
                     swal("Cancelled", "Your imaginary file is safe :)", "error");
                 }
             });
     });
 </script>