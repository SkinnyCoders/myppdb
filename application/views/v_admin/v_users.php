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
              <li class="breadcrumb-item active">Pengguna</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel data pengguna</h3>
                <a class="btn btn-sm btn-primary float-right" href="<?= base_url('admin/pengguna/tambah') ?>"><i class="fa fa-user-plus"></i> Tambah Pengguna</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped">
                  <thead>
                    <tr>
                      <th class="text-nowrap" style="width: 5%">No</th>
                      <th class="text-nowrap">Nama</th>
                      <th class="text-nowrap">Posisi</th>
                      <th class="text-nowrap">Gender</th>
                      <th class="text-nowrap">Tanggal</th>
                      <th style="width: 12%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;

                    foreach ($users as $user) :
                      if ($user['jenis_kelamin'] == 'L') {
                        $gender = 'Laki - Laki';
                      } else {
                        $gender = 'Perempuan';
                      }

                      $tanggal = DateTime::createFromFormat('Y-m-d H:i:s', $user['tgl_registrasi'])->format('d F Y');
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><img class="brand-image img-circle " style="width: 30px; height: 30px;" src="<?= base_url('assets/img/user/' . $user['foto_pengguna']) ?>"> <?= ucwords($user['nama_pengguna']) ?>
                        </td>
                        <td><?= ucwords($user['nama_role']) ?></td>
                        <td><?= $gender ?></td>
                        <td><?= $tanggal ?></td>
                        <td><a href="<?= base_url('admin/pengguna/update/' . $user['id_pengguna']) ?>" class="btn btn-sm btn-primary mr-3"><i class="fa fa-user-edit"></i></a><a href="javascript:void(0)" id="<?= $user['id_pengguna'] ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a></td>
                      </tr>
                    <?php endforeach; ?>
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

  <!-- <script src="<?=base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script> -->
  <!-- <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script> -->
  <script>
    $(function() {
      $("#example1").DataTable({});
      $('#example2').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
    });

    // $(document).ready(function() {
    //   $('#example1').DataTable( {
    //       dom: 'Bfrtip',
    //       buttons: [
    //           'copy', 'csv', 'excel', 'pdf', 'print'
    //       ]
    //   } );
    // } );

    $('.delete').on('click', function(e) {
      e.preventDefault();
      var dataId = this.id;
      Swal.fire({
        title: 'Hapus Data Pengguna',
        text: "Apakah anda yakin ingin menghapus data pengguna ini?",
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
              url: "<?= base_url() ?>admin/pengguna/delete/" + dataId,
              data: {
                'id_pengguna': dataId
              },
              success: function(respone) {
                window.location.href = "<?= base_url('admin/pengguna') ?>";
              },
              error: function(request, error) {
                window.location.href = "<?= base_url('admin/pengguna') ?>";
              },
            });
          } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });
    });
  </script>