<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Service</h4>
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
                    <a href="javascript:void()">List</a>
                </li>

            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">All Service</h4>
                                <a class="btn btn-primary btn-round ms-auto" href="<?= base_url('app-admin/service/form/') ?>">
                                    <i class="fa fa-plus"></i>
                                    Add Service
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->


                            <div class="table-responsive">
                                <table id="myTables" class="table table-sm table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Images</th>
                                            <th scope="col">Item</th>
                                            <th scope="col">File</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaldata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form_img1">

                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="row mb-3">
                        <div class="input-group mb-3">
                            <input type="hidden" name="id">
                            <input type="file" id="file" name="file"
                                class="form-control">
                            <button type="submit" class="btn btn-primary me-3"
                                id="upload">Upload</button>
                        </div>
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

                <div class="modal-footer">
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cls">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
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

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax
    }

    table = new DataTable('#myTables', {
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            "url": "<?php echo site_url('admin/service/dataTables') ?>",
            "type": "POST"
        },
        columnDefs: [{
            "targets": [0],
            "orderable": false,
        }, ],

    });

    function addfile(id) {
        save_method = 'add';
        $('#form_img1')[0].reset();
        $('#modaldata').modal('show');
        $('.modal-title').text('Tambah Kan File');
        $('[name="id"]').val(id);
    }
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
            url: '<?php echo site_url('admin/service/upload/') ?>',
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
                        $('#modaldata').modal('hide');
                        reload_table();
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

    function deletes(id) {

        Swal.fire({
            title: "Are you sure to delete this Data ?",
            // text: "Data akan dihapus",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#17a2b8",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Delete"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo site_url('admin/service/delete_data/') ?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status == '00') {
                            Swal.fire({
                                position: "top-midle",
                                icon: "success",
                                title: data.mess,
                                showConfirmButton: false,
                                timer: 2000,

                            }).then((result) => {
                                reload_table();

                            })


                        } else {
                            Swal.fire({
                                position: "top-midle",
                                icon: "error",
                                title: data.mess,
                                showConfirmButton: false,
                                timer: 2000,

                            })
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            }
        });
    }
</script>