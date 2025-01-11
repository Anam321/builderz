<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid py-5">
    <div class="container">
        <div class="section-header text-center pb-5 wow fadeIn" data-wow-delay="0.1s">
            <h6 class="bg-white px-2 fw-semi-bold text-uppercase text-primary">Features</h6>
            <h1 class="display-5">Why Choose Us</h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="row g-5">
                    <?php foreach ($whychose_r as $why): ?>
                        <div class="col-12 wow fadeIn" data-wow-delay="0.2s">
                            <div class="d-flex">
                                <div class="bg-primary rounded d-flex align-items-center justify-content-center flex-shrink-0 me-4" style="width: 60px; height: 60px;">
                                    <i class="<?= $why->icon ?> fs-4 text-dark"></i>
                                </div>
                                <div>
                                    <h5 class="fw-semi-bold"><?= $why->title ?></h5>
                                    <p class="mb-0"><?= $why->deskripsi ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-lg-4 feature-img wow fadeInUp" data-wow-delay="0.9s">
                <img class="img-fluid" src="<?= base_url() ?>assets/frontend/img/feature.png" style="max-height: 450px;">
            </div>
            <div class="col-lg-4">
                <div class="row g-5">
                    <?php foreach ($whychose_l as $whyl): ?>
                        <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex">
                                <div class="bg-primary rounded d-flex align-items-center justify-content-center flex-shrink-0 me-4" style="width: 60px; height: 60px;">
                                    <i class="<?= $whyl->icon ?> fs-4 text-dark"></i>
                                </div>
                                <div>
                                    <h5 class="fw-semi-bold"><?= $whyl->title ?></h5>
                                    <p class="mb-0"><?= $whyl->deskripsi ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>