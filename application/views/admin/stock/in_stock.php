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
                    <a href="javascript:void()">In Stock</a>
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
                                        <h4 class="card-title">Stock Masuk</h4>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="float-end">
                                            <a onclick="add_Stock()"
                                                class="btn btn-primary btn-round ms-auto btn-sm m-2"
                                                href="javascript:void()">
                                                <i class="fa fa-plus"></i>
                                                Add Stock
                                            </a>
                                            <button onclick="Print_data_stock()" type="button"
                                                class="btn btn-warning btn-round btn-sm m-2"><i
                                                    class="fa fa-print me-2"></i>Print Stock Masuk</button>
                                            <button onclick="export_pdf_stock_masuk_barang()" type="button"
                                                class="btn btn-danger btn-round btn-sm m-2"><i
                                                    class="fa fa-file-pdf me-2"></i>PDF Stock Masuk</button>
                                            <!-- <button onclick="export_excel_all_nota()" type="button"
                                            class="btn btn-success btn-round btn-sm m-2"><i
                                                class="fa fa-file-excel me-2"></i>Export Nota Transaksi</button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="mb-2">
                                    <select id="year" name="year" class="form-control" style="width: 200px;">
                                        <option value="<?= date('Y') ?>">Filter Tahun</option>
                                        <?php
                                        for ($i = date('Y'); $i >= date('Y') - 32; $i -= 1) {
                                            echo "<option value='$i'> $i </option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div>
                                    <select id="tgl" name="tgl" class="form-control" style="width: 200px;">
                                        <option value="0">All (Bulan)</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktobber</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>

                                <br>
                                <table id="myTables" class="table table-sm table-hover " style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama
                                                Barang</th>
                                            <th scope="col">Stock
                                            </th>
                                            <th scope="col">Satuan
                                            </th>
                                            <th scope="col">Tanggal
                                                Masuk Stock</th>
                                            <th scope="col">Note
                                            </th>
                                            <th style="width: 60px;" scope="col">Aksi</th>
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
                    <input type="text" name="old_stock" style="display: none;">
                    <div class="row mb-3">
                        <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <select name="id_barang" id="id_barang" class="form-control">
                                <option value="0">Pilih Barang</option>
                                <?php foreach ($get_barang as $x): ?>
                                <option value="<?= $x['id_barang'] ?>"><?= $x['nama_barang'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="stock_masuk" class="col-sm-2 col-form-label">Stock</label>
                        <div class="col-sm-10">
                            <input type="number" name="stock_masuk" class="form-control" id="stock_masuk">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tanggal_masuk" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" name="tanggal_masuk" class="form-control" id="tanggal_masuk">
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
$('#tgl').change(function() {
    getData()
});
$('#year').change(function() {
    getData()
});

function getData() {

    new DataTable('#myTables', {
        processing: true,
        serverSide: false,
        destroy: true,
        responsive: true,
        order: [],
        ajax: {
            "url": "<?php echo site_url('admin/stock/dataTableStockIn') ?>",
            "type": "POST",
            "data": {
                bulan: $('#tgl').val(),
                tahun: $('#year').val(),
            }
        },
        columnDefs: [{
            "targets": [0],
            "orderable": false,
        }, ],

    });

}
$(document).ready(function() {
    // datatable
    getData('all');
});




function Print_data_stock() {
    bulan = $('#tgl').val();
    tahun = $('#year').val();
    window.location = '<?php echo base_url('admin/stock/print_stock_masuk/') ?>' + bulan + '/' + tahun;
}

function export_pdf_data_stock() {
    window.location = '<?php echo base_url('admin/stock/export_pdf_data_barang/') ?>';
}

function export_pdf_stock_masuk_barang() {
    bulan = $('#tgl').val();
    tahun = $('#year').val();
    window.location = '<?php echo base_url('admin/stock/export_pdf_stock_masuk_barang/') ?>' + bulan + '/' + tahun;
}
// function export_excel_all_nota() {
//     bulan = $('#tgl').val();
//     tahun = $('#year').val();
//     window.location = '<?php echo base_url('admin/transaksi/export_excel_all_nota/') ?>' + bulan + '/' + tahun;
// }


function add_Stock() {
    save_method = 'add';
    $('#form')[0].reset();
    $('#modaldata').modal('show');
    $('.modal-title').text('Keterangan Stock Masuk');

}

$('#form').submit(function(e) {
    e.preventDefault();
    var forms = $('#form')[0];
    var data = new FormData(forms);
    if ($('[name="id_barang"]').val() == '0') {
        toastr.info('Nama Barang cannot be empty')
        return false;
    }
    if ($('[name="stock_masuk"]').val() == '') {
        toastr.info('Stock Barang cannot be empty')
        return false;
    }
    if ($('[name="tanggal_masuk"]').val() == '') {
        toastr.info('Tanggal Barang cannot be empty')
        return false;
    }
    $('#save').text('In Process, Please wait...'); //change button text
    $('#save').attr('disabled', true); //set button disable
    var url;

    if (save_method == 'add') {
        url = "<?php echo site_url('admin/stock/insertInStock/') ?>";
    } else {
        url = "<?php echo site_url('admin/stock/updateInStock/') ?>";
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
                    getData('all');
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


function edit_stock_masuk(id) {
    save_method = 'update';
    $('#form')[0].reset();
    $('#modaldata').modal('show');
    $('.modal-title').text('Edit Keterangan Transaksi Keluar');

    $.ajax({
        url: "<?php echo site_url('admin/stock/get_data_in_stock_ById/') ?>" + id,
        type: "POST",
        dataType: "JSON",

        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="id_barang"]').val(data.id_barang);
            $('[name="old_stock"]').val(data.stock_masuk);
            $('[name="stock_masuk"]').val(data.stock_masuk);
            $('[name="tanggal_masuk"]').val(data.tanggal_masuk);
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
                url: "<?php echo site_url('admin/stock/delete_data_in_stock/') ?>" + id,
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
                           getData('all');

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