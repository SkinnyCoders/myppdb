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
                          <li class="breadcrumb-item active">Informasi</li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Data Informasi</h3>
                              <a class="btn btn-sm btn-primary float-right ml-3" href="<?= base_url('admin/informasi/tambah') ?>"><i class="fa fa-plus"></i> Tambah Informasi</a>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap">Judul Info</th>
                                 <th class="text-nowrap">Deskripsi</th>
                                 <th class="text-nowrap">File Info</th>
                                 <th style="width: 15%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                              <?php 
                              $no = 1;
                              foreach ($informasi as $info) :
                              ?>
                              <tr>
                                <td><?=$no++?></td>
                                <td><?=ucwords($info['judul_informasi'])?></td>
                                <td><?=$info['deskripsi_informasi']?></td>
                                <td>
                                  <?php 
                                  $file = $info['file_informasi'];
                                  $ext_img = ['jpg','png','JPG','JPEG','jpeg'];
                                  $ext = explode('.', $file);
                                  $ext = end($ext);
                                  if (in_array($ext, $ext_img)) {
                                    echo '<img class="brand-image" style="width: 70px; height: 70px; border-radius: 5%" src="'.base_url('assets/uploads/berkas_info/' . $file).'">';
                                  }else{
                                    echo '<a class="btn btn-info btn-xs" target="_blank" href="'.base_url('assets/uploads/berkas_info/'. $file).'">Lihat File '.$ext.'</a>';
                                  }
                                   ?>
                                </td>
                                <td><a href="javascript:void(0)" data-toggle="modal" id="<?= $info['id_informasi']?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?= $info['id_informasi']?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
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
               <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h4 class="modal-title">Edit <span id="nama2"></span></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                         <!-- form start -->
                      <form action="<?= base_url('admin/informasi/update') ?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="form-group">
                          <input type="hidden" name="id" id="id_informasi" value="">

                        <label for="nama">Judul Informasi</label>
                          <input type="text" class="form-control" name="info" id="nama" placeholder="Judul Informasi" value="<?php echo set_value('nama'); ?>">
                          <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                        </div>
                        <div class="form-group">
                          <label for="des">Deskripsi Informasi</label>
                          <textarea class="form-control des" id="des2" name="des" placeholder="Masukan Deskripsi" style="width: 100%; height: 100px;"></textarea>
                            <small class="text-danger mt-2"><?= form_error('des') ?></small>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputFile">File Informasi</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="foto" onchange="loadFile(event)" id="exampleInputFile">
                              <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <img class="mt-2 mb-2 img" style="width: 100%" src="" id="output">
                          </div>
                        </div>
                           <!-- /.card-body -->
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

  <!-- Summernote -->
  <script src="<?= base_url('assets/plugins/summernote/summernote-bs4.min.js') ?>"></script>
  <script>
    $(function() {
      // Summernote
      $('.textarea').summernote()
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


   $('.update').on('click', function() {
     var dataId = this.id;
     $.ajax({
       type: "post",
       url: "<?= base_url('admin/informasi/get_data') ?>",
       data: {
         'id': dataId
       },
       dataType: "json",
       success: function(data) {

         $('#id_informasi').val(data.id_informasi);
         $('#nama').val(data.judul_informasi);
         $('#des2').text(data.deskripsi_informasi);
         $('.img').attr('src', data.file_informasi);
         $('#nama2').text(data.judul_informasi);
       },
     });
   })

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Informasi',
       text: "Apakah anda yakin ingin menghapus data Informasi ini?",
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
             url: "<?= base_url() ?>admin/informasi/delete/" + dataId,
             data: {
               'id_pengguna': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/informasi') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/informasi') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>