<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login | <?= $app['nama_web'] ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="<?= base_url('assets/upload/img/') . $app['favicon'] ?>" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Stylesheet -->
    <link href="<?= base_url() ?>assets/login/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        button {
            display: block;
            position: relative;
            width: 100%;
            height: 40px;
            /* margin: 40px auto; */
            border-radius: 5px;
            border: none;
            border: 1px solid #cccccc;
            background-color: #001659;
            outline: none;
            color: #FFF;
            font-size: 13px;
            text-transform: uppercase;
            cursor: pointer;
            letter-spacing: 1px;
        }

        button:enabled:hover,
        button.spinning {
            background-color: #d14f27;
        }

        button:disabled {
            cursor: default;
        }


        .fa {
            margin-left: -12px;
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <div class="wrapper login-3">
        <div class="container">
            <div class="col-left">
                <div class="login-text">
                    <h2><img src="<?= base_url('assets/upload/img/') . $app['logo'] ?>" alt="Logo"></h2>
                    <p>
                        <?= $app['alamat'] ?>
                    </p>
                    <a class="btn" href="<?= $app['lokasi'] ?>">Read More</a>
                </div>
            </div>
            <div class="col-right">
                <div class="login-form">
                    <h2>Login</h2>
                    <?php if ($sess == 1) : ?>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                                <use xlink:href="#exclamation-triangle-fill" />
                            </svg>
                            <div>
                                Kamu 3 kali gagal login. Kembai lagi setelah 15 menit.
                            </div>
                        </div>
                    <?php endif ?>

                    <?php
                    if (!$this->session->csrf_token) {
                        $this->session->csrf_token = hash('sha1', time());
                    }
                    ?>
                    <form id="form">
                        <input style="display: none;" name="token" value="<?= $this->session->csrf_token ?>">
                        <p>
                            <input <?php if ($sess == 1) {
                                        echo 'disabled';
                                    } ?> type="text" name="username" value="<?= htmlentities(set_value('name'), ENT_QUOTES) ?>" placeholder="Username" required>
                        </p>
                        <p>
                            <input <?php if ($sess == 1) {
                                        echo 'disabled';
                                    } ?> type="password" name="password" value="<?= htmlentities(set_value('name'), ENT_QUOTES) ?>" placeholder="Password" required>
                        </p>
                        <p>
                            <button <?php if ($sess == 1) {
                                        echo 'disabled';
                                    } ?> id="login" type="submit">
                                Login
                            </button>
                        </p>
                        <!-- <p>
                            <a href="">Forget password?</a>
                            <a href="">Create an account.</a>
                        </p> -->
                    </form>
                </div>
            </div>
        </div>
        <div class="credit">
            Copyright by <a href="<?= $app['site'] ?>"><?= $app['nama_web'] ?></a>
        </div>

    </div>


    <script>
        function showAlert(type, msg) {

            toastr.options.closeButton = true;
            toastr.options.progressBar = true;
            toastr.options.extendedTimeOut = 1000; //1000

            toastr.options.timeOut = 3000;
            toastr.options.fadeOut = 250;
            toastr.options.fadeIn = 250;

            toastr.options.positionClass = 'toast-top-center';
            toastr[type](msg);
        }


        $('#form').submit(function(e) {
            e.preventDefault();
            var form = $('#form')[0];
            var data = new FormData(form);
            $('#login').html("<i class='fa fa-refresh fa-spin'></i>Loading").attr('disabled', true);
            $.ajax({
                url: '<?php echo site_url('auth/login_admin') ?>',
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
                            $('#login').text('Login'); //change button text
                            $('#login').attr('disabled', false); //set button enable

                            Swal.fire({
                                position: "top-midle",
                                icon: "success",
                                title: data.mess,
                                showConfirmButton: false,
                                timer: 2500,

                            }).then((result) => {
                                window.location = '<?php echo base_url('admin/dashboard') ?>';
                            })
                        }, 2000);


                    } else {
                        setTimeout(function() {
                            $('#login').text('Login'); //change button text
                            $('#login').attr('disabled', false); //set button enable

                            Swal.fire({
                                position: "top-midle",
                                icon: "error",
                                title: data.mess,
                                showConfirmButton: true,
                                timer: 3500,

                            }).then((result) => {
                                window.location.reload();
                            })

                        }, 1500);

                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error('Error Code....')
                    $('#login').text('Login'); //change button text
                    $('#login').attr('disabled', false); //set button enable
                }
            });

        });
    </script>


</body>

</html>