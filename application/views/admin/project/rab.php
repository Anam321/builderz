    <?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Project</h4>
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
                        <a href="javascript:void()">RAB</a>
                    </li>

                </ul>
            </div>
            <div class="page-category">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">

                                    <a href="<?= base_url('admin/project/') ?>"> <button type="button"
                                            class="btn btn-primary btn-sm m-2"><i
                                                class="fa fa-arrow-left me-2"></i>Kembali</button></a>
                                    <a target="_blank"
                                        href="<?= base_url('admin/project/exportRab_pdf/') ?><?= $projek['id_projek'] ?>">
                                        <button type="button" class="btn btn-danger btn-sm m-2"><i
                                                class="fa fa-file-pdf me-2"></i>Export PDF</button></a>
                                    <a target="_blank"
                                        href="<?= base_url('admin/project/print_rab/') ?><?= $projek['id_projek'] ?>">
                                        <button type="button" class="btn btn-success btn-sm m-2"><i
                                                class="fa fa-print me-2"></i>Print</button></a>
                                    <button onclick="adduraian()" type="button" class="btn btn-primary btn-sm m-2"><i
                                            class="fa fa-plus me-2"></i>Tambah Point</button>

                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-sm table-bordered " style="width: 100%;">
                                        <thead class="table-secondary">
                                            <tr style="height: 50px; ">
                                                <th style="text-align: center; vertical-align: middle;">#</th>
                                                <th style="text-align: center; vertical-align: middle;">URAIAN PEKERJAAN
                                                </th>
                                                <th style="text-align: center; vertical-align: middle;">SPESIFIKASI
                                                    BAHAN</th>
                                                <th style="text-align: center; vertical-align: middle;">VOLUME</th>
                                                <th style="text-align: center; vertical-align: middle;">SATUAN</th>
                                                <th style="text-align: center; vertical-align: middle;">HARGA SATUAN
                                                </th>
                                                <th style="text-align: center; vertical-align: middle;">TOTAL HARGA</th>
                                                <?php if ($projek['status'] == 1) : ?>
                                                <th style="text-align: center; vertical-align: middle;">AKSI</th>
                                                <?php endif ?>
                                            </tr>
                                        </thead>
                                        <tbody id="listuraian">
                                            <?php $ab = 'A';
                                            $sub_total = 0;
                                            foreach ($uraian as $field) : ?>
                                            <tr>
                                                <td style="border-right: none;">
                                                </td>
                                                <td style="border: none; padding:10px;">

                                                    <h6><?= $ab++ ?>. <?= $field->uraian ?></h6>
                                                </td>

                                                <td style="border: none; "></td>
                                                <td style="border: none;"></td>
                                                <td style="border: none;"></td>
                                                <td style="border: none;"></td>
                                                <td style="border<?php if ($projek['status'] == 0) {
                                                                            echo '-left';
                                                                        } ?>: none;"></td>
                                                <?php if ($projek['status'] == 1) : ?>
                                                <td style="border-left: none;">
                                                    <a
                                                        href="<?= base_url('admin/project/form_rab/') ?>/<?= $id_projek ?>/<?= $field->id ?>"><button
                                                            type="button" class="btn btn-success btn-sm m-2"><i
                                                                class="fa fa-plus me-2"></i>Tambah List</button></a>
                                                    <button onclick="edituraian(<?= $field->id ?>)" type="button"
                                                        class="btn btn-warning btn-sm "><i
                                                            class="fa fa-edit me-2"></i>Edit Point</button>
                                                    <button onclick="deletes_uraian(<?= $field->id ?>)" type="button"
                                                        class="btn btn-danger btn-sm "><i
                                                            class="fa fa-trash me-2"></i>Delete Point</button>
                                                </td>
                                                <?php endif ?>
                                            </tr>
                                            <?php $no = 1;
                                                $total = 0;

                                                $this->db->where('id_uraian', $field->id);
                                                $query = $this->db->get('ref_projek_rab')->result();
                                                foreach ($query as $row) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row->uraian ?></td>
                                                <td><?= $row->spesifikasi_bahan ?></td>
                                                <td><?= $row->vol ?></td>
                                                <td><?= $row->satuan ?></td>
                                                <td>Rp. <?= number_format($row->harga_satuan) ?></td>
                                                <td>Rp. <?= number_format($row->tot_harga) ?></td>
                                                <?php if ($projek['status'] == 1) : ?>
                                                <td>
                                                    <a
                                                        href="<?= base_url('admin/project/edit_rab/') ?>/<?= $id_projek ?>/<?= $field->id ?>/<?= $row->id ?>"><button
                                                            type="button" class="btn btn-warning btn-sm "><i
                                                                class="fa fa-edit me-2"></i>Edit List</button></a>
                                                    <button onclick="delete_list(<?= $row->id ?>)" type="button"
                                                        class="btn btn-danger btn-sm "><i
                                                            class="fa fa-trash me-2"></i>Delete List</button>
                                                </td>
                                                <?php endif ?>
                                            </tr>
                                            <?php $total += $row->tot_harga; ?>
                                            <?php endforeach ?>


                                            <tr>
                                                <td style="border-right: none;" class="table-warning"></td>
                                                <td style="border: none;" class="table-warning"></td>
                                                <td style=" border: none; " class="table-warning"></td>
                                                <td style=" border: none;" class="table-warning"></td>
                                                <td style="border: none;" class="table-warning"></td>
                                                <td style="border: none;" class="table-warning"></td>
                                                <td style="border-left: none;" class="table-warning">
                                                    <h6>Rp. <?= number_format($total) ?></h6>
                                                    <?php $sub_total += $total; ?>
                                                </td>
                                                <?php if ($projek['status'] == 1) : ?>
                                                <td style="border-left: none;" class="table-warning"></td>
                                                <?php endif ?>
                                            </tr>

                                            <?php endforeach ?>
                                            <tr>
                                                <td style="border-right: none;" class="table-secondary"></td>
                                                <td style="border: none;" class="table-secondary"></td>
                                                <td style=" border: none; " class="table-secondary"></td>
                                                <td style=" border: none;" class="table-secondary"></td>
                                                <td style="border: none;" class="table-secondary"></td>
                                                <td style="border: none;  padding:10px;" class="table-secondary">
                                                    <h6>SUB TOTAL</h6>
                                                </td>
                                                <td style="border: none; padding-top:10px;" class="table-secondary">
                                                    <h6>Rp. <?= number_format($sub_total) ?></h6>
                                                </td>
                                                <?php if ($projek['status'] == 1) : ?>
                                                <td style="border-left: none;"></td>
                                                <?php endif ?>
                                            </tr>
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


    <div class="modal fade" id="modaldatauraian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_uraian">
                    <div class="modal-body">

                        <input type="hidden" name="id_uraian">
                        <div class="row mb-3">
                            <label for="uraian" class="col-sm-2 col-form-label">Uraian</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="id_projek" value="<?= $id_projek ?>">
                                <input type="text" name="uraian" class="form-control" id="uraian">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary me-3" id="save">Post Data</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                id="savur">Close</button>
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

function adduraian() {
    save_method = 'add';
    $('#form_uraian')[0].reset();
    $('#modaldatauraian').modal('show');
    $('.modal-title').text('Tambah Point RAB');
}

$('#form_uraian').submit(function(e) {
    e.preventDefault();
    var forms = $('#form_uraian')[0];
    var data = new FormData(forms);

    $('#savur').text('In Process, Please wait...'); //change button text
    $('#savur').attr('disabled', true); //set button disable
    var url;

    if (save_method == 'add') {
        url = "<?php echo site_url('admin/project/input_uraian/') ?>";
    } else {
        url = "<?php echo site_url('admin/project/update_uraian/') ?>";
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
                    $('#form_uraian')[0].reset();
                    $('#modaldatauraian').modal('hide');
                    window.location.reload();
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
            $('#savur').text('Save Data'); //change button text
            $('#savur').attr('disabled', false); //set button enable
        },
        error: function(jqXHR, textStatus, errorThrown) {
            toastr.error('Error code data !')
            $('#savur').text('Save Data'); //change button text
            $('#savur').attr('disabled', false); //set button enable
        }
    });

});

function edituraian(id) {
    save_method = 'update';
    $('#form_uraian')[0].reset();
    $('#modaldatauraian').modal('show');
    $('.modal-title').text('Edit kategori');

    $.ajax({
        url: "<?php echo site_url('admin/project/get_uraian_ById/') ?>" + id,
        type: "POST",
        dataType: "JSON",

        success: function(data) {
            $('[name="id_uraian"]').val(data.id);
            $('[name="uraian"]').val(data.uraian);

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function deletes_uraian(id) {

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
                url: "<?php echo site_url('admin/project/delete_uraian/') ?>" + id,
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

function delete_list(id) {

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
                url: "<?php echo site_url('admin/project/delete_list/') ?>" + id,
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