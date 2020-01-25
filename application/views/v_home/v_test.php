<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.css')?>">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')?>">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/toastr/toastr.min.css')?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.standalone.min.css">
</head>

<?php
if (!empty($pilih_jurusan['id_program_studi'])) {
	$pilih = $pilih_jurusan['id_program_studi'];
}else{
	$pilih = '';
}


?>

<body class="login-page">
<div class="daftar-box">
  <!-- <div class="login-logo">
    <a href="../../index2.html"><b>Login</b> Admin</a>
  </div> -->
  <!-- /.login-logo -->
  <div class="card mt-5">
    <div class="login-card-body">
      <h5 class="login-box-msg">Silahkan melengkapi formulir dibawah ini untuk mendaftar <hr style="border: 3px solid #dc3545;" class="text-danger"></h5>
      
      <form action="" method="post">
      	<h6 class="text-muted">Informasi Akun</h6>
      	<hr>
      	<div class="form-group">
		    <label>Email Anda</label>
		         <div class="input-group mb-1">
		             <input type="text" name="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>">
		             <div class="input-group-append">
		                 <div class="input-group-text">
		                 <span class="fas fa-envelope"></span>
		                 </div>
		             </div>
		        </div>
		        <small class="text-danger"><?= form_error('email')?></small>
		    </div>
          <div class="row">
          	<div class="col-md-6">
          		<div class="form-group">
		          <label class="label text-nowrap">Password</label>
		            <div class="input-group mb-1">
		            <input type="password" name="password" class="form-control" placeholder="Password">
		            <div class="input-group-append">
		                <div class="input-group-text">
		                <span class="fas fa-lock"></span>
		                </div>
		            </div>
		            </div>
		            <small class="text-danger"><?= form_error('password')?></small>
		        </div>
          	</div>
          	<div class="col-md-6">
          		<div class="form-group">
		          <label class="label text-nowrap">Konfirmasi Password</label>
		            <div class="input-group mb-1">
		            <input type="password" name="password2" class="form-control" placeholder="Ulangi Password">
		            <div class="input-group-append">
		                <div class="input-group-text">
		                <span class="fas fa-lock"></span>
		                </div>
		            </div>
		            </div>
		            <small class="text-danger"><?= form_error('password2')?></small>
		        </div>
          	</div>
          </div>
         

          <h6 class="text-muted mt-3 text-header">Informasi Pendaftaran</h6>
          <hr>

          <div class="row">
          	<div class="col-md-6">
          		<div class="form-group">
		            <label for="jurusan">Program Studi (jurusan) <span class="text-danger">*</span></label>
		            <select class="form-control" name="jurusan" id="jurusan">
		            	<?php foreach ($jurusan as $j) : ?>
		            		<option value="<?=$j['id_program_studi']?>" <?php if($j['id_program_studi'] == $pilih) { echo 'selected'; } ?>><?=$j['nama_program_studi']?></option>
		            	<?php endforeach; ?>
		            </select>
		            <small class="text-danger"><?= form_error('jurusan') ?></small>
		        </div>
          	</div>
          	<div class="col-md-6">
          		<div class="form-group">
		            <label for="jalur">Jalur Pendaftaran <span class="text-danger">*</span></label>
		            <select class="form-control jal" name="jalur" id="jalur">
		            	
		            </select>
		            <small class="text-danger"><?= form_error('jalur') ?></small>
		        </div>
          	</div>
          	
          </div>
          <div class="row">
          	<div class="col-md-8">
          		<div class="form-group">
		            <label>Nama Lengkap <span class="text-danger">*</span></label>
		            <div class="input-group mb-1">
		                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?= set_value('nama') ?>">
		                <div class="input-group-append">
		                    <div class="input-group-text">
		                    <span class="fas fa-user"></span>
		                    </div>
		                </div>
		            </div>
		            <small class="text-danger"><?= form_error('nama') ?></small>
		        </div>
          	</div>
          	<div class="col-md-4">
          		<div class="form-group">
		            <label>NISN <span class="text-danger">*</span></label>
		            <input type="text" name="nisn" class="form-control" placeholder="NISN" value="<?= set_value('nisn') ?>">
		            <small class="text-danger"><?= form_error('nisn') ?></small>
		        </div>
          	</div>
          </div>
          
           <div class="row">
          	<div class="col-md-6">
          		<div class="form-group">
          			<label for="exampleInputPassword1">Tanggal Lahir <span class="text-danger">*</span></label>
		            <div class="input-group mb-1">
		                <input type="text" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" value="<?= set_value('tgl_lahir') ?>" id="datepicker">
		                <div class="input-group-append">
		                    <div class="input-group-text">
		                    <span class="fas fa-calendar"></span>
		                    </div>
		                </div>
		            </div>
		            <small class="text-danger"><?= form_error('tgl_lahir') ?></small>
		        </div>
          	</div>
          	<div class="col-md-6">
          		<div class="form-group">
                                  <label for="exampleInputPassword1">Jenis Kelamin <span class="text-danger">*</span></label>
                                  <div class="row">
                                  	<div class="col-md-6">
                                  		<div class="custom-control custom-radio">
                                    <input class="custom-control-input" value="L" type="radio" id="male" name="gender">
                                    <label for="male" class="custom-control-label">Laki - Laki</label>
                                  </div>
                                  	</div>
                                  	<div class="col-md-6">
                                  		<div class="custom-control custom-radio">
                                    <input class="custom-control-input" value="P" type="radio" id="female" name="gender">
                                    <label for="female" class="custom-control-label">Perempuan</label>
                                  </div>
                                  	</div>
                                  </div>
                                  <small class="text-danger"><?= form_error('gender')?></small>
                                </div>
          	</div>
          </div>
          <div class="form-group">
          	<label for="alamat">Alamat Rumah <span class="text-danger">*</span></label>
            <textarea id="misi" name="alamat" class="form-control" style="height: 150px;" placeholder="Masukkan Alamat Rumah"></textarea>
          	<small class="text-danger"><?= form_error('alamat') ?></small>
          </div>
      
      	 <div class="row">
          <div class="col-9">
            <div class="icheck-danger">
              <input type="checkbox" name="agree" id="remember">
              <label for="remember" class="text-muted text-small">
              	<small class="text-muted">Dengan ini saya menyetujui untuk mengikuti pendaftaran dan segala peraturan yang telah ditetapkan penyelenggara.</small>
                
              </label>
            </div>
            <small class="text-danger"><?= form_error('agree') ?></small>
          </div>
          <!-- /.col -->
          <div class="col-3">
            <button type="submit" class="btn btn-danger btn-block">Mendaftar</button>
          </div>
          <!-- /.col -->
        </div>

      </form>

      <p class="mb-0 mt-3">
        Jika sudah mendaftar silahkan <a href="<?=base_url()?>?p=login" class="text-center">login disini</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/dist/js/adminlte.min.js')?>"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js')?>"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/plugins/toastr/toastr.min.js')?>"></script>

<!-- bootstrap datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script>
    $(function() {
      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      })
    })
  </script>

<script>
$(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 4000
    });
    <?php 
    if($this->session->flashdata('msg_failed')){
    ?>
      Toast.fire({
        type: 'error',
        title: '<?= $this->session->flashdata('msg_failed')?>'
      });
    <?php 
    }elseif($this->session->flashdata('msg_success')){
    ?>
    Toast.fire({
        type: 'success',
        title: '<?= $this->session->flashdata('msg_success')?>'
    });
    <?php
    }
    ?>
});
</script>
<script>
	$(document).ready(function(){
		var prodi = $('#jurusan').val();

		$.ajax({
        type : "POST",
        url : "<?=base_url('c_home/registrasi/getJalur')?>",
        data : {'id_prodi' : prodi},
        async : false,
        dataType : "json",
        success : function(data){
          var html = '';
          var i;

          for(i=0; i<data.length; i++){
          html += '<option value="'+data[i].id_jalur_pendaftaran+'">'+data[i].nama_jalur_pendaftaran+'</option>';
          }
              console.log(html);
              $(".jal").html(html);
          }
      	})
	});

	$('#jurusan').on('change', function(){
		var prodi = $('#jurusan').val();

		$.ajax({
        type : "POST",
        url : "<?=base_url('c_home/registrasi/getJalur')?>",
        data : {'id_prodi' : prodi},
        async : false,
        dataType : "json",
        success : function(data){
          var html = '';
          var i;

          for(i=0; i<data.length; i++){
          html += '<option value="'+data[i].id_jalur_pendaftaran+'">'+data[i].nama_jalur_pendaftaran+'</option>';
          }
              console.log(html);
              $(".jal").html(html);
          }
      	})
	})
</script>

</body>
</html>
