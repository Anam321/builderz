 <!-- Page Header Start -->
 <div class="container-fluid page-header mb-5 p-0" style="background-image: url(<?= base_url('assets/upload/img/') ?>/<?= $breadcrumb['images'] ?>);">
     <div class="container-fluid page-header-inner py-5">
         <div class="container text-center py-5">
             <h1 class="display-5 text-white mb-0"><?= $breadcrumb['title'] ?></h1>
             <hr class="bg-white mx-auto" style="width: 90px;">
             <nav aria-label="breadcrumb">
                 <ol class="breadcrumb justify-content-center text-uppercase" itemscope itemtype="https://schema.org/BreadcrumbList">
                     <meta name="numberOfItems" content="2" />
                     <meta name="itemListOrder" content="Ascending" />
                     <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                         itemtype="https://schema.org/ListItem">
                         <a href="<?= base_url() ?>" itemprop="item"> <span itemprop="name">Home</span></a>
                         <meta itemprop="position" content="1" />
                     </li>
                     <li class="breadcrumb-item text-white active" aria-current="page" itemprop="itemListElement" itemscope
                         itemtype="https://schema.org/ListItem">
                         <?= $breadcrumb['title'] ?></span>
                         <meta itemprop="position" content="2" />
                     </li>
                 </ol>
             </nav>
         </div>
     </div>
 </div>
 <!-- Page Header End -->