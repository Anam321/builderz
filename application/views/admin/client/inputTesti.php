<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?= $metaTitle ?></title>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <style>
        .fa {
            margin-left: -12px;
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
            <div class="col-md-6 ">

                <div class="card shadow p-3 mb-5 bg-body rounded">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0"><?= $metaTitle ?></h3>

                    </div>
                    <div class="card-body">
                        <form id="form">
                            <input type="hidden" name="id_projek" value="<?= $projek['id_projek'] ?>">
                            <input type="hidden" name="token" value="<?= $token ?>">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Projek</label>
                                <input type="text" disabled class="form-control" id="exampleInputEmail1" value="<?= $projek['nama_projek'] ?>" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama_client" id="exampleInputEmail1" value="<?= $projek['nama_client'] ?>" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Foto</label>
                                <input type="file" name="foto" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Testimoni / Penilaian</label>
                                <textarea class="form-control" name="testimoni" cols="30" rows="10"></textarea>

                            </div>
                            <button type="submit" class="btn btn-primary" id="kirim">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
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
            $('#kirim').html("<i class='fa fa-refresh fa-spin m-2'></i>Loading...").attr('disabled', true);
            $.ajax({
                url: '<?php echo site_url('admin/client/PostData') ?>',
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
                            $('#kirim').text('Kirim'); //change button text
                            $('#kirim').attr('disabled', false); //set button enable
                            toastr.success(data.mess)
                            $('#form')[0]
                            setTimeout(function() {
                                window.location = '<?php echo base_url() ?>';
                            }, 1500);
                        }, 2000);
                    } else {
                        setTimeout(function() {
                            $('#kirim').text('Kirim'); //change button text
                            $('#kirim').attr('disabled', false); //set button enable
                            toastr.error(data.mess)
                            setTimeout(function() {
                                window.location = '<?php echo base_url() ?>';
                            }, 3000);
                        }, 2000);

                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {

                    setTimeout(function() {
                        $('#kirim').text('Kirim'); //change button text
                        $('#kirim').attr('disabled', false); //set button enable
                        toastr.error('Error Code....')
                    }, 2000);

                }
            });

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>