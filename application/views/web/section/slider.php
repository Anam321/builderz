<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid p-0">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <!-- <div class="carousel-indicators">
            <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#header-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div> -->
        <div class="carousel-inner">
            <?php foreach ($slide as $sl) : ?>
                <div class="carousel-item <?php if ($sl->main == 1) {
                                                echo 'active';
                                            } ?>">
                    <img class="w-100" src="<?= base_url() ?>assets/upload/img/<?= $sl->gambar ?>" alt="<?= $sl->title ?>">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h3 class="text-white mb-3 animated fadeInRight"><?= $sl->desk ?></h3>
                            <h1 class="display-3 text-white mb-5 animated fadeInLeft"><?= $sl->title ?></h1>
                            <!-- <a href="<?= $sl->link ?>" class="btn btn-primary py-md-3 px-md-5 me-3 animated fadeInUp">Free Quote</a> -->
                            <a href="<?= base_url('contact') ?>" class="btn btn-outline-light py-md-3 px-md-5 animated fadeInUp">Contact Us</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>