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
              <li class="breadcrumb-item"><a href="<?= base_url('operator/soal-seleksi/detail/' . $this->uri->segment(5)) ?>">Detail</a></li>
              <li class="breadcrumb-item active">Tambah Soal</li>
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
                <h3 class="card-title"><i class="fa fa-user-plus"></i> Tambah Soal Seleksi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="soal" id="newlink">
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label for="exampleInputFile">Soal Seleksi</label>
                          <input type="text" class="form-control" name="soal[]" placeholder="Soal Seleksi">
                          <small class="text-danger mt-2"><?= form_error('soal[]') ?></small>
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
                          <input type="text" name="jawab_a[]" class="form-control float-right" placeholder="Jawaban A">
                          <small class="text-danger mt-2"><?= form_error('jawab_a[]') ?></small>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="text-bold">B</i>
                            </span>
                          </div>
                          <input type="text" name="jawab_b[]" class="form-control float-right" placeholder="Jawaban B">
                          <small class="text-danger mt-2"><?= form_error('jawab_b[]') ?></small>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="text-bold">C</i>
                            </span>
                          </div>
                          <input type="text" name="jawab_c[]" class="form-control float-right" placeholder="Jawaban C">
                          <small class="text-danger mt-2"><?= form_error('jawab_c[]') ?></small>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="text-bold">D</i>
                            </span>
                          </div>
                          <input type="text" name="jawab_d[]" class="form-control float-right" placeholder="Jawaban D">
                          <small class="text-danger mt-2"><?= form_error('jawab_d[]') ?></small>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-12">
                        <div class="form-group">
                          <select class="form-control" name="jawab_benar[]">
                            <option value="">Pilih Jawaban Benar</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                          </select>
                          <small class="text-danger mt-2"><?= form_error('jawab_benar[]') ?></small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a href="javascript:new_link()" class="btn btn-sm btn-info">Tambah Soal</a>

                  <div class="soal" id="newlinktpl" style="display: none;">
                    <hr>
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label for="exampleInputFile">Soal Seleksi</label>
                          <input type="text" class="form-control" name="soal[]" placeholder="Soal Seleksi">
                          <small class="text-danger mt-2"><?= form_error('soal[]') ?></small>
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
                          <input type="text" name="jawab_a[]" class="form-control float-right" placeholder="Jawaban A">
                          <small class="text-danger mt-2"><?= form_error('jawab_a[]') ?></small>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="text-bold">B</i>
                            </span>
                          </div>
                          <input type="text" name="jawab_b[]" class="form-control float-right" placeholder="Jawaban B">
                          <small class="text-danger mt-2"><?= form_error('jawab_b[]') ?></small>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="text-bold">C</i>
                            </span>
                          </div>
                          <input type="text" name="jawab_c[]" class="form-control float-right" placeholder="Jawaban C">
                          <small class="text-danger mt-2"><?= form_error('jawab_c[]') ?></small>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="text-bold">D</i>
                            </span>
                          </div>
                          <input type="text" name="jawab_d[]" class="form-control float-right" placeholder="Jawaban D">
                          <small class="text-danger mt-2"><?= form_error('jawab_d[]') ?></small>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-md-12">
                        <div class="form-group">
                          <select class="form-control" name="jawab_benar[]">
                            <option value="">Pilih Jawaban Benar</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                          </select>
                          <small class="text-danger mt-2"><?= form_error('jawab_benar[]') ?></small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- <div class="row">
                    <div class="col-md-12">
                      <img class="mt-2 mb-2" style="width: 100%" src="" id="output">
                    </div>
                  </div> -->

                  <!--  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Tambahkan!</button>
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