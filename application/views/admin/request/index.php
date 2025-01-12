<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Request</h4>
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
                                <h4 class="card-title">Request Project</h4>

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="myTables" class="table table-sm table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Telpon</th>
                                            <th scope="col">Service</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Tanggal</th>
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

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="mb-4">Info Kontak</h6>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td style="width: 50px;">Nama</td>
                                                <td style="width: 50px;">:</td>
                                                <td id="nama"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50px;">Email</td>
                                                <td style="width: 50px;">:</td>
                                                <td id="emmail"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50px;">Telpon</td>
                                                <td style="width: 50px;">:</td>
                                                <td id="telpon"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50px;">Service</td>
                                                <td style="width: 50px;">:</td>
                                                <td id="service"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="mb-4">Message</h6>
                                    <p id="message"></p>
                                </div>
                            </div>

                        </div>
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
            "url": "<?php echo site_url('admin/request/dataTables') ?>",
            "type": "POST"
        },
        columnDefs: [{
            "targets": [0],
            "orderable": false,
        }, ],

    });

    function lihat(id) {
        $('#modaldata').modal('show');

        $.ajax({
            url: "<?php echo site_url('admin/request/get_data_ById/') ?>" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {

                $('#nama').text(data.nama);
                $('#email').text(data.email);
                $('#telpon').text(data.telpon);
                $('#service').text(data.service);
                $('#message').text(data.message);
                reload_table();
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
                    url: "<?php echo site_url('admin/request/delete_data/') ?>" + id,
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