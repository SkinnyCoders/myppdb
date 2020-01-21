    <!-- Body Section -->
    <div class="container-fluid">
        <?php 
        $flag = 1;
        foreach ($jalur as $lur) : ?>
        <div class="row">
            <div class="col-md-12">
                <!-- Registration Track Collapse -->
                <div class="card my-3">
                    <!-- Card Header - Accordion -->
                    <a href="#collapseJalur<?=$flag?>" class="d-block card-header py-3" data-toggle="collapse" role="button"
                       aria-expanded="true" aria-controls="collapseJalur<?=$flag?>">
                        <!-- <i class="fa fa-bullhorn text-dark"></i> -->
                        <h6 class="m-0 text-dark">Jalur <?php echo $lur['nama_jalur_pendaftaran']?>
                            <?php 
                            $prodi = explode(',', $lur['jurusan']);

                            foreach ($prodi as $jurusan) {

                                $hasil = str_word_count($jurusan);

                                if ($hasil > 1) {
                                    $arr = explode(' ', strtoupper($jurusan));
                                    $singkat = '';

                                    foreach ($arr as $kata) {
                                        $singkat.=substr($kata, 0,1);
                                    }
                                }else{
                                    $singkat = ucwords($jurusan);
                                }
                    
                                     ?>
                                      <span class="badge badge-danger d-none d-sm-inline"><?=ucwords($singkat)?></span>
                                     
                                    <?php } ?>
                            
                        </h6>
                        <h6 class="d-block d-sm-none">
                            
                            <span class="badge badge-danger">TKJ</span>
                           
                        </h6>
                    </a>

                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="collapseJalur<?=$flag++?>">
                    <div class="card-body p-3">
                        <div class="row pb-3">
                            <div class="col-md-12 small">
                                <!-- Registration Track Section -->
                                <h6 class="text-danger">Alur Pendaftaran</h6>
                                <table>
                                    <?php 

                                    $this->db->select('*');
                                    $this->db->order_by('tgl_mulai', 'ASC');
                                    $jadwal = $this->db->get_where('jadwal_pendaftaran', ['id_jalur_pendaftaran' => $lur['id_jalur_pendaftaran']])->result_array();
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
                
                                </table>
                                <!-- End Registration Track Section -->

                                <!-- Detail Registration Section -->
                                
                                <h6 class="mt-3 text-danger">Keterangan</h6>
                                <p class="text-justify"><?php echo ucfirst($lur['keterangan']) ?></p>
                               
                                <!-- End Detail Registration Section -->

                                <!-- Registration's Requirement Section -->
                               
                                <h6 class="mt-3 text-danger">Persyaratan</h6>
                                <ul>
                                    <?php $syarat = json_decode($lur['persyaratan'], true);
                                    foreach ($syarat as $s) {
                                        echo '<li>'.trim($s).'</li>';
                                    }
                                     ?>
                                </ul>
                                

                                <!-- End Registration's Requirement Section -->
                                

                                <!-- Registration Button List -->
                                <h6 class="mt-3 text-danger">Daftar Sekarang</h6>
                                <div class="pr-2">
                                    <?php 
                                    $prodi = explode(',', $lur['jurusan']);
                                    $slug = explode(',', $lur['slug']);

                                    for($i=0; $i< count($prodi); $i++){
                                     ?>
                                        <a href="<?=base_url('?p=jurusan/'.$slug[$i])?>"
                                           class="btn btn-danger m-1">
                                            <?=ucwords($prodi[$i])?>
                                        </a>
                                    <?php } ?>
                                
                                </div>
                                <!-- End Registration Button List -->
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- End Registration Track Collapse -->
               
            </div>
        </div>
    <?php endforeach; ?>
    </div>