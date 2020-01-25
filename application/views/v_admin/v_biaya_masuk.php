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
                          <li class="breadcrumb-item active">Biaya Masuk</li>
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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Data Biaya Masuk</h3>
                              <a class="btn btn-sm btn-primary float-right ml-3" href="<?= base_url('admin/pendaftaran/biaya_masuk/tambah') ?>"><i class="fa fa-plus"></i> Tambah Biaya Masuk</a>
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap">Biaya</th>
                                 <th class="text-nowrap">Jalur - Jurusan</th>
                                 <th class="text-nowrap">Tahun Ajaran</th>
                                 <th class="text-nowrap">Jumlah</th>
                                 <th style="width: 15%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                              <?php 
                              $no = 1;
                              foreach ($biaya as $b) : ?>
                              <tr>
                                <td><?=$no++?></td>
                                <td><?=ucwords($b['jenis_biaya_masuk'])?></td>
                                <td><?=ucwords($b['nama_jalur_pendaftaran'])?> - <?=ucwords($b['nama_program_studi'])?></td>
                                <td><?=ucwords($b['tahun_mulai'])?>/<?=ucwords($b['tahun_akhir'])?></td>
                                <td>Rp. <?=number_format($b['jumlah_biaya_masuk'], 0, '.', '.')?></td>
                                <td><a href="javascript:void(0)" data-toggle="modal" id="<?=$b['id_biaya_masuk']?>" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" id="<?=$b['id_biaya_masuk']?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
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
                      <form action="<?= base_url('admin/pendaftaran/biaya_masuk/update') ?>" method="post" role="form" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id_biaya" value="">
                      <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                            <label for="biaya">Biaya Masuk</label>
                            <input type="text" class="form-control" name="biaya" id="biaya" placeholder="Biaya Masuk" value="<?php echo set_value('nama'); ?>">
                            <small class="text-danger mt-2"><?= form_error('biaya') ?></small>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="tahun">Tahun Ajaran</label>
                            <select id="tahun" class="form-control" name="tahun_ajaran" style="width: 100%;" data-placeholder="Pilih Tahun Ajaran">
                              <?php foreach ($tahun_ajaran as $tahun) {
                                echo '<option value="'.$tahun['id_tahun_ajaran'].'">'.$tahun['tahun_mulai'].'/'.$tahun['tahun_akhir'].'</option>';
                              } ?>
                            </select>
                            <small class="text-danger mt-2"><?= form_error('tahun_ajaran') ?></small>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="nama">Program Studi</label>
                            <select class="form-control" id="jurusan" name="jurusan" style="width: 100%;" data-placeholder="Pilih Program Studi">
                              <?php 
                                foreach ($jurusan as $j) {
                                  echo '<option value="'.$j['id_program_studi'].'">'.$j['nama_program_studi'].'</option>';
                                }
                               ?>
                            </select>
                            <small class="text-danger mt-2"><?= form_error('jurusan') ?></small>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="nama">Jalur Pendaftaran</label>
                            <select class="form-control jalur" name="jalur" id="jalur" style="width: 100%;" data-placeholder="Pilih Jalur Pendaftaran">
                              <option></option>
                            </select>
                            <small class="text-danger mt-2"><?= form_error('jalur') ?></small>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="jumlah">Jumlah Biaya</label>
                        <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah Rp." value="<?php echo set_value('jumlah'); ?>">
                        <small class="text-danger mt-2"><?= form_error('jumlah') ?></small>
                      </div>
                      <!--  <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                      </div> -->
                    </div>
                    <!-- /.card-body -->
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


   $('.update').on('click', function() {
     var dataId = this.id;
     $.ajax({
       type: "post",
       url: "<?= base_url('admin/pendaftaran/biaya_masuk/get_data') ?>",
       data: {
         'id': dataId
       },
       dataType: "json",
       success: function(data) {
         $('#id_biaya').val(data.id_biaya_masuk);
         $('#biaya').val(data.jenis_biaya_masuk);
         $('#jumlah').val(data.jumlah_biaya_masuk);
         $('#nama2').text(data.jenis_biaya_masuk);
         $('#tahun').val(data.id_tahun_ajaran);
         $('#jurusan').val(data.id_program_studi);
         
       },
     });


     var id_jurusan = $('#jurusan').val();

      $.ajax({
        type : "POST",
        url : "<?=base_url('admin/pendaftaran/biaya_masuk/get_jalur')?>",
        data : {'id':id_jurusan},
        dataType : "json",
        success : function(data){
          var html = '';
          var i;

          for (i=0;i<data.length; i++) {
            html += '<option value="'+data[i].id_jalur_pendaftaran+'">'+data[i].nama_jalur_pendaftaran+'</option>';
          }

          $('#jalur').html(html);
        }
      })
   });

   $('.delete').on('click', function(e) {
     e.preventDefault();
     var dataId = this.id;
     Swal.fire({
       title: 'Hapus Data Biaya Masuk',
       text: "Apakah anda yakin ingin menghapus data Biaya Masuk ini?",
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
             url: "<?= base_url() ?>admin/pendaftaran/biaya_masuk/delete/" + dataId,
             data: {
               'id_pengguna': dataId
             },
             success: function(respone) {
               window.location.href = "<?= base_url('admin/pendaftaran/biaya_masuk') ?>";
             },
             error: function(request, error) {
               window.location.href = "<?= base_url('admin/pendaftaran/biaya_masuk') ?>";
             },
           });
         } else {
           swal("Cancelled", "Your imaginary file is safe :)", "error");
         }
       });
   });
 </script>

 <script>
    $(document).ready(function(){
      var id_jurusan = $('#jurusan').val();

      $.ajax({
        type : "POST",
        url : "<?=base_url('admin/pendaftaran/biaya_masuk/get_jalur')?>",
        data : {'id':id_jurusan},
        dataType : "json",
        success : function(data){
          var html = '';
          var i;

          for (i=0;i<data.length; i++) {
            html += '<option value="'+data[i].id_jalur_pendaftaran+'">'+data[i].nama_jalur_pendaftaran+'</option>';
          }

          $('#jalur').html(html);
        }
      })
    });
  </script>