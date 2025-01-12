<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Nice Pages</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <!-- <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="javascript:void()">Nice Pages</a>
                </li> -->

            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Meta Pages</h4>

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button onclick="service()" class="nav-link active" id="nav-profile-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Service</button>

                                    <button onclick="project()" class="nav-link" id="nav-profile-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Project</button>

                                    <button onclick="blog()" class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Blog</button>

                                    <button onclick="contact()" class="nav-link" id="nav-profile-tab"
                                        data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">Kontak</button>
                                </div>
                            </nav>
                            <div class=" pt-3">
                                <div class="tab-pane " id="nav-tb" role="tabpanel" aria-labelledby="nav-tb-tab">
                                    <form id="form">

                                        <h6 id="fomtitle" class="mb-4"></h6>

                                        <div class="row mb-3">

                                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" class="form-control" id="title">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="desk" class="col-sm-2 col-form -label">Deskripsi</label>
                                            <div class="col-sm-10">
                                                <textarea name="desk" class="form-control" id="desk"
                                                    style="height:100px;"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="keyword_seo" class="col-sm-2 col-form -label">Keyword</label>
                                            <div class="col-sm-10">
                                                <textarea name="keyword_seo" class="form-control" id="keyword_seo"
                                                    style="height:100px;"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <label for="images" class="col-sm-2 col-form-label">Images</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="images" class="form-control" id="images">
                                                <div id="imagesket" class="form-text"></div>
                                                <input type="hidden" name="old_images" class="form-control">
                                                <input type="hidden" name="pages" class="form-control">
                                            </div>
                                            <div class="col-sm-6">

                                                <div class="card bg-dark text-white" id="viewimages">


                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center ">
                                            <button type="submit" class="btn btn-primary me-3" id="save">Simpan</button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
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
    $(document).ready(function() {
        service();
    });

    function service() {
        iv = 'SERVICE'
        $.ajax({
            url: "<?php echo site_url('admin/pages_Seo/get_data_ById/') ?>" + iv,
            type: "POST",
            dataType: "JSON",
            success: function(data) {

                $('#modaldata').modal('hide');
                $('[name="pages"]').val(data.pages);
                $('[name="title"]').val(data.title_seo);
                $('[name="desk"]').val(data.deskripsi_seo);
                $('[name="keyword_seo"]').val(data.keyword_seo);
                $('[name="old_images"]').val(data.images);
                $('#fomtitle').text(data.pages);
                $('#imagesket').text('images file saat ini ' + data.images + '.');
                $('#viewimages').html('');
                $('#viewimages').append(
                    '<img style="max-height: 500px;" src="<?= base_url() ?>assets/upload/img/' + data
                    .images + '" class="card-img">');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function project() {
        iv = 'PROJECT'
        $.ajax({
            url: "<?php echo site_url('admin/pages_Seo/get_data_ById/') ?>" + iv,
            type: "POST",
            dataType: "JSON",
            success: function(data) {

                $('#modaldata').modal('hide');
                $('[name="pages"]').val(data.pages);
                $('[name="title"]').val(data.title_seo);
                $('[name="desk"]').val(data.deskripsi_seo);
                $('[name="keyword_seo"]').val(data.keyword_seo);
                $('[name="old_images"]').val(data.images);
                $('#fomtitle').text(data.pages);
                $('#imagesket').text('images file saat ini ' + data.images + '.');
                $('#viewimages').html('');
                $('#viewimages').append(
                    '<img style="max-height: 500px;" src="<?= base_url() ?>assets/upload/img/' + data
                    .images + '" class="card-img">');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function blog() {
        iv = 'BLOG'
        $.ajax({
            url: "<?php echo site_url('admin/pages_Seo/get_data_ById/') ?>" + iv,
            type: "POST",
            dataType: "JSON",
            success: function(data) {

                $('#modaldata').modal('hide');
                $('[name="pages"]').val(data.pages);
                $('[name="title"]').val(data.title_seo);
                $('[name="desk"]').val(data.deskripsi_seo);
                $('[name="keyword_seo"]').val(data.keyword_seo);
                $('[name="old_images"]').val(data.images);
                $('#fomtitle').text(data.pages);
                $('#imagesket').text('images file saat ini ' + data.images + '.');
                $('#viewimages').html('');
                $('#viewimages').append(
                    '<img style="max-height: 500px;" src="<?= base_url() ?>assets/upload/img/' + data
                    .images + '" class="card-img">');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function contact() {
        iv = 'KONTAK'
        $.ajax({
            url: "<?php echo site_url('admin/pages_Seo/get_data_ById/') ?>" + iv,
            type: "POST",
            dataType: "JSON",
            success: function(data) {

                $('#modaldata').modal('hide');
                $('[name="pages"]').val(data.pages);
                $('[name="title"]').val(data.title_seo);
                $('[name="desk"]').val(data.deskripsi_seo);
                $('[name="keyword_seo"]').val(data.keyword_seo);
                $('[name="old_images"]').val(data.images);
                $('#fomtitle').text(data.pages);
                $('#imagesket').text('images file saat ini ' + data.images + '.');
                $('#viewimages').html('');
                $('#viewimages').append(
                    '<img style="max-height: 500px;" src="<?= base_url() ?>assets/upload/img/' + data
                    .images + '" class="card-img">');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }


    $('#form').submit(function(e) {
        e.preventDefault();
        var form = $('#form')[0];
        var data = new FormData(form);

        $('#save').html(
            "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading..."
        ).attr('disabled', true);
        $.ajax({
            url: '<?php echo site_url('admin/pages_Seo/updateData') ?>',
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
                        $('#save').text('Post Data'); //change button text
                        $('#save').attr('disabled', false); //set button enable
                        Swal.fire({
                            position: "top-midle",
                            icon: "success",
                            title: data.mess,
                            showConfirmButton: false,
                            timer: 2000,

                        }).then((result) => {

                            if (data.pages == 'SERVICE') {
                                service();
                                return false;
                            }
                            if (data.pages == 'PROJECT') {
                                project();
                                return false;
                            }

                            if (data.pages == 'BLOG') {
                                blog();
                                return false;
                            }

                            if (data.pages == 'KONTAK') {
                                contact();
                                return false;
                            }
                        })

                    }, 2000);
                } else {
                    setTimeout(function() {
                        $('#save').text('Post Data'); //change button text
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
                    $('#save').text('Post Data'); //change button text
                    $('#save').attr('disabled', false); //set button enable
                    toastr.error('Error Code....')
                }, 2000);
            }
        });

    });
</script>