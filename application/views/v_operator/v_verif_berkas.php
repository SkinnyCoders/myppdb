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
                              <h3 class="card-title"><i class="far fa-dollar"></i> Data berkas peserta yang sudah lengkap</h3>
                             <!--  <a class="btn btn-sm btn-primary float-right ml-3" href="javascript:void(0)"><i class="fa fa-search"></i> Cari Pendaftar</a> -->
                          </div>
                          <!-- /.card-header -->
                          <!-- form start -->
          
                          <div class="card-body">
                            <table id="example1" class="table table-striped">
                             <thead>
                               <tr>
                                 <th class="text-nowrap" style="width: 5%">No</th>
                                 <th class="text-nowrap" style="width: 15%">No.Pendaftaran</th>
                                 <th class="text-nowrap" style="width: 20%">Nama</th>
                                 <th class="text-nowrap" style="width: 15%">Jalur - Program Studi</th>
                                 <th class="text-nowrap" style="width: 15%">Tahun Ajaran</th>
                                 <th class="text-nowrap" style="width: 10%">Status</th>
                                 <th style="width: 15%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                              <?php 
                              $no = 1;
                              foreach ($daftar as $peserta) :
                                if ($peserta['id_berkas'] !== NULL) :

                                $tahun_ajaran = $this->db->get_where('tahun_ajaran', ['id_tahun_ajaran' => $peserta['id_tahun_ajaran']])->row_array();
                               ?>
                                <tr>
                                  <td><?=$no++?></td>
                                  <td><?=$peserta['no_pendaftaran']?></td>
                                  <td><?=ucwords($peserta['nama_lengkap'])?></td>
                                  <td><?=ucwords($peserta['nama_jalur_pendaftaran'])?> - <?=ucwords($peserta['nama_program_studi'])?></td>
                                  <td><?=$tahun_ajaran['tahun_mulai']?>/<?=$tahun_ajaran['tahun_akhir']?></td>
                                  <td>
                                    <?php 
                                    if ($peserta['status_verifikasi_berkas'] == 'belum') {
                                     echo '<i class="fas fa-lg fa-history text-secondary my-1"></i>';
                                    }elseif($peserta['status_verifikasi_berkas'] == 'sudah'){
                                      echo '<i class="fas fa-lg fa-check text-success my-1"></i>';
                                    }else{
                                      echo '<i class="fas fa-lg fa-times text-danger my-1"></i>';
                                    }
                                    ?>
                                    
                                    </td>
                                  <td><a href="<?=base_url('operator/verifikasi/berkas/detail/'.$peserta['id_peserta'])?>" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-eye"></i> Berkas</a></td>
                                </tr>
                                <?php 
                                  endif;
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
 </script>