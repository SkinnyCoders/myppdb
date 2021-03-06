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
                         <li class="breadcrumb-item active">Jalur Pendaftaran</li>
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
                             <h3 class="card-title">Tabel data jalur pendaftaran</h3>
                             <a class="btn btn-sm btn-primary float-right ml-3" href="<?= base_url('admin/pendaftaran/jalur/tambah') ?>"><i class="fa fa-plus"></i> Tambah Jalur Pendaftaran</a>
                             <a class="btn btn-sm btn-primary float-right" href="<?= base_url('admin/pendaftaran/jalur/konfigurasi') ?>"><i class="fa fa-cog"></i> Konfigurasi Jalur Prodi</a>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <table id="example1" class="table table-striped">
                                 <thead>
                                     <tr>
                                         <th class="text-nowrap" style="width: 5%">No</th>
                                         <th class="text-nowrap">Nama Jalur</th>
                                         <th class="text-nowrap">Keterangan</th>
                                         <th class="text-nowrap">Persyaratan</th>
                                         <th style="width: 12%">Aksi</th>
                                     </tr>
                                 </thead>

                                 <tbody>
                                     <?php
                                        $no = 1;
                                        foreach ($jalur as $j) :
                                            ?>
                                         <tr>
                                             <td><?= $no++ ?></td>
                                             <td><?= ucwords($j['nama_jalur_pendaftaran']) ?></td>
                                             <td><?= ucwords($j['keterangan']) ?></td>
                                             <td>
                                                 <ul>
                                                     <?php $syarat = json_decode($j['persyaratan'], true);
                                                            foreach ($syarat as $s) :
                                                                ?>
                                                         <li><?= trim(ucwords($s)) . PHP_EOL ?></li>
                                                     <?php endforeach; ?>
                                                 </ul>
                                             </td>
                                             <td><a href="<?= base_url('admin/pendaftaran/jalur/ubah/' . $j['id_jalur_pendaftaran']) ?>" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?= $j['id_jalur_pendaftaran'] ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
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

     var loadFile = function(event) {
         var output = document.getElementById('output');
         output.src = URL.createObjectURL(event.target.files[0]);
     };

     $('.delete').on('click', function(e) {
         e.preventDefault();
         var dataId = this.id;
         Swal.fire({
             title: 'Hapus Data Jalur Pendaftaran',
             text: "Apakah anda yakin ingin menghapus data jalur pendaftaran ini?",
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
                         url: "<?= base_url() ?>admin/pendaftaran/jalur/delete/" + dataId,
                         data: {
                             'id_pengguna': dataId
                         },
                         success: function(respone) {
                             window.location.href = "<?= base_url('admin/jalur_pendaftaran') ?>";
                         },
                         error: function(request, error) {
                             window.location.href = "<?= base_url('admin/jalur_pendaftaran') ?>";
                         },
                     });
                 } else {
                     swal("Cancelled", "Your imaginary file is safe :)", "error");
                 }
             });
     });
 </script>