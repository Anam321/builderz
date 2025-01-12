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
                        <a href="<?= base_url('admin/blog/') ?>">Kategori</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void()">Edit Kategori</a>
                    </li>

                </ul>
            </div>
            <div class="page-category">
                <form id="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Edit Kategori</h4>
                                        <a class="btn btn-primary btn-round ms-auto"
                                            href="<?= base_url('app-admin/post/kategori/') ?>">
                                            <i class="fa fa-arrow-left"></i>
                                            Back To Kategori
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <input type="text" name="id" value="<?= $filed['id'] ?>" style="display: none;">
                                                    <div class=" mb-3">
                                                        <label for="category" class="form-label">Kategori</label>
                                                        <input type="text" name="category" class="form-control" id="category" value="<?= $filed['category'] ?>">
                                                    </div>
                                                    <div class=" mb-3">
                                                        <label for="slug" class="form-label">Slug</label>
                                                        <input type="text" name="slug" class="form-control" id="slug" value="<?= $filed['slug'] ?>">
                                                        <div id="emailHelp" class="form-text">Contoh: keyword-keterangan-konten</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control"
                                                            id="deskripsi"><?= $filed['deskripsi'] ?></textarea>

                                                    </div>
                                                    <!-- <div class="mb-3">
                                                        <label for="images" class="form-label">Images</label>
                                                        <input type="file" name="images" class="form-control"
                                                            id="images">
                                                    </div> -->
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary btn-sm m-2"
                                                            id="save"><i
                                                                class="fa fa-check me-2"></i>Simpan</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
            $('#conten').summernote({
                height: 754,
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
                url: '<?php echo site_url('admin/post/updateKategori') ?>',
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