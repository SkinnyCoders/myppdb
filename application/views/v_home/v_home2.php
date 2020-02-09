    <!-- Body Section -->
    <div class="row">
        <div class="col-md-12">
            <!-- Important Announcement Section -->
            <div class="row mx-1 my-3 border-left border-right border-light">
                <div class="col-md-12">
                    <!-- Announcement Carousel -->
                    <div id="announcementCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ul class="carousel-indicators">
                            <?php for ($i=0; $i < count($list_pengumuman); $i++): ?>
                                <li data-target="#announcementCarousel" data-slide-to="<?= $i; ?>"
                                    class="<?php if ($i == 0) echo 'active'; ?>"></li>
                            <?php endfor; ?>
                        </ul>

                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            <?php $i = 0; ?>
                            <?php foreach ($list_pengumuman as $pengumuman): ?>
                                <div class="carousel-item text-center <?php if ($i == 0) echo 'active'; ?>">
                                    <img class="img-fluid text-danger" src="<?= base_url('assets/img/logo/logo-name-ppdb.png'); ?>"
                                         alt="Image Carousel">
                                    <div class="carousel-caption">
                                        <p class="d-none d-sm-block"><?= $pengumuman['judul_pengumuman']; ?></p>
                                    </div>
                                </div>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                        </div>

                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#announcementCarousel" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#announcementCarousel" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                    <!-- End Announcement Carousel -->
                </div>
            </div>
            <!-- End Important Announcement Section -->

            <!-- Profile Foundation Section -->
            <div class="row mx-1 my-3">
                <div class="col-md-12 py-2">
                    <h5 class="font-weight-bold text-dark"><?= $yayasan['nama_yayasan']; ?></h5>
                    <hr class="m-0">
                    <p class="text-justify mx-2 text-secondary"><?= $yayasan['profil_yayasan']; ?></p>
                </div>
            </div>
            <!-- End Profile Foundation Section -->

            <!-- List of Schools Section -->
            <div class="row mx-1 my-3 text-center">
                <?php foreach ($list_jenjang as $jenjang): ?>
                <div class="card m-1" style="width:350px">
                    <img class="card-img-top" src="<?= base_url('/uploads/school/'.$jenjang['foto_jenjang_pendidikan']) ?>"
                         alt="Card image">
                    <div class="card-body">
                        <h6 class="card-title font-weight-bold text-danger"><?= $jenjang['nama_jenjang_pendidikan']; ?></h6>
                        <p class="card-text text-justify text-secondary small">
                            <?php
                                $string = strip_tags($jenjang['deskripsi_jenjang_pendidikan']);
                                if (strlen($string) > 300) {
                                    // truncate string
                                    $stringCut = substr($string, 0, 300);
                                    $endPoint = strrpos($stringCut, ' ');
                                    //if the string doesn't contain any space then it will cut without word basis.
                                    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                    $string .= '....';
                                }
                                echo $string;
                            ?>
                        </p>
                        <a href="<?= site_url(); ?>?page=c_yayasan_jenjang_pendidikan/index/<?= $jenjang['id_jenjang_pendidikan']; ?>"
                           class="btn btn-danger">
                            Selengkapnya
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <!-- End List of Schools Section -->

        </div>
    </div>
