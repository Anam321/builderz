<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
?>


<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Profile</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="javascript:void()">Edit Akun</a>
                </li>
            </ul>
        </div>
        <div class="page-category">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card ">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Edit Akun</h4>

                            </div>
                        </div>
                        <div class="card-body">

                            <form id="form">
                                <div class="row">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                    <div class="row mb-3">
                                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="username" class="form-control" id="username" value="<?= $user['username'] ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control" id="password">
                                            <input style="display: none;" type="password" name="old_pass" class="form-control" id="old_pass" value="<?= $user['password'] ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="password2" class="col-sm-2 col-form-label">Repeat Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password2" class="form-control" id="password2">
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
            url: '<?php echo site_url('admin/profile/updateDataAkun/') ?>',
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
</script>