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
              <li class="breadcrumb-item"><a href="<?= base_url('operator') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('operator/soal-seleksi') ?>">Soal Seleksi</a></li>
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
                <h3 class="card-title"><i class="fa fa-user-plus"></i> Ubah Soal Seleksi</h3>
                <?php if (!empty($soal)) : ?>
                  <a class="btn btn-sm btn-primary float-right lihat-soal" href="javascript:void(0)"><i class="fa fa-eye"></i> <span id="lihat">Lihat</span> Soal Tes Seleksi</a>
                <?php endif; ?>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="nama">Nama Seleksi</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Seleksi" value="<?php echo $seleksi['nama_tes_seleksi']; ?>">
                        <small class="text-danger mt-2"><?= form_error('nama') ?></small>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Bobot untuk lulus</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="text-bold">%</i>
                            </span>
                          </div>
                          <input type="number" name="bobot" class="form-control float-right" placeholder="Prosentase Bobot lulus" value="<?php echo $seleksi['bobot_tes']; ?>">
                        </div>
                        <!-- /.input group -->
                        <small class="text-danger mt-2"><?= form_error('bobot') ?></small>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="des">Deskripsi Seleksi</label>
                    <textarea id="des" name="deskripsi" class="form-control" style="height: 150px;" placeholder="Masukkan Deskripsi"><?php if (!empty($seleksi)) : echo $seleksi['deskripsi_tes_seleksi'];
                                                                                                                                      endif;
                                                                                                                                      ?>
                    </textarea>
                    <small class="text-danger mt-2"><?= form_error('deskripsi') ?></small>
                  </div>
                  <div id="view_soal" style="display: none;">
                    <?php
                    foreach ($soal as $s) :                                                                                       ?>
                      <hr>
                      <div class="soal" id="newlink">
                        <div class="row">
                          <div class="col-md-8">
                            <div class="form-group">
                              <label for="exampleInputFile">Soal Seleksi</label>
                              <input type="text" class="form-control" name="soal[]" placeholder="Soal Seleksi" value="<?= $s['soal_tes_seleksi'] ?>">
                              <input type="hidden" name="id_soal[]" value="<?= $s['id_soal_tes_seleksi'] ?>">
                              <input type="hidden" name="file_image[]" value="<?= $s['file_tes'] ?>">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputFile">Foto Penghargaan</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="foto[]" onchange="loadFile(event)" id="exampleInputFile">
                                  <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="text-bold">A</i>
                                </span>
                              </div>
                              <input type="text" name="jawab_a[]" class="form-control float-right" placeholder="Jawaban A" value="<?= $s['jawaban_a'] ?>">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="text-bold">B</i>
                                </span>
                              </div>
                              <input type="text" name="jawab_b[]" class="form-control float-right" placeholder="Jawaban B" value="<?= $s['jawaban_b'] ?>">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="text-bold">C</i>
                                </span>
                              </div>
                              <input type="text" name="jawab_c[]" class="form-control float-right" placeholder="Jawaban C" value="<?= $s['jawaban_c'] ?>">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="text-bold">D</i>
                                </span>
                              </div>
                              <input type="text" name="jawab_d[]" class="form-control float-right" placeholder="Jawaban D" value="<?= $s['jawaban_d'] ?>">
                            </div>
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-md-12">
                            <div class="form-group">
                              <select class="form-control" name="jawab_benar[]">
                                <option>Pilih Jawaban Benar</option>
                                <option <?php if ($s['jawaban_benar'] == 'a') {
                                            echo "selected";
                                          } ?>>A</option>
                                <option <?php if ($s['jawaban_benar'] == 'b') {
                                            echo "selected";
                                          } ?>>B</option>
                                <option <?php if ($s['jawaban_benar'] == 'c') {
                                            echo "selected";
                                          } ?>>C</option>
                                <option <?php if ($s['jawaban_benar'] == 'd') {
                                            echo "selected";
                                          } ?>>D</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php
                    endforeach;
                    ?>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Perbarui!</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('templates/cdn_admin'); ?>
  <!-- bootstrap datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
    };
  </script>

  <script>
    $(function() {
      //Date picker
      $('#datepicker').datepicker({
        autoclose: true
      })
    })
  </script>

  <script>
    $('.lihat-soal').on('click', function() {
      var ampas = $('#lihat').text();

      if (ampas == 'Lihat') {
        $('#view_soal').show();
        $('#lihat').text('Sembunyikan');
      } else {
        $('#view_soal').hide();

        $('#lihat').text('Lihat');
      }
    })
  </script>

  <script>
    /*
            This script is identical to the above JavaScript function.
            */
    var ct = 1;

    function new_link() {
      ct++;
      var div1 = document.createElement('div');
      div1.id = ct;
      // link to delete extended form elements
      var delLink = '<a class="btn btn-small btn-danger float-right" href="javascript:delIt(' + ct + ')">Del</a>';
      div1.innerHTML = document.getElementById('newlinktpl').innerHTML;
      document.getElementById('newlink').appendChild(div1);
    }
    // function to delete the newly added set of elements
    function delIt(eleId) {
      d = document;
      var ele = d.getElementById(eleId);
      var parentEle = d.getElementById('newlink');
      parentEle.removeChild(ele);
    }
  </script>