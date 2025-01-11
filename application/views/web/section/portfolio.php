 <div class="container-fluid py-5">
     <div class="container">
         <div class="section-header text-center pb-5 wow fadeIn" data-wow-delay="0.1s">
             <h6 class="bg-white px-2 fw-semi-bold text-uppercase text-primary">Projects</h6>
             <h1 class="display-5 mb-0">Jelajahi Proyek Kami</h1>
         </div>
         <!-- <div class="row mt-n2 wow fadeIn" data-wow-delay="0.1s">
             <div class="col-12 text-center">
                 <ul class="list-inline mb-5" id="portfolio-flters">
                     <li class="btn btn-primary active" data-filter="*">
                         <i class="fa fa-star me-2"></i>All
                     </li>
                     <li class="btn btn-primary" data-filter=".first">
                         <i class="fa fa-check me-2"></i>Complete
                     </li>
                     <li class="btn btn-primary" data-filter=".second">
                         <i class="fa fa-redo me-2"></i>Running
                     </li>
                     <li class="btn btn-primary" data-filter=".third">
                         <i class="fa fa-arrow-right me-2"></i>Upcoming
                     </li>
                 </ul>
             </div>
         </div> -->
         <div class="row g-3 portfolio-container">
             <?php foreach ($projek as $pr): ?>
                 <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item first wow fadeIn" data-wow-delay="0.1s">
                     <div class="portfolio-box">
                         <img src="<?= htmlentities(base_url('assets/upload/img/') . $pr->foto, ENT_QUOTES) ?>" alt="<?= $pr->title ?>">
                         <div class="portfolio-content">
                             <h4 class="fw-semi-bold text-primary"><?= $pr->title ?></h4>
                             <p class="text-white text-uppercase"><?= $pr->category ?></p>
                             <div class="d-flex">
                                 <a class="btn" href="<?= htmlentities(base_url('project/') . $pr->slug, ENT_QUOTES) ?>"><i class="fa fa-link"></i></a>
                                 <a class="btn" href="<?= htmlentities(base_url('assets/upload/img/') . $pr->foto, ENT_QUOTES) ?>" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                             </div>
                         </div>
                     </div>
                 </div>
             <?php endforeach ?>
         </div>
         <?php if ($this->uri->segment(1) == ''): ?>
             <div class="row mt-5">
                 <div class="col-12 text-center wow fadeIn" data-wow-delay="0.1s">
                     <a class="btn btn-primary py-3 px-5" href="<?= htmlentities(base_url('project/'), ENT_QUOTES) ?>">Load More</a>
                 </div>
             </div>
         <?php endif ?>
     </div>
 </div>