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
             <li class="breadcrumb-item active">Program Studi</li>
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
               <h3 class="card-title">Tabel data program studi</h3>
               <a class="btn btn-sm btn-primary float-right" href="<?= base_url('admin/sekolah/program_studi/tambah') ?>"><i class="fa fa-user-plus"></i> Tambah Program Studi</a>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <table id="example1" class="table table-striped">
                 <thead>
                   <tr>
                     <th class="text-nowrap" style="width: 5%">No</th>
                     <th class="text-nowrap">Program Studi</th>
                     <th class="text-nowrap">Akreditasi</th>
                     <th class="text-nowrap">Deskripsi</th>
                     <th style="width: 12%">Aksi</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                    if (!empty($jurusan)) :
                      foreach ($jurusan as $jurus) :
                        ?>
                       <tr>
                         <td>1</td>
                         <td><?= ucwords($jurus['nama_program_studi']) ?></td>
                         <td><?= strtoupper($jurus['akreditasi_program_studi']) ?></td>
                         <td><?= word_limiter(ucfirst($jurus['deskripsi_program_studi']), 27) ?></td>
                         <td><a href="javascript:void(0)" data-toggle="modal" id="<?= $jurus['id_program_studi'] ?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?= $jurus['id_program_studi'] ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
                       </tr>
                   <?php
                      endforeach;
                    endif;
                    ?>
                 </tbody>
               </table>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>

         <div class="modal fade" id="modal-lg">
           <div class="modal-dialog modal-lg">
             <div class="modal-content">
               <div class="modal-header">
                 <h4 class="modal-title">Edit Program Studi <span id="nama2"></span></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <div class="modal-body">
                 <div class="row">
                   <div class="col-md-12">
                     <!-- form start -->
                     <form action="<?= base_url('admin/sekolah/program_studi/update') ?>" method="post" role="form" enctype="multipart/form-data">
                       <div class="row">
                         <div class="col-md-9">
                           <div class="form-group">
                             <label for="nama">Nama Program Studi</label>
                             <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Program Studi" value="<?php echo set_value('nama'); ?>">

                             <input type="hidden" class="id" name="id" value="" required>
                             <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                           </div>
                         </div>
                         <div class="col-md-3">
                           <div class="form-group">
                             <label for="exampleInputEmail1">Akreditasi</label>
                             <select name="akreditasi" class="form-control akreditasi">
                               <option value="">Pilih Akreditasi</option>
                               <option value="a">A</option>
                               <option value="b">B</option>
                               <option value="c">C</option>
                               <option value="belum">Belum</option>
                             </select>
                             <!-- /.input group -->
                             <small class="text-danger mt-2"><?= form_error('akreditasi') ?></small>
                           </div>
                         </div>
                       </div>
                       <div class="form-group">
                         <label for="des">Deskripsi Program Studi</label>
                         <textarea id="des" name="deskripsi" class="form-control" style="height: 150px;" placeholder="Masukkan Deskripsi"><?php if (!empty($profile)) {
                                                                                                                                            echo $profile['visi_sekolah'];
                                                                                                                                          } ?></textarea>
                         <small class="text-danger mt-2"><?= form_error('deskripsi') ?></small>
                       </div>
                       <div class="form-group">
                         <label for="exampleInputFile">Foto Program Studi</label>
                         <div class="input-group">
                           <div class="custom-file">
                             <input type="file" class="custom-file-input" name="foto" onchange="loadFile(event)" id="exampleInputFile">
                             <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                           </div>
                         </div>
                       </div>
                       <div class="row">
                         <div class="col-md-12">
                           <img class="mt-2 mb-2 img" style="width: 100%" src="" id="output">
                         </div>
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
       url: "<?= base_url('admin/sekolah/program_studi/update') ?>",
       data: {
         'id_get_update': dataId
       },
       dataType: "json",
       success: function(data) {
         $('.id').val(data.id);
         $('#nama').val(data.nama);
         $('#nama2').text(data.nama);
         $('#des').text(data.deskripsi);
         $('.img').attr('src', data.foto);
         $('.akreditasi').val(data.akreditasi).trigger();
       },
     });
   })

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Program Studi',
       text: "Apakah anda yakin ingin menghapus data Program Studi ini?",
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
             url: "<?= base_url() ?>admin/sekolah/program_studi/delete/" + dataId,
             data: {
               'id_pengguna': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/sekolah/program_studi') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/sekolah/program_studi') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>