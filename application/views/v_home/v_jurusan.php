<div class="row">
    <div class="col-md-12">
        <!-- Details School Section -->
        <div class="row mx-1 my-3">
                <!-- Name School Title -->
            <div class="col-md-12 my-3">
                <h6 class="text-danger font-weight-bold my-0">
                    Akreditasi <?= strtoupper($jurusan['akreditasi_program_studi']); ?>
                </h6>
                <h5 class="d-none d-sm-block font-weight-bold text-dark">
                    <?= ucwords($jurusan['nama_program_studi']); ?>
                </h5>
                <h6 class="d-block d-sm-none font-weight-bold text-dark text-center">
                     <?= $jurusan['nama_program_studi']; ?>
                </h6>
            </div>
            <!-- End Name School Title -->

            <div class="col-md-12">
                <img style="width: 100%; height: 300px; background-color: #000; background-size: contain;" src="<?= base_url('assets/img/uploads/6bde84f104f1a7d9e3328da96baffa87.jpg')?>">
                <h6 class="text-danger font-weight-bold my-0 mt-4">
                    Deskripsi
                </h6>
                <p class="text-justify mt-1 text-secondary"><?= ucfirst($jurusan['deskripsi_program_studi'])?></p>  
            </div>

            <div class="col-md-12">
                <!-- Registration Track Section -->
                                <h6 class="text-danger font-weight-bold m-0">Alur Pendaftaran</h6>
                                <table class="small">
                                    <tr class="border-bottom">
                                        <td class="font-weight-bold pt-3" colspan=3>Jalur Prestasi</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Periode Pendaftaran</td>
                                        <td class="px-1 font-weight-bold"> : </td>
                                        <td>12 Juli 2019 - 12 Agustus 2019</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Verfikasi Berkas</td>
                                        <td class="px-1 font-weight-bold"> : </td>
                                        <td>20 Juli 2019 - 15 Agustus 2019</td>
                                    </tr>

                                    <tr class="border-bottom">
                                        <td class="font-weight-bold pt-3" colspan=3>Jalur Reguler</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Periode Pendaftaran</td>
                                        <td class="px-1 font-weight-bold"> : </td>
                                        <td>12 Agustus 2019 - 20 Agustus 2019</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tes Akademik</td>
                                        <td class="px-1 font-weight-bold"> : </td>
                                        <td>21 Agustus 2019</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tes Psikologi</td>
                                        <td class="px-1 font-weight-bold"> : </td>
                                        <td>23 Agustus 2019</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tes Kesehatan</td>
                                        <td class="px-1 font-weight-bold"> : </td>
                                        <td>25 Agustus 2019</td>
                                    </tr>
                                </table>
                                <!-- End Registration Track Section -->
            </div>
        </div>
        <!-- End Detail School Section -->
    </div>
</div>

