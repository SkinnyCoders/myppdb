  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark"><?= ucwords($title) ?><small>(<i>frequently asked question</i>)</small></h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                          <li class="breadcrumb-item active">FAQ</li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Data FAQ (<i>frequently asked question</i>)</h3>
                              <a class="btn btn-sm btn-primary float-right ml-3" href="<?= base_url('admin/faq/tambah') ?>"><i class="fa fa-plus"></i> Tambah FAQ</a>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap">Pertanyaan</th>
                                 <th class="text-nowrap">Jawaban</th>
                                 <th style="width: 15%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                              <?php 
                              $no = 1;
                              foreach ($faq as $f) :
                               ?>
                                 <tr>
                                   <td><?=$no++?></td>
                                   <td><?=ucfirst($f['pertanyaan'])?></td>
                                   <td><?=ucfirst($f['jawaban'])?></td>
                                   <td><a href="javascript:void(0)" data-toggle="modal" id="<?=$f['id_faq']?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?=$f['id_faq']?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
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
                         <form action="<?= base_url('admin/faq/update') ?>" method="post" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                              <input type="hidden" class="id_faq" name="id" value="">

                              <label for="nama">Pertanyaan FAQ</label>
                              <input type="text" class="form-control" name="pertanyaan" id="pertanyaan" placeholder="Pertanyaan" value="<?php echo set_value('nama'); ?>">
                              <small class="text-danger mt-2"><?= form_error('pertanyaan') ?></small>
                            </div>
                            <div class="form-group">
                              <label for="des">Jawaban FAQ</label>
                              <textarea id="jawaban" name="jawaban" class="form-control" style="height: 150px;" placeholder="Masukkan Jawaban"></textarea>
                              <small class="text-danger mt-2"><?= form_error('jawaban') ?></small>
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
       url: "<?= base_url('admin/faq/update') ?>",
       data: {
         'id_get_update': dataId
       },
       dataType: "json",
       success: function(data) {
         $('.id_faq').val(data.id_faq);
         $('#pertanyaan').val(data.pertanyaan);
         $('#jawaban').val(data.jawaban);
         $('#nama2').text(data.pertanyaan);
       },
     });
   })

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data FAQ',
       text: "Apakah anda yakin ingin menghapus data FAQ ini?",
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
             url: "<?= base_url() ?>admin/faq/delete/" + dataId,
             data: {
               'id_pengguna': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/faq') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/faq') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>