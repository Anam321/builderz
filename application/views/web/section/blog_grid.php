<!-- Blog Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="section-header text-center pb-5 wow fadeIn" data-wow-delay="0.1s">
            <h6 class="bg-white px-2 fw-semi-bold text-uppercase text-primary">Latest Blog</h6>
            <h1 class="display-5">
                Dari Blog Kami</h1>
        </div>
        <div class="row g-3">
            <?php foreach ($posts as $post): ?>
                <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                    <div class="blog-item bg-light position-relative">
                        <a href="<?= htmlentities(base_url('kategori/') . kategori($post->categori, 'slug'), ENT_QUOTES) ?>" class="position-absolute top-0 start-0 m-4 py-1 px-3 bg-primary text-dark fw-medium" style="z-index: 1;"><?= kategori($post->categori, 'kategori') ?></a>
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="<?= htmlentities(base_url('assets/upload/post/') . $post->images, ENT_QUOTES) ?>" alt="<?= $post->title ?>">
                        </div>
                        <div class="p-4">
                            <div class="d-flex justify-content-between mb-3">
                                <!-- <div class="d-flex align-items-center">
                                    <img class="img-fluid me-2" src="<?= htmlentities(base_url('assets/upload/post/') . $post->images, ENT_QUOTES) ?>" width="30" height="30" alt="<?= $post->title ?>">
                                    <small>John Doe</small>
                                </div> -->
                                <div class="d-flex align-items-center">
                                    <small class="ms-3"><i class="far fa-calendar-alt text-primary me-2"></i><?= date_indo($post->date)  ?></small>
                                </div>
                            </div>
                            <h5 class="fw-semi-bold lh-base mb-3"><?= htmlentities($post->title)  ?></h5>
                            <a class="text-uppercase fw-medium" href="<?= htmlentities(base_url('blog/') . $post->slug, ENT_QUOTES) ?>">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>