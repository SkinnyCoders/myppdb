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
             <li class="breadcrumb-item active">Kouta Pendaftaran</li>
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
         <div class="col-md-4">
           <div class="card">
             <div class="card-header">
               <h3 class="card-title">Tambah Kouta Pendaftaran</h3>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <form action="" method="post">
                 <div class="form-group">
                   <label for="nama">Untuk Jurusan</label>
                   <select class="form-control" name="jurusan">
                     <option value="">Pilih Jurusan</option>
                     <?php if (!empty($jurusan)) {
                        foreach ($jurusan as $j) {
                          echo '<option value="' . $j['id_program_studi'] . '">' . $j['nama_program_studi'] . '</option>';
                        }
                      } ?>
                   </select>
                   <small class="text-danger mt-2"><?= form_error('jurusan') ?></small>
                 </div>
                 <div class="row">
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="nama">Tahun Ajaran</label>
                       <select class="form-control" name="tahun">
                         <option value="">Pilih Tahun</option>
                         <?php if (!empty($tahun)) {
                            foreach ($tahun as $t) {
                              echo '<option value="' . $t['id_tahun_ajaran'] . '">' . $t['tahun_mulai'] . '/' . $t['tahun_akhir'] . '</option>';
                            }
                          } ?>
                       </select>
                       <small class="text-danger mt-2"><?= form_error('tahun') ?></small>
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-group">
                       <label for="nama">Jumlah Kouta</label>
                       <input type="number" min="4" class="form-control nama2" name="kouta" id="nama2" placeholder="Jumlah" value="<?= set_value('kouta') ?>">
                       <small class="text-danger mt-2"><?= form_error('kouta') ?></small>
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

         <!-- right coloum -->
         <div class="col-md-8">
           <div class="card">
             <div class="card-header">
               <h3 class="card-title">Tabel Kuota Pendaftaran</h3>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <table id="example1" class="table table-striped">
                 <thead>
                   <tr>
                     <th class="text-nowrap" style="width: 5%">No</th>
                     <th class="text-nowrap">Tahun Ajaran</th>
                     <th class="text-nowrap">Jumalah Kuota</th>
                     <th class="text-nowrap">Program Studi</th>
                     <th style="width: 15%">Aksi</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                    $no = 1;
                    foreach ($all_kuota as $kuota) :
                      ?>
                     <tr>
                       <td><?= $no++ ?></td>
                       <td><?= $kuota['tahun_mulai'] . '/' . $kuota['tahun_akhir'] ?></td>
                       <td><?= $kuota['jumlah'] ?> orang</td>
                       <td><?= ucwords($kuota['nama_program_studi']) ?></td>
                       <td><a href="javascript:void(0)" data-toggle="modal" id="<?= $kuota['id_kouta_pendaftaran'] ?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?= $kuota['id_kouta_pendaftaran'] ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
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



         <div class="modal fade" id="modal-lg">
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h4 class="modal-title">Edit Kouta Pendaftaran <span id="nama2"></span></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <form action="<?= base_url('admin/sekolah/kuota/update') ?>" method="POST">
                   <div class="form-group">
                     <label for="nama">Untuk Jurusan</label>
                     <input type="hidden" name="id" id="id" value="">
                     <select class="form-control" name="jurusan" id="jurusan">
                       <option value="">Pilih Jurusan</option>
                       <?php if (!empty($jurusan)) {
                          foreach ($jurusan as $j) {
                            echo '<option value="' . $j['id_program_studi'] . '">' . $j['nama_program_studi'] . '</option>';
                          }
                        } ?>
                     </select>
                     <small class="text-danger mt-2"><?= form_error('jurusan') ?></small>
                   </div>
                   <div class="row">
                     <div class="col-md-6">
                       <div class="form-group">
                         <label for="nama">Tahun Ajaran</label>
                         <select class="form-control" name="tahun" id="tahun">
                           <option value="">Pilih Tahun</option>
                           <?php if (!empty($tahun)) {
                              foreach ($tahun as $t) {
                                echo '<option value="' . $t['id_tahun_ajaran'] . '">' . $t['tahun_mulai'] . '/' . $t['tahun_akhir'] . '</option>';
                              }
                            } ?>
                         </select>
                         <small class="text-danger mt-2"><?= form_error('tahun') ?></small>
                       </div>
                     </div>
                     <div class="col-md-6">
                       <div class="form-group">
                         <label for="nama">Jumlah Kouta</label>
                         <input type="number" min="4" class="form-control nama2" name="kouta" id="jumlah" placeholder="Jumlah" value="<?= set_value('kouta') ?>">
                         <small class="text-danger mt-2"><?= form_error('kouta') ?></small>
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


   $('.update').on('click', function() {
     var dataId = this.id;
     $.ajax({
       type: "post",
       url: "<?= base_url('admin/sekolah/kuota/update') ?>",
       data: {
         'id_get_update': dataId
       },
       dataType: "json",
       success: function(data) {
         $('#id').val(data.id_kouta_pendaftaran);
         $('#jumlah').val(data.jumlah);
         $('#tahun').val(data.id_tahun_ajaran);
         $('#jurusan').val(data.id_program_studi).trigger();
       },
     });
   })

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Kuota Pendaftaran',
       text: "Apakah anda yakin ingin menghapus data kuota pendaftaran ini?",
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
             url: "<?= base_url() ?>admin/sekolah/kuota/delete/" + dataId,
             data: {
               'id_pengguna': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/sekolah/kuota') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/sekolah/kuota') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>