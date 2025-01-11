<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="container-fluid mb-5 p-0">
    <div class="row g-0">
        <?php foreach ($features as $ft): ?>
            <div class="col-lg-4 col-md-12 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex align-items-center bg-dark p-5 pe-4" style="height: 250px;">
                    <div class="feature-icon flex-shrink-0">
                        <i class="<?= $ft->icon ?> text-primary"></i>
                    </div>
                    <div class="text-primary pe-2">
                        <h4 class="text-primary mb-3"><?= $ft->title ?></h4>
                        <p class="mb-0"><?= $ft->deskripsi ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>