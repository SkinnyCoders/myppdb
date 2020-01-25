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
              <li class="breadcrumb-item active">No.Pendaftaran : 20/1/0005</li>
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
                      <img src="<?= base_url('assets/img/user/4ab0b2796e901b9aead1e0a20a6276de.jpg') ?>" class="img-peserta" alt="" class="img-circle">
                    </div>
                    <div class="col-md-8">
                      <h1 class="text-header"><b>Nicole Pearson</b> <i style="font-size:20px; color:<?= $color_badge ?>" class="fas fa-sm fa-check-circle"></i></h1>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> <b>NISN</b>: 34928945</li>
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> <b>Email</b>: johndoe@gmail.com</li>
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-mobile"></i></span> <b>No Telp</b> : + 800 - 12 12 23 52</li>
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> <b>Alamat</b> : jln magelang km 7.5, kab selaman DIY</li>
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-calendar-check"></i></span> <b>Tanggal lahir</b> : 20 January 2020</li>
                        <li class="medium mt-2"><span class="fa-li"><i class="fas fa-lg fa-map"></i></span> <b>Tempat lahir</b> : Jakarta</li>
                      </ul>
                    </div>
                  </div>
                  <!-- info row -->
                  <div class="row mt-5 invoice-info">
                    <div class="col-sm-6 invoice-col">
                      <h5><strong>Data Orang Tua</strong></h5>
                      <table class="table table-responsive table-striped borderless">
                        <tr>
                          <th class="text-nowrap" style="width:25%;">Nama Ayah</th>
                          <td class="text-nowrap" style="width:5%;">:</td>
                          <td>bambang</td>
                        </tr>
                        <tr>
                          <th class="text-nowrap" style="width:25%;">Pekerjaan Ayah</th>
                          <td class="text-nowrap" style="width:5%;">:</td>
                          <td>Karyawan Swasta</td>
                        </tr>
                        <tr>
                          <th class="text-nowrap" style="width:25%;">Alamat Ayah</th>
                          <td class="text-nowrap" style="width:5%;">:</td>
                          <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Suscipit praesentium illum excepturi dolorum blanditiis laboriosam corporis alias sed in nobis ipsa dolore recusandae possimus, ipsum expedita! Consectetur perferendis magni sapiente!</td>
                        </tr>
                        <tr>
                          <th class="text-nowrap" style="width:25%;">No Telp Ayah</th>
                          <td class="text-nowrap" style="width:5%;">:</td>
                          <td>083871467467</td>
                        </tr>
                        <tr>
                          <th class="text-nowrap" style="width:25%;">Nama Ibu</th>
                          <td class="text-nowrap" style="width:5%;">:</td>
                          <td>Siti Kumala sari</td>
                        </tr>
                        <tr>
                          <th class="text-nowrap" style="width:25%;">Pekerjaan Ibu</th>
                          <td class="text-nowrap" style="width:5%;">:</td>
                          <td>Ibu Rumah Tangga</td>
                        </tr>
                        <tr>
                          <th class="text-nowrap" style="width:25%;">Alamat Ibu</th>
                          <td class="text-nowrap" style="width:5%;">:</td>
                          <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dicta qui nesciunt iure aspernatur numquam tempore quasi perferendis eum. Ea tempora suscipit necessitatibus vel! Id distinctio unde odio officiis illum fugit.</td>
                        </tr>
                        <tr>
                          <th class="text-nowrap" style="width:25%;">No Telp Ibu</th>
                          <td class="text-nowrap" style="width:5%;">:</td>
                          <td>08812324562</td>
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
                          <td>bambang</td>
                        </tr>
                        <tr>
                          <th class="text-nowrap" style="width:25%;">Alamat Sekolah</th>
                          <td class="text-nowrap" style="width:5%;">:</td>
                          <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Suscipit praesentium illum excepturi dolorum blanditiis laboriosam corporis alias sed in nobis ipsa dolore recusandae possimus, ipsum expedita! Consectetur perferendis magni sapiente!</td>
                        </tr>
                        <tr>
                          <th class="text-nowrap" style="width:25%;">No Telp Sekolah</th>
                          <td class="text-nowrap" style="width:5%;">:</td>
                          <td>083871467467</td>
                        </tr>
                        <tr>
                          <th class="text-nowrap" style="width:25%;">Tahun Masuk</th>
                          <td class="text-nowrap" style="width:5%;">:</td>
                          <td>Siti Kumala sari</td>
                        </tr>
                        <tr>
                          <th class="text-nowrap" style="width:25%;">Tahun Lulus</th>
                          <td class="text-nowrap" style="width:5%;">:</td>
                          <td>Ibu Rumah Tangga</td>
                        </tr>

                      </table>
                    </div>
                    <!-- /.col -->
                    <!-- <div class="col-md-2 invoice-col">
                      <h5><strong>Data Berkas</strong></h5>

                      <table class="table table-responsive table-striped borderless">
                        <tr>
                          <td>Foto</td>
                          <td><a href="" class="btn btn-sm btn-info">Lihat</a></td>
                        </tr>
                        <tr>
                          <td>Izajah</td>
                          <td><a href="" class="btn btn-sm btn-info">Lihat</a></td>
                        </tr>
                        <tr>
                          <td>SKHUN</td>
                          <td><a href="" class="btn btn-sm btn-info">Lihat</a></td>
                        </tr>
                        <tr>
                          <td>Kartu Keluarga</td>
                          <td><a href="" class="btn btn-sm btn-info">Lihat</a></td>
                        </tr>
                      </table>
                    </div> -->
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <hr>
                  <div class="row mt-3">
                    <div class="col-md-12 invoice-col">
                      <h5><strong>Data Berkas</strong></h5>
                      <div class="box-footer">
                        <ul class="mailbox-attachments clearfix">
                          <li>
                            <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                            <div class="mailbox-attachment-info">
                              <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> IZAJAH</a>
                              <!-- <span class="mailbox-attachment-size">
                                1,245 KB
                                <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                              </span> -->
                            </div>
                          </li>
                          <li>
                            <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                            <div class="mailbox-attachment-info">
                              <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> SKHUN</a>
                              <!-- <span class="mailbox-attachment-size">
                                1,245 KB
                                <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                              </span> -->
                            </div>
                          </li>
                          <li>
                            <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                            <div class="mailbox-attachment-info">
                              <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> KK</a>
                              <!-- <span class="mailbox-attachment-size">
                                1,245 KB
                                <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                              </span> -->
                            </div>
                          </li>
                          <li>
                            <span class="mailbox-attachment-icon"><i style="color:royalblue" class="fa fa-file-word"></i></span>

                            <div class="mailbox-attachment-info">
                              <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Kartu Keluarga</a>
                              <!-- <span class="mailbox-attachment-size">
                                1,245 KB
                                <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                              </span> -->
                            </div>
                          </li>

                          <li>
                            <span class="mailbox-attachment-icon has-img"><img class="img-file" src="<?= base_url('assets/img/uploads/c9262b7a1f6eb23e9981758722827897.jpg') ?>" alt="Attachment"></span>

                            <div class="mailbox-attachment-info">
                              <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo</a>
                              <!-- <span class="mailbox-attachment-size">
                                1.9 MB
                                <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                              </span> -->
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
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