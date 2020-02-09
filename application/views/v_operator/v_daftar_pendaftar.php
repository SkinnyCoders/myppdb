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
      <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3><?=$rincian['onproses']?></h3>

                <p>Dalam Proses</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?=$rincian['diterima']?></h3>

                <p> DIterima</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?=$rincian['dicadangkan']?></h3>

                <p> Dicadangkan</p>
              </div>
              <div class="icon">
                <i class="ion ion-bookmark"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?=$rincian['tidakditerima']?></h3>

                <p> Tidak Diterima</p>
              </div>
              <div class="icon">
                <i class="ion ion-close"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-default ">
            <div class="card-header">
              <h3 class="card-title"><i class="far fa-dollar"></i> Data berhasil melakukan pendaftaran</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body">
              <table id="example1" class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-nowrap" style="width: 5%">No</th>
                    <th class="text-nowrap" style="width: 10%">No.Pendaftaran</th>
                    <th class="text-nowrap" style="width: 20%">Nama</th>
                    <th class="text-nowrap" style="width: 20%">Jalur - Program Studi</th>

                    <th class="text-nowrap" style="width: 10%">Tahun Ajaran</th>
                    <th class="text-nowrap" style="width: 10%">Status</th>
                    <th style="width: 10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($daftar as $d) :

                    $cekCadangan = $this->db->get_where('pencadangan', ['id_pendaftaran' => $d['id_pendaftaran'], 'status_pencadangan' => 'true'])->row_array();
                    $tahun_ajaran = $this->db->get_where('tahun_ajaran', ['id_tahun_ajaran' => $d['id_tahun_ajaran']])->row_array();
                  ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $d['no_pendaftaran'] ?></td>
                      <td><?= ucwords($d['nama_lengkap']) ?></td>
                      <td><?= ucwords($d['nama_jalur_pendaftaran']) ?> - <?= ucwords($d['nama_program_studi']) ?></td>
                      <td><?= $tahun_ajaran['tahun_mulai'] ?>/<?= $tahun_ajaran['tahun_akhir'] ?></td>
                      <td>
                        <?php

                        if ($cekCadangan !== NULL) {
                          echo '<label class="btn btn-sm btn-warning">Dicadangkan</label>';
                        } elseif ($d['status_kelulusan'] == 'lulus') {
                          echo '<label class="btn btn-sm btn-success">Diterima</label>';
                        } elseif ($d['status_kelulusan'] == 'tidak_lulus') {
                          echo '<label class="btn btn-sm btn-danger">Ditolak</label>';
                        } elseif (empty($d['status_kelulusan'])) {
                          echo '<label class="btn btn-sm btn-default">Proses</label>';
                        }
                        ?>

                      </td>
                      <td><a href="<?= base_url('operator/pendaftar/detail/' . $d['id_peserta']) ?>" target="_blank" id="" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-eye"></i> Detail</a></td>
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