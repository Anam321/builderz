<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
?>


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
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit Profile</h4>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <div id="preview">
                                    <center>
                                        <?php if ($user['foto'] == false) {
                                            $f_user = 'userdefault.png';
                                        } else {
                                            $f_user = $user['foto'];
                                        } ?>
                                        <div class="avatar" style="width: 150px; height: 150px; ">
                                            <div class="avatar-title rounded-circle bg-white">
                                                <img width="150" height="150" src="<?= base_url() ?>assets/upload/img/<?= $f_user ?>" class="img-fluid rounded">
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
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <button type="submit" class="btn btn-primary" id="upload">Upload</button>
                                        </div>
                                    </div>
                                    <small>Gunakan Logo dengan Format. JPG, JPEG, PNG</small>
                                </form>
                            </div>
                            <form id="form">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                    <div class="row mb-3">
                                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nama" class="form-control" id="nama" value="<?= $user['nama'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                        <div class="col-sm-10">
                                            <select name="jabatan" class="form-control">
                                                <?php foreach ($jabatan as $j): ?>
                                                    <option <?php if ($user['jabatan'] == $j->slug) {
                                                                echo "selected";
                                                            } ?> value="<?= $j->slug ?>"><?= $j->jabatan ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-10">
                                            <select name="jk" class="form-control">
                                                <option <?php if ($user['jk'] == 'LAKI-LAKI') {
                                                            echo "selected";
                                                        } ?> value="LAKI-LAKI">LAKI-LAKI</option>
                                                <option <?php if ($user['jk'] == 'PEREMPUAN') {
                                                            echo "selected";
                                                        } ?> value="PEREMPUAN">PEREMPUAN</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="notlp" class="col-sm-2 col-form-label">Telpon</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="notlp" class="form-control" id="notlp" value="<?= $user['notlp'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="email" class="form-control" id="email" value="<?= $user['email'] ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="alamat" id="alamat"
                                                height="150"><?= $user['alamat'] ?></textarea>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary me-3" id="save">Update Data</button>

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





    $('#form').submit(function(e) {
        e.preventDefault();
        var form = $('#form')[0];
        var data = new FormData(form);

        $('#save').html(
            "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading..."
        ).attr('disabled', true);
        $.ajax({
            url: '<?php echo site_url('admin/profile/updateData/') ?>',
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
                        $('#save').text('Update Data'); //change button text
                        $('#save').attr('disabled', false); //set button enable

                        Swal.fire({
                            position: "top-midle",
                            icon: "success",
                            title: data.mess,
                            showConfirmButton: false,
                            timer: 1500,

                        }).then((result) => {
                            window.location.reload();
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
            url: '<?php echo site_url('admin/profile/upload') ?>',
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

            setTimeout(function() {
                window.location.reload();
            }, 1500);

        }
    }
</script>