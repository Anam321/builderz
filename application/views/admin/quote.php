<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Quote</h4>
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
                                <h4 class="card-title">Patner List</h4>
                                <a onclick="add()" class="btn btn-primary btn-round ms-auto" href="javascript:void()">
                                    <i class="fa fa-plus"></i>
                                    Add Patner
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
                                            <th scope="col">Name</th>
                                            <th scope="col">Banner</th>
                                            <th scope="col">Action</th>
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
            <form id="form">

                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="title">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="file" class="col-sm-2 col-form-label">Banner</label>
                        <div class="col-sm-10">
                            <input type="file" name="file" class="form-control" id="file">
                            <input type="file" style="display: none;" name="old_file" class="form-control" id="file">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary me-3" id="save">Post Data</button>
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
            "url": "<?php echo site_url('admin/quote/dataTables') ?>",
            "type": "POST"
        },
        columnDefs: [{
            "targets": [0],
            "orderable": false,
        }, ],

    });

    function add() {
        save_method = 'add';
        $('#form')[0].reset();
        $('#modaldata').modal('show');
        $('.modal-title').text('Tambah Kategori');
    }

    $('#form').submit(function(e) {
        e.preventDefault();
        var forms = $('#form')[0];
        var data = new FormData(forms);

        $('#save').text('In Process, Please wait...'); //change button text
        $('#save').attr('disabled', true); //set button disable
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('admin/quote/PostData/') ?>";
        } else {
            url = "<?php echo site_url('admin/quote/updateData/') ?>";
        }
        $.ajax({
            url: url,
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
                    Swal.fire({
                        position: "top-midle",
                        icon: "success",
                        title: data.mess,
                        showConfirmButton: false,
                        timer: 1500,

                    }).then((result) => {
                        $('#form')[0].reset();
                        $('#modaldata').modal('hide');
                        reload_table()
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
                $('#save').text('Save Data'); //change button text
                $('#save').attr('disabled', false); //set button enable
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Error code data !')
                $('#save').text('Save Data'); //change button text
                $('#save').attr('disabled', false); //set button enable
            }
        });

    });


    function edit(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('#modaldata').modal('show');
        $('.modal-title').text('Edit Data');

        $.ajax({
            url: "<?php echo site_url('admin/quote/get_data_ById/') ?>" + id,
            type: "POST",
            dataType: "JSON",

            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="title"]').val(data.title);
                $('[name="old_file"]').val(data.file);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
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
                    url: "<?php echo site_url('admin/quote/delete_data/') ?>" + id,
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