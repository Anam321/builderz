<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">App Medsos</h4>
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
                                <h4 class="card-title">Media</h4>

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="myTables" class="table table-sm table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Media</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Link</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Slide</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form">
                <div class="modal-body">

                    <form id="form">
                        <input type="hidden" name="id">

                        <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" class="form-control" id="username">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="link" class="col-sm-2 col-form-label">Link</label>
                            <div class="col-sm-10">
                                <input type="text" name="link" class="form-control" id="link">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary me-3" id="save">Simpan</button>
                        </div>

                    </form>

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
    orderable: false,
    targets: [1, 2, 3],
    ajax: {
        "url": "<?php echo site_url('admin/app_medsos/dataTables') ?>",
        "type": "POST"
    },
    columnDefs: [{
        "targets": [0],
        // "orderable": false,
    }, ],

});

function edit(id) {
    $('#modaldata').modal('show');

    $.ajax({
        url: "<?php echo site_url('admin/app_medsos/get_data_ById/') ?>" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="medsos"]').val(data.medsos);
            $('[name="username"]').val(data.username);
            $('[name="link"]').val(data.link);


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
    $.ajax({
        url: '<?php echo site_url('admin/app_medsos/updateData') ?>',
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
</script>