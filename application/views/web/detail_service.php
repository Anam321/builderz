 <!-- Page Header Start -->
 <div class="container-fluid page-header mb-5 p-0" style="background-image: url(<?= base_url() ?>assets/upload/post/<?= $data_service['images'] ?>);">
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
                         <a href="<?= base_url('jasa/') ?>" itemprop="item"> <span itemprop="name">Jasa</span></a>
                         <meta itemprop="position" content="2" />
                     </li>
                     <li class="breadcrumb-item text-white active" aria-current="page" itemprop="itemListElement" itemscope
                         itemtype="https://schema.org/ListItem">
                         <?= $data_service['title'] ?></span>
                         <meta itemprop="position" content="3" />
                     </li>
                 </ol>
             </nav>
         </div>
     </div>
 </div>
 <!-- Page Header End -->


 <!-- Full Screen Search Start -->
 <div class="modal fade" id="searchModal" tabindex="-1">
     <div class="modal-dialog modal-fullscreen">
         <div class="modal-content" style="background: rgba(3, 15, 39, .7);">
             <div class="modal-header border-0">
                 <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body d-flex align-items-center justify-content-center">
                 <div class="input-group" style="max-width: 600px;">
                     <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                     <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- Full Screen Search End -->


 <!-- Service Detail Start -->
 <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
     <div class="container">
         <div class="row g-5">
             <!-- Detail Start -->
             <div class="col-lg-8">
                 <div class="row g-3 mb-5">
                     <div class="col-md-12">
                         <img class="img-fluid" src="<?= base_url() ?>assets/upload/post/<?= $data_service['images'] ?>" alt="<?= $data_service['title'] ?>">
                     </div>

                 </div>
                 <h1 class="mb-4"><?= $data_service['title'] ?></h1>
                 <?= $data_service['body'] ?>

                 <div class="bg-dark overflow-hidden px-4 wow fadeIn" data-wow-delay="0.1s">
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
                 <!-- Category Start -->
                 <div class="mb-5 wow fadeIn" data-wow-delay="0.1s">
                     <div class="section-header text-start pb-4">
                         <h6 class="h4 fw-bold bg-white px-2 text-uppercase mb-0">Our Services</h6>
                     </div>
                     <div class="service-list d-flex flex-column border-start border-5 border-primary">
                         <?php foreach ($service as $ser): ?>
                             <a class="h6 fw-semi-bold bg-light p-3 mb-1" href="<?= base_url('jasa/') . $ser->slug ?>"><?= $ser->title ?></a>
                         <?php endforeach ?>
                     </div>
                 </div>
                 <!-- Category End -->

                 <!-- Download Start -->
                 <div class="mb-5 wow fadeIn" data-wow-delay="0.1s">
                     <div class="section-header text-start pb-4">
                         <h6 class="h4 fw-bold bg-white px-2 text-uppercase mb-0">Download</h6>
                     </div>
                     <div class="d-flex flex-column">
                         <a target="_blank" class="btn btn-primary fw-semi-bold py-3 mb-3" href="<?= base_url('request/download/pdf/') . $data_service['file'] ?>"><i class="fa fa-download me-2"></i>Download Brochure (PDF)</a>

                     </div>
                 </div>
                 <!-- Download End -->

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
 <!-- Service Detail End -->