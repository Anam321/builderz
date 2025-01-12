<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Features</h4>
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
                    <a href="javascript:void()">Features</a>
                </li>

            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Why Chose Us</h4>
                                <button onclick="addwyh()" class="btn btn-primary btn-round btn-sm ms-auto">
                                    <i class="fa fa-plus"></i>
                                    Add List
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="myTables" class="table table-sm table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">icon</th>
                                            <th scope="col">Position</th>
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Featur</h4>

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="Tables" class="table table-sm table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">icon</th>
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
                <h5 class="modal-title" id="staticBackdropLabel">Edit Slide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="form">
                    <input type="hidden" name="id">

                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="title">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                        <div class="col-sm-10">
                            <input type="text" name="icon" class="form-control" id="icon">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="position" class="col-sm-2 col-form-label">Position</label>
                        <div class="col-sm-10">
                            <select name="position" class="form-control" id="position">
                                <option value="">Chosee</option>
                                <option value="LEFT">LEFT</option>
                                <option value="RIGHT">RIGHT</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea name="deskripsi" class="form-control" id="deskripsi" style="height:100px;"></textarea>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary me-3" id="save">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="modaldataf" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Slide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="formf">
                    <input type="hidden" name="idf">

                    <div class="row mb-3">
                        <label for="titles" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="titles" class="form-control" id="titles">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="icons" class="col-sm-2 col-form-label">Icon</label>
                        <div class="col-sm-10">
                            <input type="text" name="icons" class="form-control" id="icons">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="deskripsis" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea name="deskripsis" class="form-control" id="deskripsis" style="height:100px;"></textarea>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary me-3" id="saves">Simpan</button>
                    </div>
                </form>
            </div>

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

    function reload_tables() {
        tables.ajax.reload(null, false); //reload datatable ajax
    }


    table = new DataTable('#myTables', {
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            "url": "<?php echo site_url('admin/features/dataTables') ?>",
            "type": "POST"
        },
        columnDefs: [{
            "targets": [0],
            "orderable": false,
        }, ],

    });
    tables = new DataTable('#Tables', {
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            "url": "<?php echo site_url('admin/features/dataTablesFet') ?>",
            "type": "POST"
        },
        columnDefs: [{
            "targets": [0],
            "orderable": false,
        }, ],

    });

    function addwyh(id) {
        save_method = 'add';
        $('#form')[0].reset();
        $('#modaldata').modal('show');
        $('.modal-title').text('Tambah List');
    }

    function editwhy(id) {
        save_method = 'update';
        $('#modaldata').modal('show');
        $('#form')[0].reset();
        $('.modal-title').text('Edit List');
        $.ajax({
            url: "<?php echo site_url('admin/features/get_data_ById/') ?>" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="title"]').val(data.title);
                $('[name="deskripsi"]').val(data.deskripsi);
                $('[name="icon"]').val(data.icon);
                $('[name="position"]').val(data.position);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function editfeat(id) {

        $('#modaldataf').modal('show');
        $('#formf')[0].reset();
        $('.modal-title').text('Edit Features');
        $.ajax({
            url: "<?php echo site_url('admin/features/get_data_ByIdfeat/') ?>" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('[name="idf"]').val(data.id);
                $('[name="titles"]').val(data.title);
                $('[name="deskripsis"]').val(data.deskripsi);
                $('[name="icons"]').val(data.icon);

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
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('admin/features/PostData') ?>";
        } else {
            url = "<?php echo site_url('admin/features/updateData/') ?>";
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
                    setTimeout(function() {
                        $('#save').text('Post Data'); //change button text
                        $('#save').attr('disabled', false); //set button enable
                        Swal.fire({
                            position: "top-midle",
                            icon: "success",
                            title: data.mess,
                            showConfirmButton: false,
                            timer: 2000,

                        }).then((result) => {
                            $('#form')[0].reset();
                            $('#modaldata').modal('hide');
                            reload_table();
                        })

                    }, 2000);
                } else {
                    setTimeout(function() {
                        $('#save').text('Post Data'); //change button text
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
                    $('#save').text('Post Data'); //change button text
                    $('#save').attr('disabled', false); //set button enable
                    toastr.error('Error Code....')
                }, 2000);
            }
        });

    });
    $('#formf').submit(function(e) {
        e.preventDefault();
        var form = $('#formf')[0];
        var data = new FormData(form);

        $('#saves').html(
            "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading..."
        ).attr('disabled', true);

        $.ajax({
            url: "<?php echo site_url('admin/features/updateDataf/') ?>",
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
                        $('#saves').text('Post Data'); //change button text
                        $('#saves').attr('disabled', false); //set button enable
                        Swal.fire({
                            position: "top-midle",
                            icon: "success",
                            title: data.mess,
                            showConfirmButton: false,
                            timer: 2000,

                        }).then((result) => {
                            $('#formf')[0].reset();
                            $('#modaldataf').modal('hide');
                            reload_tables();
                        })

                    }, 2000);
                } else {
                    setTimeout(function() {
                        $('#saves').text('Post Data'); //change button text
                        $('#saves').attr('disabled', false); //set button enable
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
                    $('#saves').text('Post Data'); //change button text
                    $('#saves').attr('disabled', false); //set button enable
                    toastr.error('Error Code....')
                }, 2000);
            }
        });

    });


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
                    url: "<?php echo site_url('admin/features/delete_data/') ?>" + id,
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