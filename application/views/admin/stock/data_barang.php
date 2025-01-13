<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
.total {
    background-color: #FFEE58;
    color: #212121;
    padding: 5px;

}
</style>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Stock</h4>
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
                    <a href="javascript:void()">Data Barang</a>
                </li>

            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="align-items-center">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h4 class="card-title">All Data Barang</h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="float-end">
                                            <a onclick="add_keterangan_transaksi_keluar()"
                                                class="btn btn-primary btn-round ms-auto btn-sm m-2"
                                                href="javascript:void()">
                                                <i class="fa fa-plus"></i>
                                                Add Barang
                                            </a>

                                            <button onclick="Print_data_barang()" type="button"
                                                class="btn btn-warning btn-round btn-sm m-2"><i
                                                    class="fa fa-print me-2"></i>Print Data Barang</button>

                                            <button onclick="export_pdf_data_barang()" type="button"
                                                class="btn btn-danger btn-round btn-sm m-2"><i
                                                    class="fa fa-file-pdf me-2"></i>PDF Data Barang</button>
                                            <!-- <button onclick="export_excel_all_nota()" type="button"
                                            class="btn btn-success btn-round btn-sm m-2"><i
                                                class="fa fa-file-excel me-2"></i>Export Nota Transaksi</button> -->
                                        </div>




                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="myTables" class="table table-sm table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Stock</th>
                                            <th scope="col">Satuan</th>
                                            <th scope="col">Note</th>
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
            <form id="form">
                <div class="modal-body">

                    <input type="text" name="id" style="display: none;">
                    <div class="row mb-3">
                        <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_barang" class="form-control" id="nama_barang">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                        <div class="col-sm-10">
                            <input type="number" name="stock" class="form-control" id="stock">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-10">
                            <input type="text" name="satuan" class="form-control" id="satuan">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="note" class="col-sm-2 col-form-label">Note</label>
                        <div class="col-sm-10">
                            <textarea name="note" class="form-control"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary me-3" id="save">Save Data</button>
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
    serverSide: false,
    destroy: true,
    responsive: true,
    order: [],
    ajax: {
        "url": "<?php echo site_url('admin/stock/dataTable') ?>",
        "type": "POST",
    },
    columnDefs: [{
        "targets": [0],
        "orderable": false,
    }, ],

});



function Print_data_barang() {
    window.location = '<?php echo base_url('admin/stock/print_data_barang/') ?>';
}

function export_pdf_data_barang() {
    bulan = $('#tgl').val();
    tahun = $('#year').val();
    window.location = '<?php echo base_url('admin/stock/export_pdf_data_barang/') ?>';
}

// function export_excel_all_nota() {
//     bulan = $('#tgl').val();
//     tahun = $('#year').val();
//     window.location = '<?php echo base_url('admin/transaksi/export_excel_all_nota/') ?>' + bulan + '/' + tahun;
// }


function add_keterangan_transaksi_keluar() {
    save_method = 'add';
    $('#form')[0].reset();
    $('#modaldata').modal('show');
    $('.modal-title').text('Keterangan Transaksi Keluar');
}

$('#form').submit(function(e) {
    e.preventDefault();
    var forms = $('#form')[0];
    var data = new FormData(forms);

    $('#save').text('In Process, Please wait...'); //change button text
    $('#save').attr('disabled', true); //set button disable
    var url;

    if (save_method == 'add') {
        url = "<?php echo site_url('admin/stock/insertDataBarang/') ?>";
    } else {
        url = "<?php echo site_url('admin/stock/updateDataBarang/') ?>";
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


function edit_barang(id) {
    save_method = 'update';
    $('#form')[0].reset();
    $('#modaldata').modal('show');
    $('.modal-title').text('Edit Keterangan Transaksi Keluar');

    $.ajax({
        url: "<?php echo site_url('admin/stock/get_data_ById/') ?>" + id,
        type: "POST",
        dataType: "JSON",

        success: function(data) {
            $('[name="id"]').val(data.id_barang);
            $('[name="nama_barang"]').val(data.nama_barang);
            $('[name="stock"]').val(data.stock);
            $('[name="satuan"]').val(data.satuan);
            $('[name="note"]').val(data.note);


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
                url: "<?php echo site_url('admin/stock/delete_data/') ?>" + id,
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