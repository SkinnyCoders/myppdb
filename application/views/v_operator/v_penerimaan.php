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
                            <h3 class="card-title"><i class="far fa-dollar"></i> Data Penerimaan Peserta</h3>
                            <a class="btn btn-sm btn-primary float-right ml-3 terima" data-toggle="modal" data-target="#modal-lg" href="javascript:void(0)"><i class="fa fa-plus"></i> Terima Peserta</a>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap" style="width: 5%">No</th>
                                        <th class="text-nowrap" style="width: 12%">No.Pendaftaran</th>
                                        <th class="text-nowrap" style="width: 18%">Nama</th>
                                        <th class="text-nowrap" style="width: 15%">Jalur Pendaftaran</th>
                                        <th class="text-nowrap" style="width: 15%">Program Studi</th>

                                        <th class="text-nowrap" style="width: 15%">Tahun Ajaran</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($daftar as $d) :

                                        $tahun_ajaran = $this->db->get_where('tahun_ajaran', ['id_tahun_ajaran' => $d['id_tahun_ajaran']])->row_array();
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $d['no_pendaftaran'] ?></td>
                                            <td><?= ucwords($d['nama_lengkap']) ?></td>
                                            <td><?= ucwords($d['nama_jalur_pendaftaran']) ?></td>
                                            <td><?= ucwords($d['nama_program_studi']) ?></td>
                                            <td><?= $tahun_ajaran['tahun_mulai'] ?>/<?= $tahun_ajaran['tahun_akhir'] ?></td>

                                            <td><a href="<?= base_url('operator/pendaftar/detail/' . $d['id_peserta']) ?>" target="_blank" id="" class="btn btn-sm btn-primary mr-3 update"><i class="fa fa-eye"></i> Detail</a></td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Penerimaan Peserta tahun ajaran <?= $tahun_ajaran['tahun_mulai'] ?>/<?= $tahun_ajaran['tahun_akhir'] ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- form start -->
                                    <form action="" method="post" role="form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="nama">Jalur Pendaftaran</label>
                                                    <select class="form-control select2bs4" id="jalur" name="jalur" data-placeholder="Pilih Jalur Pendaftaran">
                                                        <option></option>
                                                        <?php
                                                        foreach ($jalur as $j) { ?>
                                                            <option value="<?= $j['id_jalur_pendaftaran'] ?>"><?= ucwords($j['nama_jalur_pendaftaran']) ?></option>
                                                        <?php
                                                        }
                                                        ?>

                                                    </select>
                                                    <small class="text-danger mt-2"><?= form_error('peserta') ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="nama">Program Studi</label>
                                                    <select class="form-control select2bs4" name="jurusan" id="jurusan" data-placeholder="Pilih Program Studi">
                                                        <option></option>
                                                    </select>
                                                    <small class="text-danger mt-2"><?= form_error('peserta') ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="nama">Sisa Kuota</label>
                                                    <input type="text" class="form-control" id="sisa" placeholder="Sisa Kouta" value="0" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <small class="text-muted"><i class="fa fa-exclamation-triangle"></i> Jika peserta diterima melebihi kouta yang ada maka otomatis peserta akan dicadangkan!</small>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive" id="penerimaan" style="display: none">
                                                    <table id="table-penerimaan" class="table table-hover" style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-nowrap" style="width: 5%">Terima</th>
                                                                <th class="text-nowrap" style="width: 10%">No.Pendaftaran</th>
                                                                <th class="text-nowrap" style="width: 25%">Nama Peserta</th>
                                                                <th class="text-nowrap" style="width: 20%">Status Persyaratan</th>
                                                                <!-- <th class="text-nowrap">Nilai Seleksi</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody class="table-peserta">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" name="simpan" class="btn btn-primary">Terima Peserta</button>
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('templates/cdn_admin'); ?>

<script>
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
</script>

<script>
    $(function() {
        $("#example1").DataTable({});
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>

<script>
    $('#jalur').on('change', function() {
        var id_jalur = $('#jalur').val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('/operator/pendaftar/get_jurusan') ?>",
            data: {
                'id_jalur': id_jalur
            },
            dataType: "json",
            success: function(data) {
                var html = '<option></option>';
                var i;

                for (i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].id_program_studi + '">' + data[i].nama_program_studi + '</option>'
                }

                $('#jurusan').html(html);

            }
        });
    });

    $('#jurusan').on('change', function() {
        var id_jalur = $('#jalur').val();
        var id_jurusan = $('#jurusan').val();

        $.ajax({
            type: 'POST',
            url: "<?= base_url('/operator/pendaftar/get_peserta') ?>",
            data: {
                'id_jalur': id_jalur,
                'jurusan': id_jurusan
            },
            dataType: "json",
            success: function(data) {
                var html = '';
                var i;

                if (data !== '') {
                    $('#penerimaan').show();
                } else {
                    $('#penerimaan').hide();
                }

                for (i = 0; i < data.length; i++) {
                    html += '<tr><td><div class="icheck-danger"><input type="checkbox" class="form-control" name="terima[]" id="terima' + i + '" value="' + i + '"><label for="terima' + i + '"></label><input type="hidden" name="id_pendaftaran' + i + '" value="' + data[i].id_pendaftaran + '"></div></td><td>' + data[i].no_pendaftaran + '</td><td>' + data[i].nama + '</td><td><ul><li>Verifikasi Data ' + data[i].status_data + '</li><li>Verifikasi Berkas ' + data[i].status_berkas + '</li><li>Lulus Tes ' + data[i].status_tes + '</li></ul></td></tr>'
                }

                $('.table-peserta').html(html);

            }
        });

        $.ajax({
            type: 'POST',
            url: "<?= base_url('/operator/pendaftar/get_kuota') ?>",
            data: {
                'id_jurusan': id_jurusan
            },
            dataType: "json",
            success: function(data) {

                $('#sisa').val(data);

            }
        });
    })
</script>