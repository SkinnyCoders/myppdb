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
              <li class="breadcrumb-item"><a href="<?= base_url('peserta') ?>">Dashboard</a></li>

              <li class="breadcrumb-item active">Data Berkas</li>
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
                <h3 class="card-title"><i class="fa fa-file"></i> Data Berkas</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box-footer">

                        <ul class="mailbox-attachments clearfix">
                          <?php if (!empty($berkas['ijazah_terakhir'])) { ?>
                            <li>
                              <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                              <div class="mailbox-attachment-info">
                                <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['ijazah_terakhir']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> IJAZAH</a>
                                <span class="mailbox-attachment-size">
                                  Hapus File
                                  <a href="javascript:void(0)" id="<?= $berkas['id_berkas'] ?>" class="float-right delete text-muted"> <i style="color: maroon" class="fa fa-sm fa-trash"></i> IJAZAH</a>
                                </span>
                              </div>
                            </li>
                          <?php }
                          if (!empty($berkas['skhun'])) { ?>
                            <li>
                              <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                              <div class="mailbox-attachment-info">
                                <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['skhun']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> SKHUN</a>
                                <span class="mailbox-attachment-size">
                                  Hapus File
                                  <a href="javascript:void(0)" id="<?= $berkas['id_berkas'] ?>" class="float-right delete text-muted"> <i style="color: maroon" class="fa fa-sm fa-trash"></i> SKHUN</a>
                                </span>
                              </div>
                            </li>
                          <?php }
                          if (!empty($berkas['kartu_keluarga'])) { ?>
                            <li>
                              <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                              <div class="mailbox-attachment-info">
                                <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['kartu_keluarga']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Kartu Keluarga</a>
                                <span class="mailbox-attachment-size">
                                  Hapus File
                                  <a href="javascript:void(0)" id="<?= $berkas['id_berkas'] ?>" class="float-right delete text-muted"> <i style="color: maroon" class="fa fa-sm fa-trash"></i> KK</a>
                                </span>
                              </div>
                            </li>
                          <?php }
                          if (!empty($berkas['keterangan_sehat'])) { ?>
                            <li>
                              <span class="mailbox-attachment-icon"><i style="color:firebrick" class="fa fa-file-pdf"></i></span>

                              <div class="mailbox-attachment-info">
                                <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['keterangan_sehat']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> SK SEHAT</a>
                                <span class="mailbox-attachment-size">
                                  Hapus File
                                  <a href="javascript:void(0)" id="<?= $berkas['id_berkas'] ?>" class="float-right delete text-muted"> <i style="color: maroon" class="fa fa-sm fa-trash"></i> SK SEHAT</a>
                                </span>
                              </div>
                            </li>
                          <?php }
                          if (!empty($berkas['pas_foto'])) { ?>
                            <li>
                              <span class="mailbox-attachment-icon has-img"><img class="img-file" src="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['pas_foto']) ?>" alt="Attachment"></span>

                              <div class="mailbox-attachment-info">
                                <a href="<?= base_url('assets/uploads/berkas_peserta/' . $berkas['pas_foto']) ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-camera"></i> FOTO</a>
                                <span class="mailbox-attachment-size">
                                  Hapus File
                                  <a href="javascript:void(0)" id="<?= $berkas['id_berkas'] ?>" class="float-right delete text-muted"> <i style="color: maroon" class="fa fa-sm fa-trash"></i> FOTO</a>
                                </span>
                              </div>
                            </li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted"> <span class="text-danger">*</span>Semua berkas yang diunggah harus berformat pdf, untuk foto berformat jpg atau png dan maksimal berukuran 1mb</p>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">File Ijazah</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file[]">
                            <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">File SKHUN</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file[]">
                            <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">File Kartu Keluarga</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file[]">
                            <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputFile">File SK Sehat </label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file[]">
                            <label class="custom-file-label" for="exampleInputFile">Pilih file </label>

                          </div>


                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Foto Terbaru</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file[]" onchange="loadFile(event)" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <img class="mt-2 mb-2" style="width: 50vn; max-height: 300px;" src="" id="output">
                    </div>
                  </div>
                </div>



                <!--  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="uploads" class="btn btn-primary">Tambahkan!</button>
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

  <script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
    };

    $('.delete').on('click', function(e) {
      e.preventDefault();
      var dataId = this.id;
      var ampas = this.text;
      Swal.fire({
        title: 'Hapus Data Berkas' + ampas,
        text: "Apakah anda yakin ingin menghapus data file berkas ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
      }).then(
        function(isConfirm) {
          if (isConfirm.value) {
            $.ajax({
              type: "post",
              url: "<?= base_url() ?>peserta/data_berkas/delete/" + dataId,
              data: {
                'ampas': ampas
              },
              success: function(respone) {
                window.location.href = "<?= base_url('peserta/data_berkas') ?>";
              },
              error: function(request, error) {
                window.location.href = "<?= base_url('peserta/data_berkas') ?>";
              },
            });
          } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });
    });
  </script>