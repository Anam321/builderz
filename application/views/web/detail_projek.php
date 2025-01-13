<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(<?= base_url() ?>assets/upload/img/<?= $data_projek['foto'] ?>);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center py-5">
            <h1 class="display-5 text-white mb-0">Service Detail</h1>
            <hr class="bg-white mx-auto" style="width: 90px;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase" itemscope itemtype="https://schema.org/BreadcrumbList">
                    <meta name="numberOfItems" content="3" />
                    <meta name="itemListOrder" content="Ascending" />
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a href="<?= base_url() ?>" itemprop="item"> <span itemprop="name">Home</span></a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <a href="<?= base_url('project/') ?>" itemprop="item"> <span itemprop="name">Project</span></a>
                        <meta itemprop="position" content="2" />
                    </li>
                    <li class="breadcrumb-item text-white active" aria-current="page" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <?= $data_projek['title'] ?></span>
                        <meta itemprop="position" content="3" />
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->





<!-- Project Detail Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Detail Start -->
            <div class="col-lg-8">
                <div id="project-carousel" class="carousel slide mb-5 wow fadeIn" data-bs-ride="carousel" data-wow-delay="0.1s">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="w-100" src="<?= base_url() ?>assets/upload/img/<?= $data_projek['foto'] ?>" alt="<?= $data_projek['title'] ?>">
                        </div>
                        <?php foreach ($projek_foto as $pf): ?>
                            <div class="carousel-item">
                                <img class="w-100" src="<?= base_url() ?>assets/upload/img/<?= $pf->images ?>" alt="Image">
                            </div>
                        <?php endforeach ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#project-carousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#project-carousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <h1 class="mb-4"><?= $data_projek['title'] ?></h1>
                <?= $data_projek['body'] ?>

                <div class="bg-dark overflow-hidden px-4 wow fadeIn mt-3" data-wow-delay="0.1s">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-8 col-sm-12" style="height: 90px;">
                            <div class="h-100 d-flex align-items-center text-center text-md-start">
                                <h5 class="text-white m-0">Hubungi Kami Sekarang</h5>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12" style="height: 90px;">
                            <div class="call-to-action-btn position-relative bg-primary h-100 d-flex align-items-center justify-content-center">
                                <a class="fs-4 text-dark fw-bold" href="tel:+<?= AppIdentitas('tlp') ?>"><i class="fas fa-phone-alt me-2"></i>+<?= AppIdentitas('tlp') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Detail End -->

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Project Info Start -->
                <div class="mb-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="section-header text-start pb-4">
                        <h6 class="h4 fw-bold bg-white px-2 text-uppercase mb-0">Project Detail</h6>
                    </div>
                    <div class="d-flex justify-content-between border-bottom mb-2 pb-2">
                        <span class="text-dark fw-semi-bold">Client:</span>
                        <span><?= $projeck['nama_client'] ?></span>
                    </div>

                    <div class="d-flex justify-content-between border-bottom mb-2 pb-2">
                        <span class="text-dark fw-semi-bold">Location:</span>
                        <span><?= $projeck['alamat'] ?></span>
                    </div>
                    <?php if ($projeck['status'] == 0) {
                        $st = 'Complete';
                    } else {
                        $st = 'Running';
                    } ?>
                    <div class="d-flex justify-content-between border-bottom mb-2 pb-2">
                        <span class="text-dark fw-semi-bold">Status:</span>
                        <span><?= $st ?></span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom mb-2 pb-2">
                        <span class="text-dark fw-semi-bold">Date Completed:</span>
                        <span><?= date_indo($projeck['tgl_akhir']) ?></span>
                    </div>

                    <div class="d-flex justify-content-between mb-2 pb-2">
                        <span class="text-dark fw-semi-bold">Rating:</span>
                        <span><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i></span>
                    </div>
                    <a class="btn btn-primary py-2 w-100" href="tel:+<?= AppIdentitas('tlp') ?>">Hubungi Sekarang</a>
                </div>
                <!-- Project Info End -->

                <!-- Review Start -->
                <div class="mb-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="section-header text-start pb-4">
                        <h6 class="h4 fw-bold bg-white px-2 text-uppercase mb-0">Client Review</h6>
                    </div>
                    <div class="d-flex flex-column p-4 bg-light">
                        <?php if ($foto_client == '-') {
                            $fotos = 'default.png';
                        } else {
                            $fotos = $foto_client;
                        } ?>
                        <img class="mb-3" src="<?= base_url('assets/upload/img/') . $fotos ?>" alt="<?= $nama_client ?>" style="width: 75px; height: 75px;">
                        <h5 class="mb-0"><?= $nama_client ?></h5>
                        <p><?= $alamat_client ?></p>
                        <p class="mb-0"><i class="fa fa-quote-left text-primary me-2"></i><?= $testimoni_client ?></p>
                    </div>
                </div>
                <!-- Review End -->

                <!-- Contact Info Start -->
                <div class="wow fadeIn" data-wow-delay="0.1s">
                    <div class="section-header text-start pb-4">
                        <h6 class="h4 fw-bold bg-white px-2 text-uppercase mb-0">Contact Detail</h6>
                    </div>
                    <div class="bg-dark p-4">
                        <div class="d-flex align-items-center mb-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="bg-primary d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="fas fa-phone-alt text-dark"></i>
                            </div>
                            <div class="ps-3">
                                <p class="text-white mb-1"><a href="tel:<?= AppIdentitas('tlp') ?>">+<?= AppIdentitas('tlp') ?></a></p>

                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="bg-primary d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="flaticon-send-mail text-dark"></i>
                            </div>
                            <div class="ps-3">
                                <p class="text-white mb-1"><a href="mailto:<?= AppIdentitas('email') ?>" class="__cf_email__"><?= AppIdentitas('email') ?></a></p>

                            </div>
                        </div>
                        <div class="d-flex align-items-center wow fadeInUp" data-wow-delay="0.1s">
                            <div class="bg-primary d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                <i class="fas fa-map-marker-alt text-dark"></i>
                            </div>
                            <div class="ps-3">
                                <p class="text-white mb-1"><a href="<?= AppIdentitas('lokasi') ?>"><?= AppIdentitas('alamat') ?></a></p>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Contact Info End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
</div>
<!-- Project Detail End -->