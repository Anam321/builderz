<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $jmlprj = $this->db->get_where('ref_projek', ['status' => 0])->num_rows();
$jmlprjr = $this->db->get_where('ref_projek', ['status' => 1])->num_rows();
$jml_testi = $this->db->get('pages_client')->num_rows();
$visit = $this->db->get_where('visitors', ['date' => date('Y-m-d')])->num_rows(); ?>
<div class="container-fluid px-0 my-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="row g-0">
        <div class="col-lg-6 bg-dark fact-left">
            <div class="row g-0">
                <div class="col-12 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                    <div class="fact-box bg-dark d-flex align-items-center px-5 py-5 py-md-0">
                        <div class="fact-icon flex-shrink-0">
                            <i class="flaticon-worker text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <h2 class="text-primary" data-toggle="counter-up"><?= $visit ?></h2>
                            <h6 class="text-primary text-uppercase fw-semi-bold m-0">Expert Worker</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="fact-box bg-dark d-flex align-items-center px-5 py-5 pt-0 py-md-0">
                        <div class="fact-icon flex-shrink-0">
                            <i class="flaticon-building text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <h2 class="text-primary" data-toggle="counter-up"><?= $jml_testi ?></h2>
                            <h6 class="text-primary text-uppercase fw-semi-bold m-0">Happy Client</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 bg-primary fact-right no-shape">
            <div class="row g-0">
                <div class="col-12 col-md-6 wow fadeIn" data-wow-delay="0.7s">
                    <div class="fact-box bg-primary d-flex align-items-center px-5 py-5 py-md-0">
                        <div class="fact-icon flex-shrink-0">
                            <i class="flaticon-address text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <h2 class="text-dark" data-toggle="counter-up"><?= $jmlprj ?></h2>
                            <h6 class="text-dark text-uppercase fw-semi-bold m-0">Complete Project</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 wow fadeIn" data-wow-delay="0.9s">
                    <div class="fact-box bg-primary d-flex align-items-center px-5 py-5 pt-0 py-md-0">
                        <div class="fact-icon flex-shrink-0">
                            <i class="flaticon-crane text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <h2 class="text-dark" data-toggle="counter-up"><?= $jmlprjr ?></h2>
                            <h6 class="text-dark text-uppercase fw-semi-bold m-0">Running Project</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>