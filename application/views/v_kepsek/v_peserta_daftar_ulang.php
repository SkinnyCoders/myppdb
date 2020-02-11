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
                          <li class="breadcrumb-item active">Peserta Daftar Ulang</li>
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
                              <h3 class="card-title">Tabel data peserta yang telah melakukan daftar ulang</h3>

                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                              <table id="example1" class="table table-striped">
                                  <thead>
                                      <tr>
                                          <th class="text-nowrap" style="width: 5%">No</th>
                                          <th class="text-nowrap" style="width: 20%">Nama</th>

                                          <th class="text-nowrap">No Pendaftaran</th>
                                          <th class="text-nowrap">Tanggal</th>
                                          <th class="text-nowrap">Program Studi</th>
                                          <th class="text-nowrap">Jalur Pendaftaran</th>
                                          <th class="text-nowrap">Tahun Ajaran</th>
                                          <th class="text-nowrap">Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                    $no = 1;
                                    foreach ($peserta as $p):
                                      $tahun = $p['tahun_mulai'].'/'.$p['tahun_akhir'];

                                      $tgl = DateTime::createFromFormat('Y-m-d', $p['tgl'])->format('d F Y');

                                     ?>
                                      <tr>
                                          <td><?= $no++ ?></td>
                                          <td><?= ucwords($p['nama_lengkap'])?></td>
                                          <td><?= $p['no_pendaftaran']?></td>
                                          <td><?= $tgl ?></td>
                                          <td><?= ucwords($p['nama_program_studi'])?></td>
                                          <td><?= ucwords($p['nama_jalur_pendaftaran'])?></td>
                                          <td><?= $tahun ?></td>
                                          <td><a href="<?php echo base_url('kepsek/peserta/detail/'.$p['id_peserta']) ?>" class="btn btn-sm btn-success">Detail</a></td>
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
          </div>
      </section>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('templates/cdn_admin'); ?>

<!--   <script src="<?= base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.flash.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script> -->

<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
  <script>
      $(document).ready(function() {
          $('#example1').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              dom: 'Bfrtip',
              buttons: [
                {
                  extend: 'copy',
                  text: 'Copy',
                  exportOptions: {
                    columns: [0,1, 2, 3,4,5,6],
                  }
                },
                {
                  extend: 'print',
                  text: 'Print',
                  exportOptions: {
                    columns: [0,1, 2, 3,4,5,6],
                  }
                },
                {
                  extend: 'pdf',
                  text: 'PDF',
                  exportOptions: {
                    columns: [0,1, 2, 3,4,5,6],
                  }
                },
                {
                  extend: 'excel',
                  text: 'Excel',
                  exportOptions: {
                    columns: [0,1, 2, 3,4,5,6],
                  }
                }
              ]

          });
      });
  </script>