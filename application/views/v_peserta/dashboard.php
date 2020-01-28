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
                          <li class="breadcrumb-item active">Dashboard Peserta</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
          <div class="container-fluid">

            <?php if (!empty($cabut)) { ?>
              <div class="row">
               <div class="col-md-12">
                <div class="callout callout-warning">
                  <h4> <i style="color: orange;" class="fa fa-exclamation-triangle"></i> Anda telah melakukan pencabutan berkas!</h4>

                  <p>Anda telah melakukan pencabutan berkas, yang berarti otomatis anda telah mengundurkan dari dari proses penerimaan peserta didik baru SMK Muhammadiyah Mlati. klik <a style="color: orange" href="<?=base_url('peserta/cabut_berkas')?>">disini</a> untuk membatalkan proses pencabutan.</p>
                </div>
              </div>
            </div>
            <?php }else{ ?>
      
            <?php if (!empty($status['status_kelulusan'])){ ?>
            <div class="row">
              <?php if ($status['status_kelulusan'] == 'lulus') { ?>
              <div class="col-md-12">
                <div class="callout callout-success">
                  <h4><i style="color: green;" class="fa fa-check"></i> Selamat Anda diterima!</h4>

                  <p>Silahkan melakukan daftar ulang dengan melunasi biaya daftar ulang, dengan datang langsung kesekolah serta membawa bukti bahwa peserta telah diterima untuk ditunjukan kepada panitia.</p>

                  <a href="<?=base_url('peserta/generate_kartu/pdf')?>" class="btn btn-sm btn-info">Download Bukti</a>
                </div>
              </div>

             
              <?php }else{ ?>
              <div class="col-md-12">
                <div class="callout callout-danger">
                  <h4>Mohon maaf anda belum diterima!</h4>

                  <p>Mohon maaf anda belum dapat diterima karena ada beberapa bersyaratan yang tidak terpenuhi.</p>
                </div>
              </div>
              <?php } ?>
            </div>
          <?php }else{ ?>

          <?php if ($pencadangan > 0) : ?>
            <div class="row">
               <div class="col-md-12">
                <div class="callout callout-warning">
                  <h4>Status anda saat ini sedang dicadangkan!</h4>

                  <p>Dikarenakan kuota pendaftaran untuk program studi yang anda ambil sudah penuh, Anda akan otomatis terdaftar jika terdapat penambahan kuota atau terdapat peserta yang mengundurkan diri.</p>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php } ?>
        <?php } ?>
        <!-- end if pencabutan -->
              <div class="row my-3">
                  <div class="col-md-4">
                      <h5 class="font-weight-bold text-dark">Status Peserta</h5>
                      <ul class="list-group">
                          <li class="list-group-item">
                              Aktifasi Akun
                              <i class="fas fa-lg fa-check text-success float-right my-1"></i>
                          </li>
                          <li class="list-group-item">
                              Kelengkapan Data
                              <?php if ($data_all == NULL || in_array(NULL, $data_all)) { ?>
                                  <i class="fas fa-lg fa-times text-danger float-right my-1"></i>
                              <?php } else { ?>
                                  <i class="fas fa-lg fa-check text-success float-right my-1"></i>
                              <?php } ?>
                          </li>
                          <li class="list-group-item">
                              Kelengkapan Berkas
                              <?php if ($berkas == NULL || in_array(NULL, $berkas)) { ?>
                                  <i class="fas fa-lg fa-times text-danger float-right my-1"></i>
                              <?php } else { ?>
                                  <i class="fas fa-lg fa-check text-success float-right my-1"></i>
                              <?php } ?>
                          </li>
                      </ul>
                  </div>
                  <div class="col-md-4">
                      <h5 class="font-weight-bold text-dark">Tahap Pendaftar</h5>
                      <ul class="list-group">
                          <li class="list-group-item">
                              Membuat Akun
                              <i class="fas fa-lg fa-check text-success float-right my-1"></i>
                          </li>
                          <li class="list-group-item">
                              Melengkapi Persyaratan
                              <?php if ($data_all == NULL || in_array(NULL, $data_all) || $berkas == NULL || in_array(NULL, $berkas)) { ?>
                                  <i class="fas fa-lg fa-history text-secondary float-right my-1"></i>
                              <?php } else { ?>
                                  <i class="fas fa-lg fa-check text-success float-right my-1"></i>
                              <?php } ?>

                          </li>
                          <li class="list-group-item">
                              Tes Seleksi
                              <?php
                              foreach ($seleksi as $s) {
                                  $tes[] = in_array('false', $s);
                                }

                              if (!empty($seleksi)) {


                                var_dump($tes);
                                if ($tes == false) {
                                   echo '<i class="fas fa-lg fa-check text-success float-right my-1"></i>';
                                 }else{
                                  echo '<i class="fas fa-lg fa-history text-secondary float-right my-1"></i>';
                                 } ?>
                              <?php
                              }else{
                              ?>
                              <i class="fas fa-lg fa-history text-secondary float-right my-1"></i>
                              <?php } ?>
                          </li>

                      </ul>
                  </div>
                  <div class="col-md-4">
                      <h5 class="font-weight-bold text-dark">Status Pendaftar</h5>
                      <ul class="list-group">
                          <li class="list-group-item">
                              Verifikasi Data
                              <?php if ($pendaftaran['status_verifikasi_data'] !== 'belum') {
                                echo '<i class="fas fa-lg fa-check text-success float-right my-1"></i>';
                              }else{
                                echo '<i class="fas fa-lg fa-history text-secondary float-right my-1"></i>';
                              }?>
                              

                          </li>
                          <li class="list-group-item">
                              Verifikasi Berkas
                               <?php if ($pendaftaran['status_verifikasi_berkas'] !== 'belum') {
                                echo '<i class="fas fa-lg fa-check text-success float-right my-1"></i>';
                              }else{
                                echo '<i class="fas fa-lg fa-history text-secondary float-right my-1"></i>';
                              }?>
                          </li>
                          <li class="list-group-item">
                              Kelulusan
                              <?php 
                              if ($status['status_kelulusan'] !== NULL) {
                                if ($status['status_kelulusan'] == 'lulus') {
                                  echo '<i class="fas fa-lg fa-check text-success float-right my-1"></i>';
                                }else{
                                  echo '<i class="fas fa-lg fa-times text-danger float-right my-1"></i>';
                                }
                              }else{
                                echo '<i class="fas fa-lg fa-history text-secondary float-right my-1"></i>';
                              }
                               ?>
                              
                          </li>
                      </ul>
                  </div>

              </div>
              <div class="row my-3 mt-4">
                <div class="col-md-12">
                    <h5 class="font-weight-bold text-dark">Jadwal Penting</h5>
                    <hr>
                    <ul class="list-group mb-3">
                      <?php foreach ($data_jadwal as $jadwal) : 
                        $tgl_mulai = DateTime::createFromFormat('Y-m-d', $jadwal['tgl_mulai'])->format('d F Y');
                        $tgl_selesai = DateTime::createFromFormat('Y-m-d', $jadwal['tgl_selesai'])->format('d F Y');

                      ?>
                          <li class="list-group-item">
                              <strong><?=ucwords($jadwal['nama_jadwal'])?></strong>
                              <span>:</span>
                              <span class="float-right my-1"><?=$tgl_mulai?> s/d <?=$tgl_selesai?></span>
                          </li>
                      <?php endforeach; ?>
                      </ul>
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
          /* ChartJS
           * -------
           * Here we will create a few charts using ChartJS
           */

          //-------------
          //- PIE CHART -
          //-------------
          // Get context with jQuery - using jQuery's .get() method.
          var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
          var donutData = {
              labels: [
                  'Pendaftar',
                  'Diterima',
                  'Ditolak',
                  'Dicadangkan',
                  'Daftar Ulang'
              ],
              datasets: [{
                  data: [1000, 500, 100, 380, 20],
                  backgroundColor: ['#00c0ef', '#00a65a', '#f56954', '#f39c12', '#eaeaea'],
              }]
          }
          var pieOptions = {
              maintainAspectRatio: false,
              responsive: true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          var pieChart = new Chart(pieChartCanvas, {
              type: 'pie',
              data: donutData,
              options: pieOptions
          })
      })
  </script>