<div class="container-fluid page-header mb-5 p-0" style="background-image: url(<?= base_url() ?>assets/upload/post/<?= $post_seo['images'] ?>);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center py-5">
            <h1 class="display-5 text-white mb-0">Blog Detail</h1>
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
                        <a href="<?= base_url('blog/') ?>" itemprop="item"> <span itemprop="name">Blog</span></a>
                        <meta itemprop="position" content="2" />
                    </li>
                    <li class="breadcrumb-item text-white active" aria-current="page" itemprop="itemListElement" itemscope
                        itemtype="https://schema.org/ListItem">
                        <?= $post_seo['title'] ?></span>
                        <meta itemprop="position" content="3" />
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<!-- Blog Detail Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Detail Start -->
            <div class="col-lg-8">
                <!-- Blog Detail Start -->
                <img class="img-fluid w-100 mb-5" src="<?= base_url() ?>assets/upload/post/<?= $post_seo['images'] ?>" alt="<?= $post_seo['title'] ?>">
                <h1 class="mb-4"><?= $post_seo['title'] ?></h1>
                <?= $post_seo['body'] ?>
                <!-- Blog Detail End -->

                <!-- Related Post Start -->
                <div class="mb-5 wow fadeIn mt-5" data-wow-delay="0.1s">
                    <div class="section-header text-start pb-4">
                        <h6 class="h4 fw-bold bg-white px-2 text-uppercase mb-0">Related Post</h6>
                    </div>
                    <div class="owl-carousel related-carousel position-relative">
                        <?php foreach ($r_post as $rp): ?>
                            <div class="d-flex">
                                <img class="img-fluid" src="<?= base_url() ?>assets/upload/post/<?= $rp->images ?>" style="width: 80px; height: 80px; object-fit: cover;" alt="<?= $rp->title ?>">
                                <div class="d-flex flex-column justify-content-center ps-3">
                                    <a href="<?= htmlentities(base_url('blog/') . $rp->slug, ENT_QUOTES) ?>" class="h6 lh-base fw-medium mb-2"><?= $rp->title ?></a>
                                    <small>
                                        <span>In <a class="fst-italic text-muted" href="<?= htmlentities(base_url('kategori/') . kategori($rp->categori, 'slug'), ENT_QUOTES) ?>"><?= kategori($rp->categori, 'kategori') ?></a></span>
                                    </small>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <!-- Related Post End -->
            </div>
            <!-- Detail End -->

            <!-- Sidebar Start -->
            <?php $this->load->view('web/side_bar') ?>
            <!-- Sidebar End -->
        </div>
    </div>
</div>
<!-- Blog Detail End -->