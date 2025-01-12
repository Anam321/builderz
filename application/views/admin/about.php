    <?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Post</h4>
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
                        <a href="<?= base_url('admin/blog/') ?>">About</a>
                    </li>


                </ul>
            </div>
            <div class="page-category">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">About Pages</h4>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <form id="form">
                                            <div class="card">
                                                <div class="card-body">

                                                    <div class=" mb-3">
                                                        <label for="heading_1" class="form-label">Haeding 1</label>
                                                        <input type="text" name="heading_1" class="form-control" id="heading_1" value="<?= $aboutData['heading_1'] ?>">
                                                    </div>
                                                    <div class=" mb-3">
                                                        <label for="heading_2" class="form-label">Heading 2</label>
                                                        <input type="text" name="heading_2" class="form-control" id="heading_2" value="<?= $aboutData['heading_2'] ?>">

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="text" class="form-label">Text</label>
                                                        <textarea name="text" class="form-control"
                                                            id="text"><?= $aboutData['text'] ?></textarea>

                                                    </div>

                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary btn-sm m-2"
                                                            id="save"><i
                                                                class="fa fa-check me-2"></i>Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
                                        <form id="form_img1">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <div class="card text-center">
                                                            <div class="card-body">
                                                                <img class="flex-shrink-0" src="<?= base_url() ?>assets/upload/img/<?= $aboutData['images'] ?>" style="height: 300px;">
                                                                <div class="mt-2 mb-3">
                                                                    <div class="form-group" id="process" style="display:none;">
                                                                        <div class="progress">
                                                                            <div class="progress-bar progress-bar-striped active"
                                                                                role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">

                                                        <div class="input-group mb-3">
                                                            <input type="hidden" name="old_images" value="<?= $aboutData['images'] ?>">
                                                            <input type="file" id="file" name="file"
                                                                class="form-control">
                                                            <button type="submit" class="btn btn-primary me-3"
                                                                id="upload">Upload</button>
                                                        </div>
                                                    </div>

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
            $('#text').summernote({

                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontname', 'fontsize', 'fontsizeunit', 'color',
                        'strikethrough', 'superscript', 'subscript'
                    ]],

                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],

                    ['insert', ['table', 'hr', 'link', 'picture', 'video']],
                    ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']],
                ]
            });

        });
        $('#form_img1').submit(function(e) {
            e.preventDefault();
            var form = $('#form_img1')[0];
            var data = new FormData(form);
            if ($('[name="file"]').val() == '') {
                toastr.error('img cannot be empty')
                return false;
            }
            $('#upload').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>")
                .attr('disabled', true);
            $.ajax({
                url: '<?php echo site_url('admin/about/upload/') ?>',
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

                        setTimeout(function() {
                            $('#form_img1')[0].reset();
                            $('#upload').text('Upload'); //change button text
                            $('#upload').attr('disabled', false); //set button enable
                            window.location.reload();
                        }, 7000);
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

                $('#process').css('display', 'none');
                $('.progress-bar').css('width', '0%');

            }
        }
        $('#form').submit(function(e) {
            e.preventDefault();
            var form = $('#form')[0];
            var data = new FormData(form);

            if ($('[name="category"]').val() == '') {
                toastr.info('Category cannot be empty')
                return false;
            }

            $('#save').html(
                "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading..."
            ).attr('disabled', true);
            $.ajax({
                url: '<?php echo site_url('admin/about/update') ?>',
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




        function fileValidation() {
            var fileInput = document.getElementById('images');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
                fileInput.value = '';
                return false;
            }
        }
    </script>