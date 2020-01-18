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
                         <li class="breadcrumb-item"><a href="<?= base_url('operator/soal-seleksi') ?>">Soal Seleksi</a></li>
                         <li class="breadcrumb-item active">Detail</li>
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
                             <h3 class="card-title">Tabel data pengguna</h3>
                             <a class="btn btn-sm btn-primary float-right" href="<?= base_url() ?>operator/soal-seleksi/detail/tambah_soal/<?= $id_seleksi ?>"><i class="fa fa-plus"></i> Tambah Soal Tes Seleksi</a>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <table id="example1" class="table table-striped">
                                 <thead>
                                     <tr>
                                         <th class="text-nowrap" style="width: 5%">No</th>
                                         <th class="text-nowrap">Gambar</th>
                                         <th class="text-nowrap">Soal Tes</th>

                                         <th class="text-nowrap">Jawaban A</th>
                                         <th class="text-nowrap">Jawaban B</th>
                                         <th class="text-nowrap">Jawaban C</th>
                                         <th class="text-nowrap">Jawaban D</th>
                                         <th class="text-nowrap">Jawaban Benar</th>
                                         <th style="width: 10%">Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        $no = 1;
                                        if (empty($detail)) {
                                            echo '<td colspan="9" class="text-center"><i> Belum terdapat soal, Harap tambahkan! </i></td>';
                                        }
                                        foreach ($detail as $f) : ?>
                                         <tr>
                                             <td><?= $no++ ?></td>
                                             <td><img class="brand-image" style="width: 70px; height: 70px; border-radius: 5%" src="<?= base_url('assets/img/seleksi_file/' . $f['file_tes']) ?>">
                                             </td>
                                             <td><?= ucwords($f['soal_tes_seleksi']) ?></td>
                                             <td><?= ucwords($f['jawaban_a']) ?></td>
                                             <td><?= ucwords($f['jawaban_b']) ?></td>
                                             <td><?= ucwords($f['jawaban_c']) ?></td>
                                             <td><?= ucwords($f['jawaban_d']) ?></td>
                                             <td><?= ucwords($f['jawaban_benar']) ?></td>
                                             <td><a href="" data-toggle="modal" id="<?= $f['id_soal_tes_seleksi'] ?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-user-edit"></i></a><a href="javascript:void(0)" id="<?= $f['id_soal_tes_seleksi'] ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
                                         </tr>
                                     <?php endforeach; ?>
                                 </tbody>
                             </table>
                         </div>
                         <!-- /.card-body -->
                     </div>
                     <!-- /.card -->

                     <div class="modal fade" id="modal-lg">
                         <div class="modal-dialog modal-lg">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h4 class="modal-title">Edit Soal <span id="nama2"></span></h4>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <form action="<?= base_url() ?>operator/seleksi/update_soal/<?= $id_seleksi ?>" method="POST" enctype="multipart/form-data">
                                         <div class="soal">
                                             <div class="row">
                                                 <div class="col-md-8">
                                                     <div class="form-group">
                                                         <label for="exampleInputFile">Soal Seleksi</label>
                                                         <input type="text" class="form-control" id="soal" name="soal" placeholder="Soal Seleksi">
                                                         <small class="text-danger mt-2"><?= form_error('soal') ?></small>
                                                     </div>
                                                 </div>
                                                 <div class="col-md-4">
                                                     <div class="form-group">
                                                         <label for="exampleInputFile">Foto Penghargaan</label>
                                                         <div class="input-group">
                                                             <div class="custom-file">
                                                                 <input type="file" class="custom-file-input" name="foto" onchange="loadFile(event)" id="exampleInputFile">
                                                                 <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="row">
                                                 <div class="col-md-3">
                                                     <div class="input-group">
                                                         <div class="input-group-prepend">
                                                             <span class="input-group-text">
                                                                 <i class="text-bold">A</i>
                                                             </span>
                                                         </div>
                                                         <input type="text" name="jawab_a" id="jawab_a" class="form-control float-right" placeholder="Jawaban A">
                                                         <small class="text-danger mt-2"><?= form_error('jawab_a') ?></small>
                                                     </div>
                                                 </div>
                                                 <div class="col-md-3">
                                                     <div class="input-group">
                                                         <div class="input-group-prepend">
                                                             <span class="input-group-text">
                                                                 <i class="text-bold">B</i>
                                                             </span>
                                                         </div>
                                                         <input type="text" name="jawab_b" id="jawab_b" class="form-control float-right" placeholder="Jawaban B">
                                                         <small class="text-danger mt-2"><?= form_error('jawab_b') ?></small>
                                                     </div>
                                                 </div>
                                                 <div class="col-md-3">
                                                     <div class="input-group">
                                                         <div class="input-group-prepend">
                                                             <span class="input-group-text">
                                                                 <i class="text-bold">C</i>
                                                             </span>
                                                         </div>
                                                         <input type="text" name="jawab_c" id="jawab_c" class="form-control float-right" placeholder="Jawaban C">
                                                         <small class="text-danger mt-2"><?= form_error('jawab_c') ?></small>
                                                     </div>
                                                 </div>
                                                 <div class="col-md-3">
                                                     <div class="input-group">
                                                         <div class="input-group-prepend">
                                                             <span class="input-group-text">
                                                                 <i class="text-bold">D</i>
                                                             </span>
                                                         </div>
                                                         <input type="text" name="jawab_d" id="jawab_d" class="form-control float-right" placeholder="Jawaban D">
                                                         <small class="text-danger mt-2"><?= form_error('jawab_d') ?></small>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="row mt-3">
                                                 <div class="col-md-12">
                                                     <div class="form-group">
                                                         <select class="form-control" id="jawab_benar" name="jawab_benar">
                                                             <option value="">Pilih Jawaban Benar</option>
                                                             <option value="a">A</option>
                                                             <option value="b">B</option>
                                                             <option value="c">C</option>
                                                             <option value="d">D</option>
                                                         </select>
                                                         <small class="text-danger mt-2"><?= form_error('jawab_benar') ?></small>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="form-group">
                                                 <input type="hidden" value="" name="id_soal" class="form-control" id="id_soal">
                                             </div>
                                             <div class="row">
                                                 <div class="col-md-12">
                                                     <img class="mt-2 mb-2 img" style="width: 100%; max-height: 300px;" src="" id="output">
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

     var loadFile = function(event) {
         var output = document.getElementById('output');
         output.src = URL.createObjectURL(event.target.files[0]);
     };

     $('.update').on('click', function() {
         var dataId = this.id;
         $.ajax({
             type: "post",
             url: "<?= base_url() ?>operator/seleksi/update_soal/<?= $id_seleksi ?>",
             data: {
                 'id': dataId
             },
             dataType: "json",
             success: function(data) {
                 $('#id_soal').val(data.id);
                 $('#soal').val(data.soal);
                 $('#jawab_a').val(data.jawab_a);
                 $('#jawab_b').val(data.jawab_b);
                 $('#jawab_c').val(data.jawab_c);
                 $('#jawab_d').val(data.jawab_d);
                 $('.img').attr('src', data.file);
                 $('#jawab_benar').val(data.jawab_benar).trigger();

             },
         });
     });

     $('.delete').on('click', function(e) {
         e.preventDefault();
         var dataId = this.id;
         Swal.fire({
             title: 'Hapus Data Soal',
             text: "Apakah anda yakin ingin menghapus data soal ini?",
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
                         url: "<?= base_url() ?>operator/seleksi/delete_soal/",
                         data: {
                             'id_soal': dataId
                         },
                         success: function(respone) {
                             window.location.href = "<?= base_url() ?>operator/soal-seleksi/detail/<?= $id_seleksi ?>";
                         },
                         error: function(request, error) {
                             window.location.href = "<?= base_url() ?>operator/soal-seleksi/detail/<?= $id_seleksi ?>";
                         },
                     });
                 } else {
                     swal("Cancelled", "Your imaginary file is safe :)", "error");
                 }
             });
     });
 </script>