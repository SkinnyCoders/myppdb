<div class="row">
    <div class="col-md-12 mt-3">
        <h5 class="text-center mb-3">Daftar FAQ (<i>frequently asked question</i>)</h5>
        <?php 
        $flag = 1;
        foreach ($faq as $data) :?>
        <!-- List of FAQ Section -->
        <div class="media p-2 my-3 mx-1">
            <div class="media-body mx-3">
                <a class="text-decoration-none" data-toggle="collapse" href="#faq<?=$flag?>"
                           role="button" aria-expanded="false" aria-controls="faq1">
                    <h5 class="text-left text-danger"><?=ucwords($data['pertanyaan'])?></h5>
                </a>
                <p class="collapse text-secondary text-justify" id="faq<?=$flag++?>">
                    <?=ucfirst($data['jawaban'])?>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
                <!-- End List of FAQ Section -->
    </div>
</div>