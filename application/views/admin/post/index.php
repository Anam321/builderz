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
                    <a href="javascript:void()">Post</a>
                </li>

            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">All Post</h4>
                                <a class="btn btn-primary btn-round ms-auto" href="<?= base_url('app-admin/post/form/') ?>">
                                    <i class="fa fa-plus"></i>
                                    Add Post
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
                                            <th scope="col">Judul</th>
                                            <th scope="col">Tanggal Post</th>
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
            "url": "<?php echo site_url('admin/post/dataTables') ?>",
            "type": "POST"
        },
        columnDefs: [{
            "targets": [0],
            "orderable": false,
        }, ],

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
                    url: "<?php echo site_url('admin/post/delete_data/') ?>" + id,
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

    function switching(id) {

        $.ajax({
            url: "<?php echo site_url('admin/post/switching/') ?>" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == '00') {

                    reload_table();
                } else {

                    reload_table();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error data switch');
            }
        });

    }
</script>