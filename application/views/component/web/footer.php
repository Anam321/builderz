<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->db->limit(5);
$query = $this->db->get('s_service')->result();
?>
<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row gy-5">
            <div class="col-md-6 col-lg-4">
                <div class="section-header text-start pb-4">
                    <h6 class="h5 bg-dark px-2 fw-semi-bold text-uppercase text-primary">Office Contact</h6>
                </div>
                <p><i class="fas fa-map-marker-alt me-3"></i><a href="<?= AppIdentitas('lokasi') ?>"><?= AppIdentitas('alamat') ?></a></p>
                <p><i class="fas fa-phone-alt me-3"></i><a href="tel:">+<?= AppIdentitas('tlp') ?></a></p>
                <p><i class="fa fa-envelope me-3"></i><a href="mailto:<?= AppIdentitas('email') ?>" class="__cf_email__"><?= AppIdentitas('email') ?></a></p>
                <div class="d-flex pt-2">

                    <a class="btn btn-social" href="<?= medsos('Facebook') ?>"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-social" href="<?= medsos('Youtube') ?>"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-social" href="<?= medsos('Instagram') ?>"><i class="fab fa-instagram"></i></a>

                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="section-header text-start pb-4">
                    <h6 class="h5 bg-dark px-2 fw-semi-bold text-uppercase text-primary">Services Areas</h6>
                </div>
                <?php foreach ($query as $q): ?>
                    <a class="btn btn-link" href="<?= base_url('jasa/') . $q->slug ?>"><?= $q->title ?></a>
                <?php endforeach ?>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="section-header text-start pb-4">
                    <h6 class="h5 bg-dark px-2 fw-semi-bold text-uppercase text-primary">Useful Pages</h6>
                </div>
                <a class="btn btn-link" href="<?= base_url('tentang/') ?>">About Us</a>
                <a class="btn btn-link" href="<?= base_url('kontak/') ?>">Contact Us</a>
                <a class="btn btn-link" href="<?= base_url('project/') ?>">Projects</a>
            </div>
            <!-- <div class="col-md-6 col-lg-3">
                <div class="section-header text-start pb-4">
                    <h6 class="h5 bg-dark px-2 fw-semi-bold text-uppercase text-primary">Newsletter</h6>
                </div>
                <p>Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulpu</p>
                <form action="#">
                    <div class="input-group">
                        <input type="text" class="form-control border-white p-3" placeholder="Your Email">
                        <button class="btn btn-primary">Sign Up</button>
                    </div>
                </form>
            </div> -->
        </div>
    </div>
    <!-- <div class="container">
        <div class="footer-menu">
            <a href="<?= base_url('terms_of_use/') ?>">Terms of use</a>
            <a href="<?= base_url('privacy_policy/') ?>">Privacy policy</a>
            <a href="<?= base_url('help/') ?>">Help</a>
            <a href="<?= base_url('fqas/') ?>">FQAs</a>
        </div>
    </div> -->
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="m-md-0">&copy; <a href="#"><?= AppIdentitas('nama_web') ?></a>, All Right Reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p class="m-0">Designed By <a href="https://htmlcodex.com/">HTML Codex</a></p>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>

</div>
<script>
    function klikwa() {
        $.ajax({
            url: "<?php echo site_url('contact/klikwa') ?>",
            type: "POST",
        });


    }
</script>
<?php $this->load->view('component/web/jsfile');
