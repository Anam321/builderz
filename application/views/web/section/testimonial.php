<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid testimonial my-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="testimonial-slider-nav">
                    <?php foreach ($testimoni as $testi): ?>
                        <div class="slider-nav"><img src="<?= base_url('assets/upload/img/') . $testi->foto ?>" alt="Testimonial"></div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="testimonial-slider">
                    <?php foreach ($testimoni as $testi): ?>
                        <div class="slider-item">
                            <h5 class="text-primary fw-semi-bold"><?= $testi->name ?></h5>
                            <h6 class="text-white fst-italic mb-4"><?= $testi->alamat ?></h6>
                            <p class="text-white m-0"><?= $testi->testimoni ?></p>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>