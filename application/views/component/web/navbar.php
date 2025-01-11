<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
    .floating_btn {
        position: fixed;
        bottom: 100px;
        right: 10px;
        width: 100px;
        height: 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    @keyframes pulsing {
        to {
            box-shadow: 0 0 0 30px rgba(232, 76, 61, 0);
        }
    }

    .contact_icon {
        background-color: #42db87;
        color: #fff;
        width: 50px;
        height: 50px;
        font-size: 30px;
        border-radius: 50px;
        text-align: center;
        box-shadow: 2px 2px 3px #999;
        display: flex;
        align-items: center;
        justify-content: center;
        transform: translatey(0px);
        animation: pulse 1.5s infinite;
        box-shadow: 0 0 0 0 #42db87;
        -webkit-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
        -moz-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
        -ms-animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
        animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1);
        font-weight: normal;
        font-family: sans-serif;
        text-decoration: none !important;
        transition: all 300ms ease-in-out;
    }


    .text_icon {
        margin-top: 8px;
        color: #707070;
        font-size: 13px;
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<div class="floating_btn">
    <a target="_blank" href="<?= base_url('whatsapp/navigasi') ?>" target="_blank">
        <div class="contact_icon">
            <i class="fa fa-whatsapp my-float"></i>
        </div>
    </a>
    <p class="text_icon"><?= whatsappNav('title') ?></p>
</div>
<div class="wrapper">

    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary d-flex align-items-center justify-content-center" style="width: 5rem; height: 5rem;" role="status">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-primary">
        <div class="row align-items-center top-bar">
            <div class="col-lg-4 col-md-12 text-center text-lg-start">
                <a href="#" class="navbar-brand m-0 p-0">
                    <!-- <h1 class="display-4 m-0">Builderz</h1> -->
                    <img class="display-6 me-3" style="height:50px;width:180px;" src="<?= base_url('assets/upload/img/') . AppIdentitas('logo') ?>" alt="Logo">
                </a>
            </div>
            <div class="col-lg-8 col-md-7 d-none d-lg-block">
                <div class="row">
                    <!-- <div class="col-4">
                        <div class="d-flex align-items-center justify-content-end text-dark">
                            <i class="flaticon-calendar fs-1"></i>
                            <div class="ps-3">
                                <p class="mb-0">Opening Hour</p>
                                <small>Mon - Fri, 8:00 - 9:00</small>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-4">
                        <div class="d-flex align-items-center justify-content-end text-dark">
                            <i class="flaticon-call fs-1"></i>
                            <div class="ps-3">
                                <p class="mb-0">Call Us</p>
                                <small>tel:+<?= AppIdentitas('tlp') ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center justify-content-end text-dark">
                            <i class="flaticon-send-mail fs-1"></i>
                            <div class="ps-3">
                                <p class="mb-0">Email Us</p>
                                <small><?= AppIdentitas('email') ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid nav-bar bg-primary">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3 py-lg-0">
            <a href="#" class="navbar-brand d-lg-none">MENU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav me-auto py-0">
                    <a href="<?= htmlentities(base_url(), ENT_QUOTES) ?>" class="nav-link  <?php if ($this->uri->segment(1) == '') {
                                                                                                echo 'active';
                                                                                            } ?>">HOME</a>
                    <a href="<?= htmlentities(base_url('tentang/'), ENT_QUOTES) ?>" class="nav-link  <?php if ($this->uri->segment(1) == 'tentang') {
                                                                                                            echo 'active';
                                                                                                        } ?>">TENTANG</a>
                    <a href="<?= htmlentities(base_url('jasa/'), ENT_QUOTES) ?>" class="nav-link  <?php if ($this->uri->segment(1) == 'jasa') {
                                                                                                        echo 'active';
                                                                                                    } ?>">LAYANAN</a>
                    <a href="<?= htmlentities(base_url('project/'), ENT_QUOTES) ?>" class="nav-link  <?php if ($this->uri->segment(1) == 'project') {
                                                                                                            echo 'active';
                                                                                                        } ?>">PROJECT</a>
                    <a href="<?= htmlentities(base_url('blog/'), ENT_QUOTES) ?>" class="nav-link  <?php if ($this->uri->segment(1) == 'blog') {
                                                                                                        echo 'active';
                                                                                                    } ?>">BLOG</a>
                    <a href="<?= htmlentities(base_url('kontak/'), ENT_QUOTES) ?>" class="nav-link  <?php if ($this->uri->segment(1) == 'kontak') {
                                                                                                        echo 'active';
                                                                                                    } ?>">KONTAK</a>
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Service</a>
                        <div class="dropdown-menu m-0">
                            <a href="service-1.html" class="dropdown-item">Service 1</a>
                            <a href="service-2.html" class="dropdown-item">Service 2</a>
                            <a href="service-detail.html" class="dropdown-item">Service Detail</a>
                        </div>
                    </div> -->

                </div>

                <a href="tel:+<?= AppIdentitas('tlp') ?>" class="btn btn-outline-primary py-2 px-3 mx-2">Hubungi Kami</a>
            </div>
        </nav>


    </div>
    <!-- Navbar End -->

    <!-- 
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
    </div> -->