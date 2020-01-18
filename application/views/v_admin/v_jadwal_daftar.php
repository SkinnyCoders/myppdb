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
                         <li class="breadcrumb-item active">Jadwal Pendaftaran</li>
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
                             <h3 class="card-title">Tabel data Jadwal pendaftaran</h3>
                             <a class="btn btn-sm btn-primary float-right" href="<?= base_url('admin/jadwal_pendaftaran/tambah') ?>"><i class="fa fa-plus"></i> Tambah Jadwal Pendaftaran</a>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <table id="example1" class="table table-striped">
                                 <thead>
                                     <tr>
                                         <th class="text-nowrap" style="width: 5%">No</th>
                                         <th class="text-nowrap">Kegiatan</th>
                                         <th class="text-nowrap">Jalur</th>
                                         <th class="text-nowrap">Tanggal Mulai</th>
                                         <th class="text-nowrap">Tanggal Berakhir</th>
                                         <th style="width: 12%">Aksi</th>
                                     </tr>
                                 </thead>

                                 <tbody>
                                     <?php
                                        $no = 1;
                                        foreach ($jadwal as $jad) :
                                            $tgl_mulai = DateTime::createFromFormat('Y-m-d', $jad['tgl_mulai'])->format('d F Y');
                                            $tgl_akhir = DateTime::createFromFormat('Y-m-d', $jad['tgl_selesai'])->format('d F Y');
                                            ?>
                                         <tr>
                                             <td><?= $no++ ?></td>
                                             <td><?= ucwords($jad['nama_jadwal']) ?></td>
                                             <td><?= ucwords($jad['nama_jalur_pendaftaran']) ?></td>
                                             <td>
                                                 <?= $tgl_mulai ?>
                                             </td>
                                             <td>
                                                 <?= $tgl_akhir ?>
                                             </td>
                                             <td><a href="" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?= $jad['id_jadwal_pendaftaran'] ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
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

     $('.delete').on('click', function(e) {
         e.preventDefault();
         var dataId = this.id;
         Swal.fire({
             title: 'Hapus Data Jadwal Pendaftaran',
             text: "Apakah anda yakin ingin menghapus data jadwal pendaftaran ini?",
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
                         url: "<?= base_url() ?>admin/jadwal_pendaftaran/delete/" + dataId,
                         data: {
                             'id_pengguna': dataId
                         },
                         success: function(respone) {
                             window.location.href = "<?= base_url('admin/jadwal_pendaftaran') ?>";
                         },
                         error: function(request, error) {
                             window.location.href = "<?= base_url('admin/jadwal_pendaftaran') ?>";
                         },
                     });
                 } else {
                     swal("Cancelled", "Your imaginary file is safe :)", "error");
                 }
             });
     });
 </script>