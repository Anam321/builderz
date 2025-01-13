<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">App</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>

            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">App Setting</h4>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <div id="preview">
                                    <center>
                                        <div class="avatar" style="width: 150px; height: 150px; ">
                                            <div class="avatar-title rounded-circle bg-white" id="showlogo">

                                            </div>
                                        </div>
                                    </center>
                                </div>
                                <div class="mt-2">
                                    <div class="form-group" id="process" style="display:none;">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar"
                                                aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form id="upload_form" enctype="multipart/form-data"
                                    action="<?php echo site_url('admin/app/upload_logo/') ?>">
                                    <div class="mt-2">
                                        <div class="input-group mb-3">
                                            <input type="file" name="logo" class="form-control">
                                            <input type="hidden" name="old_logo">
                                            <input type="hidden" name="id" value="1">
                                            <button type="submit" class="btn btn-primary" id="upload">Upload</button>
                                        </div>
                                    </div>
                                    <small>Gunakan Logo dengan Format. JPG, JPEG, PNG</small>
                                </form>
                            </div>
                            <form id="form">
                                <div class="row">
                                    <h6 class="mb-4">Data App</h6>
                                    <input type="hidden" name="id">
                                    <div class="row mb-3">
                                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title" class="form-control" id="title">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="keyword" class="col-sm-2 col-form-label">Keyword</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="keyword" class="form-control" id="keyword">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tentang" class="col-sm-2 col-form-label">Tentang</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="tentang" id="tentang"
                                                height="150"></textarea>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="nama_web" class="col-sm-2 col-form-label">Nama App</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama_web" class="form-control" id="nama_web">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="notlp" class="col-sm-2 col-form-label">Telpon</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="notlp" class="form-control" id="notlp">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="email" class="form-control" id="email">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="kota" class="form-control" id="kota">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="provinsi" class="form-control" id="provinsi">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="pos" class="col-sm-2 col-form-label">Kode Pos</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="pos" class="form-control" id="pos">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="alamat" id="alamat"
                                                height="150"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="lokasi" class="col-sm-2 col-form-label">Google Map</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="lokasi" class="form-control" id="lokasi">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="map" class="col-sm-2 col-form-label">Map Embed</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="map" class="form-control" id="map">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="site" class="col-sm-2 col-form-label">Site</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="site" class="form-control" id="site">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="favicon" class="col-sm-2 col-form-label">Favicon</label>
                                        <div class="col-sm-6">
                                            <div class="input-group mb-3">
                                                <input type="hidden" name="old_favicon">
                                                <input type="file" id="file" name="favicon" class="form-control">
                                                <div class="avatar-title rounded-circle bg-white" id="faviconshow">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-secondary me-3" id="open">Edit App</button>
                                        <button type="button" class="btn btn-secondary me-3" id="close">Batal</button>
                                        <button type="submit" class="btn btn-primary me-3" id="save">Simpan
                                            Perubahaan</button>

                                    </div>
                                </div>
                            </form>
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
    getData();
    getLogo();
    disabled_form();

});
$(document).ready(function() {
    $("#open").click(function() {
        enable_form();
    });

});
$(document).ready(function() {
    $("#close").click(function() {
        disabled_form();
    });

});

function enable_form() {
    $("#save").show();
    $("#close").show();
    $("#open").hide();
    $('[name="nama_web"]').attr('disabled', false);
    $('[name="tentang"]').attr('disabled', false);
    $('[name="notlp"]').attr('disabled', false);
    $('[name="email"]').attr('disabled', false);
    $('[name="lokasi"]').attr('disabled', false);
    $('[name="title"]').attr('disabled', false);
    $('[name="map"]').attr('disabled', false);
    $('[name="alamat"]').attr('disabled', false);
    $('[name="site"]').attr('disabled', false);
    $('[name="keyword"]').attr('disabled', false);
    $('[name="favicon"]').attr('disabled', false);

    $('[name="kota"]').attr('disabled', false);
    $('[name="provinsi"]').attr('disabled', false);
    $('[name="pos"]').attr('disabled', false);
}

function disabled_form() {
    $("#open").show();
    $("#save").hide();
    $("#close").hide();
    $('[name="nama_web"]').attr('disabled', true);
    $('[name="tentang"]').attr('disabled', true);
    $('[name="notlp"]').attr('disabled', true);
    $('[name="email"]').attr('disabled', true);
    $('[name="lokasi"]').attr('disabled', true);
    $('[name="title"]').attr('disabled', true);
    $('[name="map"]').attr('disabled', true);
    $('[name="alamat"]').attr('disabled', true);
    $('[name="site"]').attr('disabled', true);
    $('[name="keyword"]').attr('disabled', true);
    $('[name="favicon"]').attr('disabled', true);


    $('[name="kota"]').attr('disabled', true);
    $('[name="provinsi"]').attr('disabled', true);
    $('[name="pos"]').attr('disabled', true);
}

function getData() {
    var id = 1;
    $.ajax({
        url: "<?php echo site_url('admin/app/get_data_ById/') ?>" + id,
        type: "POST",
        dataType: "JSON",

        success: function(data) {

            $('[name="id"]').val(data.id);
            $('[name="nama_web"]').val(data.nama_web);
            $('[name="tentang"]').val(data.tentang);
            $('[name="notlp"]').val(data.notlp);
            $('[name="email"]').val(data.email);
            $('[name="lokasi"]').val(data.lokasi);
            $('[name="title"]').val(data.title);
            $('[name="map"]').val(data.map);
            $('[name="alamat"]').val(data.alamat);
            $('[name="site"]').val(data.site);
            $('[name="keyword"]').val(data.keyword);
            $('[name="kota"]').val(data.kota);
            $('[name="provinsi"]').val(data.provinsi);
            $('[name="pos"]').val(data.pos);
            $('[name="old_favicon"]').val(data.favicon);
            $('#faviconshow').append(
                '<img width="60" height="60" src="<?= base_url() ?>assets/upload/img/' + data.favicon +
                '" >');

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function getLogo() {
    var id = 1;
    $.ajax({
        url: "<?php echo site_url('admin/app/get_data_ById/') ?>" + id,
        type: "POST",
        dataType: "JSON",

        success: function(data) {
            $('[name="old_logo"]').val(data.logo);
            $('#showlogo').append(
                '<img  width="150" height="150" src="<?= base_url() ?>assets/upload/img/' + data.logo +
                '" class="img-fluid rounded">');
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
    $("#close").attr('disabled', true);
    $.ajax({
        url: '<?php echo site_url('admin/app/updateData/') ?>',
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
                    $('#save').text('Simpan Perubahaan'); //change button text
                    $('#save').attr('disabled', false); //set button enable

                    Swal.fire({
                        position: "top-midle",
                        icon: "success",
                        title: data.mess,
                        showConfirmButton: false,
                        timer: 1500,

                    }).then((result) => {
                        $("#faviconshow").html('');
                        getData();
                        $("#open").show();
                        $("#save").hide();
                        $("#close").hide();
                        disabled_form();
                    })


                }, 2000);
            } else {
                setTimeout(function() {
                    $('#save').text('Simpan Perubahaan'); //change button text
                    $('#save').attr('disabled', false); //set button enable
                    $("#close").attr('disabled', false);
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
                $('#save').text('Simpan Perubahaan'); //change button text
                $('#save').attr('disabled', false); //set button enable
                $("#close").attr('disabled', false);
                toastr.error('Error Code....')
            }, 2000);
        }
    });

});


$('#upload_form').submit(function(e) {
    e.preventDefault();
    var form = $('#upload_form')[0];
    var data = new FormData(form);
    if ($('[name="logo"]').val() == '') {
        toastr.error('Logo cannot be empty')
        return false;
    }
    $('#upload').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>")
        .attr('disabled', true);
    $.ajax({
        url: '<?php echo site_url('admin/app/upload') ?>',
        type: "POST",
        //contentType: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        data: data,
        dataType: "JSON",
        beforeSend: function() {
            $('#upload').attr('disabled', 'disabled');
            $('#process').css('display', 'block');
        },
        success: function(data) {
            if (data.status == '00') {
                var percentage = 0;

                var timer = setInterval(function() {
                    percentage = percentage + 20;
                    progress_bar_process(percentage, timer);
                }, 1000);
            } else {
                setTimeout(function() {
                    $('#process').css('display', 'none');
                    $('.progress-bar').css('width', '0%');
                    $('#upload').text('Upload'); //change button text
                    $('#upload').attr('disabled', false); //set button enable

                    toastr.error(data.mess)
                }, 2000);
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            setTimeout(function() {
                $('#upload').text('Post Data'); //change button text
                $('#upload').attr('disabled', false); //set button enable
                toastr.error('Error Code....')
            }, 2000);
        }
    });

});

function progress_bar_process(percentage, timer) {
    $('.progress-bar').css('width', percentage + '%');
    if (percentage > 100) {
        clearInterval(timer);
        $('#upload_form')[0].reset();
        $('#upload').text('Upload'); //change button text
        $('#upload').attr('disabled', false); //set button enable
        $('#process').css('display', 'none');
        $('.progress-bar').css('width', '0%');
        $('#upload').attr('disabled', false);
        toastr.success('Berhasil di Uploads!.');
        $('#showlogo').html('');
        setTimeout(function() {
            getLogo();
        }, 1000);

    }
}
</script>