<div class="container-fluid mt-5">
<!-- foreach -->
    <?php foreach ($prodi as $jurusan) :
        $viewBiaya = $this->m_pendaftaran->getBiayaView($jurusan['id_program_studi']);
        ?>


        <?php if (!empty($viewBiaya)) {
            $jalur = $this->m_pendaftaran->getJalurJurusan($jurusan['id_program_studi']);

            ?>
        <div class="row px-3">
            <h4 class="font-weight-bold"><?=ucwords($jurusan['nama_program_studi'])?></h4>
                <?php foreach ($jalur as $j) { ?>
            <div class="col-md-12 py-0 my-3 table-responsive">
                <div class="row mb-3">
                    <?php $biaya = $this->m_pendaftaran->getBiayaViewJalur($j['id_jalur_pendaftaran'], $id_tahun['id_tahun_ajaran'], $jurusan['id_program_studi']);
                    if (!empty($biaya)) {
                        echo '<h5>'.$j['nama_jalur_pendaftaran'].'</h5>'
                    ?>
                    <table class="table table-striped">
                    <thead class="text-danger">
                        <tr>
                            <?php foreach ($biaya as $b) {
                                echo '<td class="text-header text-nowrap">'.$b['jenis_biaya_masuk'].'</td>';
                            } ?>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php 
                        $total = 0;
                        foreach ($biaya as $b) {
                            echo '<td>Rp.'.number_format($b['jumlah_biaya_masuk'], 0, '.', '.').'</td>';
                            $total += $b['jumlah_biaya_masuk'] ;
                            } ?>
                            <td>Rp. <?=number_format($total, 0, '.', '.')?></td>
                        </tr>
                    </tbody>
                </table>
                <?php } ?>
                </div>
            </div>
                <?php } ?>
               <hr>
        </div>
    <?php } ?>
    <?php endforeach; ?>
         <!-- end foraech -->
    </div>