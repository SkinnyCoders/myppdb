  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard Operator</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3><?=$pendaftar['total']?></h3>

                <p>Peserta Mendaftar</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?= base_url('kepsek/pendaftar') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?=$lengkap_data?></h3>

                <p> Melengkapi Data</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="<?= base_url('kepsek/pendaftar/diterima') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?=$lengkap_berkas?></h3>

                <p> Melengkapi Berkas</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="<?= base_url('kepsek/pendaftar/dicadangkan') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?=$total_ujian?></h3>

                <p> Mengikuti Ujian</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="<?= base_url('kepsek/pendaftar/ditolak') ?>" class="small-box-footer">Lihat detail <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <?php 
          if (!empty($belum_verify_data)) :
           ?>
          <div class="col-md-6">
            <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Verifikasi Data</h5>
                  Ada <strong><?=$belum_verify_data?></strong> peserta yang menunggu untuk diverifikasi datanya! <a style="text-decoration: none;" href="" class="btn btn-xs btn-primary">Verifikasi</a>
                </div>
          </div>
          <?php endif; ?>
          <?php 
          if (!empty($belum_verify_berkas)) :
           ?>
          <div class="col-md-6">
            <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-exclamation-triangle"></i> Verifikasi Berkas</h5>
                  Ada <strong><?=$belum_verify_berkas?></strong> peserta yang menunggu untuk diverifikasi berkasnya! <a style="text-decoration: none;" href="" class="btn btn-xs btn-primary">Verifikasi</a>
                </div>
          </div>
          <?php endif; ?>
        </div>

        <div class="row">
          <!-- DONUT CHART -->
          <div class="col-md-12">
            <!-- PIE CHART -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Grafik Pendaftaran berdasarkan jurusan dan jenis kelamin peserta</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <canvas id="pieChart" style="height:230px; min-height:300px"></canvas>
                  </div>
                  <div class="col-md-6">
                    <canvas id="pieChart2" style="height:230px;"></canvas>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <?php $this->load->view('templates/cdn_admin'); ?>

  <!-- ChartJS -->
  <script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>

  <script>
    $(document).ready(function() {
      var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
      }
            $.ajax({
                type : 'POST',
                url : "<?=base_url('operator/dashboard/get_dataChart2')?>",
                dataType : "json",
                success: function(data){

                    var pieChartCanvas = $('#pieChart2').get(0).getContext('2d');
                    var pieChart = new Chart(pieChartCanvas, {
                      type: 'pie',
                      data: {
                        labels: [
                          'Laki - Laki',
                          'Perempuan'
                        ],
                        datasets: [{
                          data: data.jumlah,
                          backgroundColor: ['#00c0ef', '#00a65a'],
                        }]
                      },
                      options: pieOptions
                    });
                }
            });
        });
  </script>

  <script>
    $(document).ready(function() {
      var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
      }
            $.ajax({
                type : 'POST',
                url : "<?=base_url('operator/dashboard/get_dataChart')?>",
                dataType : "json",
                success: function(data){

                    var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
                    var pieChart = new Chart(pieChartCanvas, {
                      type: 'pie',
                      data: {
                        labels: data.nama_jurusan,
                        datasets: [{
                          data: data.jurusan,
                          backgroundColor: ['#f39c12','#00a65a','#f56954','#00c0ef',  '#eaeaea'],
                        }]
                      },
                      options: pieOptions
                    });
                }
            });
        });
  </script>