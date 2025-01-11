<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid py-5">
    <div class="container">
        <div class="section-header text-center pb-5 wow fadeIn" data-wow-delay="0.1s">
            <h6 class="bg-white px-2 fw-semi-bold text-uppercase text-primary">Our Services</h6>
            <h1 class="display-5">Layanan Berkualitas Kami</h1>
        </div>
        <div class="row g-3">
            <?php foreach ($service as $sr): ?>
                <div class="col-lg-3 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                    <div class="service-2">
                        <div class="service-inner position-relative">
                            <img class="img-fluid w-100" src="<?= htmlentities(base_url('assets/upload/post/') . $sr->images, ENT_QUOTES)  ?>" alt="<?= $sr->title ?>">
                            <div class="service-overlay">
                                <a class="display-1 fw-lighter text-white m-0" href="<?= htmlentities(base_url('assets/upload/post/') . $sr->images, ENT_QUOTES)  ?>" data-lightbox="service">+</a>
                            </div>
                        </div>
                        <div class="service-title px-3">
                            <a class="fs-5 fw-bold text-dark" href="<?= htmlentities(base_url('jasa/') . $sr->slug, ENT_QUOTES)  ?>"><?= htmlentities($sr->title)  ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>