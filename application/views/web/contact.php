<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<?php $this->load->view('web/section/breadcrumb') ?>

<div class="container-fluid py-5">
    <div class="container">
        <div class="section-header text-center pb-5 wow fadeIn" data-wow-delay="0.1s">
            <h6 class="bg-white px-2 fw-semi-bold text-uppercase text-primary">Get In Touch</h6>
            <h1 class="display-5">For Any Query</h1>
        </div>
        <div class="row g-5 mb-5">
            <div class="col-lg-4">
                <div class="d-flex wow fadeIn" data-wow-delay="0.1s">
                    <div class="icon-box flex-shrink-0 me-4">
                        <i class="fas fa-phone-alt text-dark"></i>
                    </div>
                    <div>
                        <h5>Call to ask questions</h5>
                        <h4 class="fw-bold text-primary mb-0">+<?= AppIdentitas('tlp') ?>/h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex wow fadeIn" data-wow-delay="0.4s">
                    <div class="icon-box flex-shrink-0 me-4">
                        <i class="fas fa-envelope-open text-dark"></i>
                    </div>
                    <div>
                        <h5>Email to get quote</h5>
                        <h4 class="fw-bold text-primary mb-0"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f29b9c949db2978a939f829e97dc919d9f"><?= AppIdentitas('email') ?></a></h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex wow fadeIn" data-wow-delay="0.8s">
                    <div class="icon-box flex-shrink-0 me-4">
                        <i class="fas fa-map-marker-alt text-dark"></i>
                    </div>
                    <div>
                        <h5>Visit our office</h5>
                        <h4 class="fw-bold text-primary mb-0"><?= AppIdentitas('alamat') ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                <iframe class="position-relative rounded w-100 h-100"
                    src="<?= AppIdentitas('map') ?>"
                    frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div>
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.3s">
                <div class="contact-form bg-primary p-4">
                    <div id="alertMessage"></div>
                    <form id="form">
                        <div class="control-group">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Tuliskan Nama" required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="number" class="form-control" id="nohp" name="nohp" placeholder="Masukan Telpon" required="required" data-validation-required-message="Please enter your telpon" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required="required" data-validation-required-message="Please enter a subject" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" id="message" placeholder="message" name="message" rows="5" required="required" data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-dark w-100 py-3" type="submit" id="save">
                                <span>Send Message</span>
                            </button>
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
        if ($('[name="nohp"]').val() == '') {
            toastr.info('Telpon tidak boleh kosong')
            return false;
        }

        $('#save').html(
            "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading..."
        ).attr('disabled', true);
        $.ajax({
            url: '<?php echo site_url('request/sendMessage') ?>',
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
                            "<i class='fas fa-check fa-2x text-danger'></i> Berhasil Submit"
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