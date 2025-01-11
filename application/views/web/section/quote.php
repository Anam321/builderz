<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="section-header text-start pb-4 wow fadeIn" data-wow-delay="0.1s">
                    <h6 class="bg-white px-2 fw-semi-bold text-uppercase text-primary">Request A Quote</h6>
                    <h1 class="display-5">Kami Terpercaya</h1>
                </div>
                <div class="row g-3">
                    <?php foreach ($vendor as $ven): ?>
                        <div class="col-6 col-md-4 wow fadeIn" data-wow-delay="0.2s">
                            <div class="border p-4">
                                <img class="img-fluid" src="<?= base_url('assets/upload/img/') . $ven->file ?>" alt="<?= $ven->title ?>">
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <div class="bg-dark d-flex align-items-center p-4 mt-3 wow fadeIn" data-wow-delay="0.8s">
                    <div class="bg-primary d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-phone-alt fs-4 text-dark"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="text-light mb-2">Hubungi Kami Sekarang</h5>
                        <a href="tel:+<?= AppIdentitas('tlp') ?>" target=" _blank" rel="noopener noreferrer">
                            <h4 class="text-primary mb-0">+<?= AppIdentitas('tlp') ?></h4>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="bg-dark h-100 d-flex align-items-center p-5 wow fadeIn" data-wow-delay="0.9s">
                    <form id="form">
                        <div class="row g-3">
                            <div class="col-xl-12">
                                <input type="text" class="form-control bg-white border-0" name="nama" placeholder="Your Name" style="height: 50px;">

                            </div>
                            <div class="col-12">
                                <input type="email" class="form-control bg-white border-0" name="email" placeholder="Your Email" style="height: 50px;">
                            </div>
                            <div class="col-12">
                                <input type="number" class="form-control bg-white border-0" name="telpon" placeholder="Your Telpon" style="height: 50px;">
                            </div>
                            <div class="col-12">
                                <select class="form-select bg-white border-0" name="service" style="height: 50px;">
                                    <option value="0" selected>Pilih Layanan</option>
                                    <option value="INTERIOR">INTERIOR</option>
                                    <option value="RENOVASI">RENOVASI</option>
                                    <option value="KANOPI">KANOPI</option>
                                    <option value="TERALIS">TERALIS</option>
                                    <option value="GORDEN">GORDEN</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control bg-white border-0" rows="2" name="message" placeholder="Message"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" id="save" type="submit">Request A Quote</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    $('#form').submit(function(e) {
        e.preventDefault();
        var form = $('#form')[0];
        var data = new FormData(form);

        if ($('[name="nama"]').val() == '') {
            toastr.info('Nama tidak boleh kosong')
            return false;
        }
        if ($('[name="email"]').val() == '') {
            toastr.info('email tidak boleh kosong')
            return false;
        }
        if ($('[name="telpon"]').val() == '') {
            toastr.info('Telpon tidak boleh kosong')
            return false;
        }
        if ($('[name="service"]').val() == '0') {
            toastr.info('Pilih salah satu layanan')
            return false;
        }

        $('#save').html(
            "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading..."
        ).attr('disabled', true);
        $.ajax({
            url: '<?php echo site_url('request/PostData') ?>',
            type: "POST",
            //contentType: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            data: data,
            dataType: "JSON",

            success: function(data) {
                if (data.status == '00') {
                    setTimeout(function() {
                        $('#save').text('Publikasikan'); //change button text
                        $('#form')[0].reset();
                        $('#save').html(
                            "<i class='fa fa-check fa-2x text-dark'></i> Berhasil Submit"
                        ).attr('disabled', true);
                    }, 2000);
                } else {
                    setTimeout(function() {
                        $('#save').text('Publikasikan'); //change button text
                        $('#save').attr('disabled', false); //set button enable
                        Swal.fire({
                            position: "top-midle",
                            icon: "error",
                            title: data.mess,
                            showConfirmButton: false,
                            timer: 2000,

                        })
                    }, 2000);
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                setTimeout(function() {
                    $('#save').text('Publikasikan'); //change button text
                    $('#save').attr('disabled', false); //set button enable
                    toastr.error('Error Code....')
                }, 2000);
            }
        });

    });
</script>