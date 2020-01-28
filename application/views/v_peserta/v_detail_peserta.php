  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $title ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">No.Pendaftaran : <?= $pendaftaran['no_pendaftaran'] ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
    switch ($status) {
      case "diterima":
        $color_badge = 'green';
        break;
      case "dicadangkan":
        $color_badge = 'yellow';
        break;
      case "ditolak":
        $color_badge = 'red';
        break;
      default:
        $color_badge = 'blue';
        break;
    }
    ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <div class="card bg-light">
              <div class="card-header text-muted border-bottom-0">

              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-md-4 text-center">
                    <?php if (!empty($berkas['pas_foto'])) { ?>
                      <img src="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['pas_foto']) ?>" class="img-peserta" alt="" class="img-circle">
                    <?php } else { ?>
                      <img src="<?= base_url('assets/img/uploads/default-image.png') ?>" class="img-peserta" alt="" class="img-circle">
                    <?php } ?>
                  </div>

                  <?php if (!empty($detail['id_data_diri'])) :
                    $tgl_lahir = DateTime::createFromFormat('Y-m-d', $detail['tgl_lahir'])->format('d F Y');
                    if ($detail['jenis_kelamin'] == 'L') {
                      $gender = 'Laki - Laki';
                    } else {
                      $gender = "Perempuan";
                    }

                  ?>
                    <div class="col-md-8">
                      <h1 class="text-header"><b><?= ucwords($detail['nama_lengkap']) ?></b> <i style="font-size:20px; color:<?= $color_badge ?>" class="fas fa-sm fa-check-circle"></i></h1>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> <b>NISN</b>: <?= $detail['nisn'] ?></li>
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> <b>Email</b>: <?= $detail['email_peserta'] ?></li>
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-venus-mars"></i></span> <b>Jenis Kelamin</b> : <?= $gender ?></li>
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span> <b>Tanggal lahir</b> : <?= ucwords($tgl_lahir) ?></li>
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-map"></i></span> <b>Tempat lahir</b> : <?= (!empty($detail['tempat_lahir']) ? ucwords($detail['tempat_lahir']) : 'Kosong') ?></li>
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-mobile"></i></span> <b>No Telp</b> : <?= (!empty($detail['no_hp']) ? ucwords($detail['no_hp']) : 'Kosong') ?></li>
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-heart"></i></span> <b>Agama</b> : <?= (!empty($detail['agama']) ? ucwords($detail['agama']) : 'Kosong') ?></li>
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> <b>Alamat</b> : <?= ucfirst($detail['alamat_rumah']) ?></li>

                      </ul>
                    </div>
                  <?php endif; ?>
                </div>
                <!-- info row -->
                <div class="row mt-5 invoice-info">
                  <div class="col-sm-6 invoice-col">
                    <h5><strong>Data Orang Tua</strong></h5>
                    <table class="table table-responsive table-striped borderless">
                      <tr>
                        <th class="text-nowrap" style="width:25%;">Nama Ayah</th>
                        <td class="text-nowrap" style="width:5%;">:</td>
                        <td><?= (!empty(ucwords($detail['nama_ortu_ayah'])) ? ucwords($detail['nama_ortu_ayah']) : 'Kosong') ?></td>
                      </tr>
                      <tr>
                        <th class="text-nowrap" style="width:25%;">Pekerjaan Ayah</th>
                        <td class="text-nowrap" style="width:5%;">:</td>
                        <td><?= (!empty($detail['pekerjaan_ortu_ayah']) ? ucfirst($detail['pekerjaan_ortu_ayah']) : 'Kosong') ?></td>
                      </tr>
                      <tr>
                        <th class="text-nowrap" style="width:25%;">Alamat Ayah</th>
                        <td class="text-nowrap" style="width:5%;">:</td>
                        <td><?= (!empty(ucwords($detail['alamat_ortu_ayah'])) ? ucwords($detail['alamat_ortu_ayah']) : 'Kosong') ?></td>
                      </tr>
                      <tr>
                        <th class="text-nowrap" style="width:25%;">No Telp Ayah</th>
                        <td class="text-nowrap" style="width:5%;">:</td>
                        <td><?= (!empty(ucwords($detail['no_hp_ortu_ayah'])) ? ucwords($detail['no_hp_ortu_ayah']) : 'Kosong') ?></td>
                      </tr>
                      <tr>
                        <th class="text-nowrap" style="width:25%;">Nama Ibu</th>
                        <td class="text-nowrap" style="width:5%;">:</td>
                        <td><?= (!empty($detail['nama_ortu_ibu']) ? ucwords($detail['nama_ortu_ibu']) : 'Kosong') ?></td>
                      </tr>
                      <tr>
                        <th class="text-nowrap" style="width:25%;">Pekerjaan Ibu</th>
                        <td class="text-nowrap" style="width:5%;">:</td>
                        <td><?= (!empty($detail['pekerjaan_ortu_ibu']) ? ucwords($detail['pekerjaan_ortu_ibu']) : 'Kosong') ?></td>
                      </tr>
                      <tr>
                        <th class="text-nowrap" style="width:25%;">Alamat Ibu</th>
                        <td class="text-nowrap" style="width:5%;">:</td>
                        <td><?= (!empty($detail['alamat_ortu_ibu']) ? ucfirst($detail['alamat_ortu_ibu']) : 'Kosong') ?></td>
                      </tr>
                      <tr>
                        <th class="text-nowrap" style="width:25%;">No Telp Ibu</th>
                        <td class="text-nowrap" style="width:5%;">:</td>
                        <td><?= (!empty($detail['no_hp_ortu_ibu']) ? ucwords($detail['no_hp_ortu_ibu']) : 'Kosong') ?></td>
                      </tr>
                    </table>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-6 invoice-col">
                    <h5><strong>Data Sekolah Asal</strong></h5>
                    <table class="table table-responsive table-striped borderless">
                      <tr>
                        <th class="text-nowrap" style="width:25%;">Nama Sekolah</th>
                        <td class="text-nowrap" style="width:5%;">:</td>
                        <td><?= (!empty($detail['nama_sekolah_asal']) ? ucwords($detail['nama_sekolah_asal']) : 'Kosong') ?></td>
                      </tr>
                      <tr>
                        <th class="text-nowrap" style="width:25%;">Alamat Sekolah</th>
                        <td class="text-nowrap" style="width:5%;">:</td>
                        <td><?= (!empty($detail['alamat_sekolah_asal']) ? ucfirst($detail['alamat_sekolah_asal']) : 'Kosong') ?></td>
                      </tr>
                      <tr>
                        <th class="text-nowrap" style="width:25%;">No Telp Sekolah</th>
                        <td class="text-nowrap" style="width:5%;">:</td>
                        <td><?= (!empty($detail['no_telp_sekolah_asal']) ? ucwords($detail['no_telp_sekolah_asal']) : 'Kosong') ?></td>
                      </tr>
                      <tr>
                        <th class="text-nowrap" style="width:25%;">Tahun Masuk</th>
                        <td class="text-nowrap" style="width:5%;">:</td>
                        <td><?= (!empty($detail['tahun_masuk_sekolah_asal']) ? ucwords($detail['tahun_masuk_sekolah_asal']) : 'Kosong') ?></td>
                      </tr>
                      <tr>
                        <th class="text-nowrap" style="width:25%;">Tahun Lulus</th>
                        <td class="text-nowrap" style="width:5%;">:</td>
                        <td><?= (!empty($detail['tahun_lulus_sekolah_asal']) ? ucwords($detail['tahun_lulus_sekolah_asal']) : 'Kosong') ?></td>
                      </tr>

                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <?php if (!empty($berkas)) : ?>
                  <hr>
                  <div class="row mt-3">
                    <div class="col-md-12 invoice-col">
                      <h5><strong>Data Berkas</strong></h5>
                      <div class="box-footer">
                        <ul class="mailbox-attachments clearfix">
                          <?php if (!empty($berkas['ijazah_terakhir'])) { ?>
                            <li>
                              <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                              <div class="mailbox-attachment-info">
                                <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['ijazah_terakhir']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> IJAZAH</a>

                              </div>
                            </li>
                          <?php }
                          if (!empty($berkas['skhun'])) { ?>
                            <li>
                              <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                              <div class="mailbox-attachment-info">
                                <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['skhun']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> SKHUN</a>

                              </div>
                            </li>
                          <?php }
                          if (!empty($berkas['kartu_keluarga'])) { ?>
                            <li>
                              <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                              <div class="mailbox-attachment-info">
                                <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['kartu_keluarga']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Kartu Keluarga</a>

                              </div>
                            </li>
                          <?php }
                          if (!empty($berkas['keterangan_sehat'])) { ?>
                            <li>
                              <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                              <div class="mailbox-attachment-info">
                                <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['keterangan_sehat']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> SK SEHAT</a>

                              </div>
                            </li>
                          <?php }
                          if (!empty($berkas['pas_foto'])) { ?>
                            <li>
                              <span class="mailbox-attachment-icon has-img"><img class="img-file" src="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['pas_foto']) ?>" alt="Attachment"></span>

                              <div class="mailbox-attachment-info">
                                <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['pas_foto']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-camera"></i> FOTO</a>

                              </div>
                            </li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('templates/cdn_admin'); ?>