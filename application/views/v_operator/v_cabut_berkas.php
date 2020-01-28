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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Data Peserta Cabut Berkas</h3>
                              <a class="btn btn-sm btn-primary float-right ml-3 cabut" data-toggle="modal" data-target="#modal-lg" href="javascript:void(0)"><i class="fa fa-plus"></i> Cabut Berkas</a>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                                <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap" style="width: 12%">No.Pendaftaran</th>
                                 <th class="text-nowrap" style="width: 18%">Nama</th>
                                 <th class="text-nowrap" style="width: 15%">Jalur - Program Studi</th>
                                 <th class="text-nowrap" style="width: 10%">Tahun Ajaran</th>
                                 <th style="width: 5%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                              <?php 
                              $no = 1;
                              foreach ($cabut_berkas as $cabut) :?>
                                <tr>
                                  <td><?=$no++?></td>
                                  <td><?=ucwords($cabut['no_pendaftaran'])?></td>
                                  <td><?=ucwords($cabut['nama_lengkap'])?></td>
                                  <td><?=ucwords($cabut['nama_jalur_pendaftaran'])?> - <?=ucwords($cabut['nama_program_studi'])?></td>
                                  <td><?=ucwords($cabut['tahun_mulai'])?>/<?=ucwords($cabut['tahun_akhir'])?></td>
                                  <td><a href="javascript:void(0)" id="<?=$cabut['id_pendaftaran']?>" class="btn btn-sm btn-warning delete"><i class="fa fa-times"></i></a></td>
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
                     <h4 class="modal-title">Cabut Berkas Peserta</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                     <div class="row">
                       <div class="col-md-12">
                         <!-- form start -->
                         <form action="<?= base_url('operator/pendaftar/cabut') ?>" method="post" role="form" enctype="multipart/form-data">
                            
                             <div class="form-group">
                               <label for="nama">Peserta</label>
                               <select class="form-control select2bs4" name="peserta" data-placeholder="Pilih Peserta">
                                <option></option>
                                <?php 
                                foreach ($peserta as $p) { ?>
                                  <option value="<?=$p['id_peserta']?>"><?=ucwords($p['no_pendaftaran'])?> - <?=ucwords($p['nama_lengkap'])?></option>
                                  <?php
                                }
                                 ?>
                                
                               </select>
                               <small class="text-danger mt-2"><?= form_error('peserta') ?></small>

                               <input type="hidden" name="id" class="id" value="" required>
                             </div>
                             <div class="form-group">
                               <label for="des">Keterangan</label>
                               <textarea id="des" name="keterangan" class="form-control des" style="height: 150px;" placeholder="Masukkan Keterangan"></textarea>
                               <small class="text-danger mt-2"><?= form_error('keterangan') ?></small>
                             </div>
                             
                           <!-- /.card-body -->
                       </div>
                     </div>
                   </div>
                   <div class="modal-footer justify-content-between">
                     <button type="submit" name="simpan" class="btn btn-primary">Cabut Berkas</button>
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
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
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
    $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Batalkan Pencabutan Berkas!',
       text: "Apakah anda yakin ingin membatalkan Pencabutan berkas?",
       type: "warning",
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Ya, Batalkan!'
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
               window.location.href = "<?= base_url('operator/pendaftar/cabut_berkas') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('operator/pendaftar/cabut_berkas') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
  </script>