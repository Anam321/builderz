    <?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Project</h4>
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
                        <a href="<?= base_url('admin/project/rab/') ?><?= $projek['id_projek'] ?>">RAB</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void()">Form</a>
                    </li>

                </ul>
            </div>
            <div class="page-category">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Form RAB</h4>
                                    <a class="btn btn-primary btn-round ms-auto"
                                        href="<?= base_url('admin/project/rab/') ?><?= $projek['id_projek'] ?>">
                                        <i class="fa fa-arrow-left"></i>
                                        Back To RAB
                                    </a>

                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                                <form id="form">
                                    <h6 class="mb-4">Form</h6>
                                    <input type="hidden" name="id_uraian" value="<?= $point['id'] ?>">
                                    <div class="row mb-3">
                                        <label for="uraian" class="col-sm-2 col-form-label">Uraian
                                            Kegiatan</label>
                                        <div class="col-sm-10">

                                            <input type="text" name="uraian" class="form-control" id="uraian">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="spesifikasi_bahan" class="col-sm-2 col-form-label">Spesifikasi
                                            Bahan</label>
                                        <div class="col-sm-10">

                                            <input type="text" name="spesifikasi_bahan" class="form-control"
                                                id="spesifikasi_bahan">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="vol" class="col-sm-2 col-form-label">Volume</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="vol" pattern="[0-9]+[.]" class="form-control" id="vol">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                                        <div class="col-sm-10">

                                            <input type="text" name="satuan" class="form-control" id="satuan">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="harga_satuan" class="col-sm-2 col-form-label">Harga
                                            Satuan</label>
                                        <div class="col-sm-10">

                                            <input type="number" name="harga_satuan" class="form-control"
                                                id="harga_satuan">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary me-3" id="save">Post
                                            Data</button>
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
            if ($('[name="vol"]').val() == '0') {
                toastr.error('Volume cannot be empty')
                return false;
            }

            if ($('[name="satuan"]').val() == '0') {
                toastr.error('Satuan cannot be empty')
                return false;
            }


            $('#save').html(
                "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading..."
            ).attr('disabled', true);
            $.ajax({
                url: '<?php echo site_url('admin/project/Post_rab') ?>',
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
                                timer: 1500,

                            }).then((result) => {
                                window.location = '<?php echo base_url('admin/project/rab/') ?><?= $projek['id_projek'] ?>';
                            })

                        }, 2000);
                    } else {
                        setTimeout(function() {
                            $('#save').text('Post Data'); //change button text
                            $('#save').attr('disabled', false); //set button enable
                            toastr.error(data.mess)
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