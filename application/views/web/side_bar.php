<div class="col-lg-4">


    <!-- Category Start -->
    <div class="mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="section-header text-start pb-4">
            <h6 class="h4 fw-bold bg-white px-2 text-uppercase mb-0">Categories</h6>
        </div>
        <div class="category-list d-flex flex-column border-start border-5 border-primary">
            <?php foreach ($side['kategori_post'] as $kat): ?>
                <?php $countpost = $this->db->get_where('post', ['categori' => $kat->id])->num_rows(); ?>
                <a class="h6 fw-semi-bold bg-light d-flex p-3 mb-1" href="<?= htmlentities(base_url('kategori/') . $kat->slug, ENT_QUOTES) ?>">
                    <span><?= $kat->category ?></span>
                    <span class="badge text-body fw-normal ms-auto">(<?= $countpost ?>)</span>
                </a>
            <?php endforeach ?>
        </div>
    </div>
    <!-- Category End -->

    <!-- Recent Post Start -->
    <div class="mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="section-header text-start pb-4">
            <h6 class="h4 fw-bold bg-white px-2 text-uppercase mb-0">Recent Post</h6>
        </div>
        <?php foreach ($side['side_post'] as $post): ?>
            <div class="d-flex mb-3">
                <img class="img-fluid" src="<?= htmlentities(base_url('assets/upload/post/') . $post->images, ENT_QUOTES) ?>" style="width: 80px; height: 80px; object-fit: cover;" alt="<?= $post->title ?>">
                <div class="d-flex flex-column justify-content-center ps-3">
                    <a href="<?= htmlentities(base_url('blog/') . $post->slug, ENT_QUOTES) ?>" class="h6 lh-base fw-medium mb-2"><?= $post->title ?></a>
                    <small>
                        <span>In <a class="fst-italic text-muted" href="<?= htmlentities(base_url('kategori/') . kategori($post->categori, 'slug'), ENT_QUOTES) ?>"><?= kategori($post->categori, 'kategori') ?></a></span>
                    </small>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <!-- Recent Post End -->

    <!-- Image Start -->
    <div class="mb-5 wow fadeIn" data-wow-delay="0.1s">
        <img src="img/blog-1.jpg" alt="" class="img-fluid">
    </div>
    <!-- Image End -->

</div>