<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5 col-md-6 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="<?= htmlentities(base_url('assets/upload/img/') . $about['images'], ENT_QUOTES)  ?>" style="object-fit: cover;" alt="<?= $about['heading_2'] ?>">
                </div>
            </div>
            <div class="col-lg-7 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="section-header text-start pb-4">
                    <h6 class="bg-white px-2 fw-semi-bold text-uppercase text-primary"><?= $about['heading_1'] ?></h6>
                    <h1 class="display-5"><?= $about['heading_2'] ?></h1>
                </div>
                <p><?= $about['text'] ?></p>
                <?php if ($this->uri->segment(1) == ''): ?>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="<?= htmlentities(base_url('about/'), ENT_QUOTES) ?> ">Learn More</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>