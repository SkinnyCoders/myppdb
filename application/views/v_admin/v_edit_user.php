  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=ucwords($title)?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin')?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/pengguna')?>">Pengguna</a></li>
              <li class="breadcrumb-item active">Ubah</li>
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
                <h3 class="card-title"><i class="fa fa-user-edit"></i> Ubah Pengguna</h3>
              </div>
              <!-- /.card-header -->
              <?php foreach ($user AS $u) : ?>
              <!-- form start -->
              <form action="" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="nama">Nama Pengguna</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Operator" value="<?php echo $u['nama_pengguna']; ?>">
                        <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Sebagai</label>
                       <select name="role" class="form-control">
                        <option value="">Pilih</option>
                         <option value="1" <?php if($u['id_role'] == '1'){ echo 'selected';}?>>Kepala Sekolah</option>
                         <option value="3" <?php if($u['id_role'] == '3'){ echo 'selected';}?>>Operator</option>
                         <option value="2" <?php if($u['id_role'] == '2'){ echo 'selected';}?>>Admin</option>
                       </select>
                       <small class="text-danger mt-2"><?= form_error('role') ?></small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Jenis Kelamin</label>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" value="L" type="radio" id="male" name="gender" <?php if($u['jenis_kelamin'] == 'L'){ echo 'checked';}?>>
                      <label for="male" class="custom-control-label">Laki - Laki</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" value="P" type="radio" id="female" name="gender" <?php if($u['jenis_kelamin'] == 'P'){ echo 'checked';}?>>
                      <label for="female" class="custom-control-label">Perempuan</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alamat email</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Alamat email" value="<?php echo $u['email_pengguna']; ?>">
                    <small class="text-danger mt-2"><?= form_error('email') ?></small>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" disabled>
                        <small class="text-danger mt-2"><?= form_error('password') ?></small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Konfirmasi Password</label>
                        <input type="password" name="password1" class="form-control" id="exampleInputPassword1" placeholder="Password" disabled>
                        <small class="text-danger mt-2"><?= form_error('password1') ?></small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Foto Pengguna</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto" onchange="loadFile(event)" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                      </div>
                    </div>
                  </div>
                  <img class="mt-2 mb-2 img-preview" src="<?=base_url('assets/img/user/'.$u['foto_pengguna'])?>" id="output">
                 <!--  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
              </form>
            <?php endforeach; ?>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('templates/cdn_admin');?>

  <script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
    };
  </script>
  
