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
                             <a class="btn btn-sm btn-primary float-right" href="<?= base_url('admin/pendaftaran/jadwal/tambah') ?>"><i class="fa fa-plus"></i> Tambah Jadwal Pendaftaran</a>
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
                                             <td><a href="javascript:void(0)" class="btn btn-sm btn-primary mr-3 update" data-toggle="modal" id="<?= $jad['id_jadwal_pendaftaran'] ?>" data-target="#modal-lg"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?= $jad['id_jadwal_pendaftaran'] ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
                                         </tr>
                                     <?php endforeach; ?>
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
                         <h4 class="modal-title">Edit Jadwal Pendaftaran</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                       <div class="modal-body">
                        <!-- form start -->
                            <form action="<?= base_url('admin/pendaftaran/jadwal/update') ?>" method="post" role="form" enctype="multipart/form-data">
                             <div class="row">
                                <div class="col-md-8">
                                    <label for="nama">Nama Kegiatan</label>
                                    <input type="hidden" name="id_jadwal" value="" id="id_jadwal">
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kegiatan" value="<?php echo set_value('nama'); ?>">
                                    <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="des">Jalur Pendaftaran</label>
                                        <select name="jalur" id="jalur" class="form-control">
                                            <option value="">Pilih Jalur Pendaftaran</option>
                                            <?php foreach ($jalur as $j) { ?>
                                            <option value="<?= $j['id_jalur_pendaftaran'] ?>"><?= ucwords($j['nama_jalur_pendaftaran']) ?></option>
                                                  <?php } ?>
                                        </select>
                                        <small class="text-danger mt-2"><?= form_error('jalur') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal Mulai</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                        <input type="text" name="tgl_mulai" class="form-control float-right tgl_mulai" placeholder="Pilih Tanggal" id="datepicker">
                                        </div>
                                        <!-- /.input group -->
                                        <small class="text-danger mt-2"><?= form_error('tgl_mulai') ?></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal Berakhir</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="tgl_akhir" class="form-control float-right tgl_akhir" placeholder="Pilih Tanggal" id="datepicker2">
                                        </div>
                                              <!-- /.input group -->
                                        <small class="text-danger mt-2"><?= form_error('tgl_akhir') ?></small>
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
 <!-- bootstrap datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

 <script>
      $(function() {
          //Date picker
          $('#datepicker').datepicker({
              autoclose: true
          })
      })
  </script>

  <script>
      $(function() {
          //Date picker
          $('#datepicker2').datepicker({
              autoclose: true
          })
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

     $('.update').on('click', function(){
        var id_jadwal = this.id;

        $.ajax({
            type : "POST",
            url : "<?=base_url('admin/pendaftaran/jadwal/update')?>",
            data : {'id_jadwal_update' : id_jadwal},
            dataType : "json",
            success : function(data){
                $('#id_jadwal').val(data.id_jadwal);
                $('#nama').val(data.nama_jadwal);
                $('#jalur').val(data.id_jalur).change();
                $('.tgl_mulai').val(data.tgl_mulai);
                $('.tgl_akhir').val(data.tgl_selesai);
            }
        })
     })

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
                         url: "<?= base_url() ?>admin/pendaftaran/jadwal/delete/" + dataId,
                         data: {
                             'id_pengguna': dataId
                         },
                         success: function(respone) {
                             window.location.href = "<?= base_url('admin/pendaftaran/jadwal') ?>";
                         },
                         error: function(request, error) {
                             window.location.href = "<?= base_url('admin/pendaftaran/jadwal') ?>";
                         },
                     });
                 } else {
                     swal("Cancelled", "Your imaginary file is safe :)", "error");
                 }
             });
     });
 </script>