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
                              <a class="btn btn-sm btn-primary float-right ml-3" href="javascript:void(0)"><i class="fa fa-search"></i> Cari Pendaftar</a>
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
                                 <th class="text-nowrap" style="width: 15%">Jalur Pendaftaran</th>
                                 <th class="text-nowrap" style="width: 15%">Program Studi</th>
                                 <th class="text-nowrap" style="width: 10%">Status</th>
                                 <th style="width: 15%">Aksi</th>
                               </tr>
                             </thead>
                             <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>20/1/0001</td>
                                  <td>Rizki Ristano</td>
                                  <td>Reguler</td>
                                  <td>Komputer</td>
                                  <td><label class="btn btn-sm btn-success">Sudah</label></td>
                                  <td><a href="javascript:void(0)" data-toggle="modal" id="" data-target="#modal-lg" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-eye"></i> Lihat Berkas</a></td>
                                </tr>
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