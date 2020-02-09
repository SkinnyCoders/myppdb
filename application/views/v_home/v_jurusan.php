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
                <img style="width: 100%; height: 300px; background-color: #000; background-size: contain;" src="<?= base_url('assets/img/uploads/'.$jurusan['foto_program_studi'])?>">
                <h6 class="text-danger font-weight-bold my-0 mt-4">
                    Deskripsi
                </h6>
                <p class="text-justify mt-1 text-secondary"><?= ucfirst($jurusan['deskripsi_program_studi'])?></p>  
                <hr>
            </div>

            <div class="col-md-12">
                <!-- Registration Track Section -->
                                <h6 class="text-danger font-weight-bold m-0">Alur Pendaftaran</h6>
                                <table class="small">
                                    <?php 
                                    foreach ($jalur as $j) :
                                     ?>
                                    <tr class="border-bottom">
                                        <td class="font-weight-bold pt-3" colspan=3><span style="font-size: 15px;"><?=ucwords($j['nama_jalur_pendaftaran'])?></span></td>
                                    </tr>
                                    <?php 

                                    $this->db->select('*');
                                    $this->db->order_by('tgl_mulai', 'ASC');
                                    $jadwal = $this->db->get_where('jadwal_pendaftaran', ['id_jalur_pendaftaran' => $j['id_jalur_pendaftaran']])->result_array();
                                    if (!empty($jadwal)) {

                                    foreach ($jadwal as $alur) :
                                        $tgl_mulai = DateTime::createFromFormat('Y-m-d', $alur['tgl_mulai'])->format('d F Y');
                                        $tgl_selesai = DateTime::createFromFormat('Y-m-d', $alur['tgl_selesai'])->format('d F Y');
        
                                     ?>
                                    <tr>
                                        <td class="font-weight-bold"><?=ucwords($alur['nama_jadwal'])?></td>
                                        <td class="px-1 font-weight-bold"> : </td>
                                        <td>
                                            <?=$tgl_mulai?> - <?=$tgl_selesai?>
                                            
                                        </td>
                                    </tr>
                                <?php endforeach;
                                    }else{
                                        echo '<tr>
                                                <td colspan="3" class="font-weight-bold">Belum Ada  Informasi</td>
                                            </tr>';
                                    }
                                 ?>

                                    <?php 
                                    endforeach;
                                     ?>
                                </table>
                                <!-- End Registration Track Section -->
            </div>
          <!--   <div class="row mt-3"> -->
                <div class="col-md-12 mt-3">
                        <div class="pr-2">
                            <a href="<?=base_url('registrasi/'.$jurusan['id_program_studi'])?>" class="btn btn-flat btn-danger m-1">Daftar Sekarang</a>   
                        </div>
                </div>
        <!--     </div> -->
        </div>
        <!-- End Detail School Section -->
    </div>
</div>

