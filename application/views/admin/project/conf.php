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
                    <a href="<?= base_url('admin/project') ?>">Project</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="javascript:void()">Detail Project</a>
                </li>

            </ul>
        </div>
        <div class="page-category">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Detail Project</h4>
                                <a class="btn btn-primary btn-round ms-auto" href="<?= base_url('admin/project/') ?>">
                                    <i class="fa fa-arrow-left"></i>
                                    Back To List
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="card">
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <td style="width: 200px;">Nama Projek</td>
                                            <td style="width: 30px;">:</td>
                                            <td><?= $projek['nama_projek'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px;">Nama Client</td>
                                            <td style="width: 30px;">:</td>
                                            <td><?= $projek['nama_client'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px;">Alamat</td>
                                            <td style="width: 30px;">:</td>
                                            <td><?= $projek['alamat'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px;">Volume</td>
                                            <td style="width: 30px;">:</td>
                                            <td><?= $projek['volume'] ?></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 200px;">Anggaran</td>
                                            <td style="width: 30px;">:</td>
                                            <td><?= $anggaran ?></td>
                                        </tr>
                                        <tr>
                                            <?php $awal  = new DateTime($projek['tgl_mulai']);
                                            $awal  = new DateTime($projek['tgl_mulai']);
                                            $akhir = new DateTime($projek['tgl_akhir']);
                                            $diff  = date_diff($awal, $akhir);

                                            $timeline = $diff->format('%a hari'); ?>

                                            <td style="width: 200px;">Timeline</td>
                                            <td style="width: 30px;">:</td>
                                            <td><?= $timeline ?>, ( <?= date_indo($projek['tgl_mulai'])  ?> -
                                                <?= date_indo($projek['tgl_akhir'])  ?> )</td>
                                        </tr>
                                        <?php if ($projek['status'] == 1) {
                                            $badge = '<span class="badge bg-warning text-dark">Sedang Di kerjakan</span>';
                                        } else {
                                            $badge = '<span class="badge bg-success text-dark">Selesai</span>';
                                        } ?>
                                        <tr>
                                            <td style="width: 200px;">Status</td>
                                            <td style="width: 30px;">:</td>
                                            <td><?= $badge ?></td>
                                        </tr>

                                    </table>
                                    <?php if ($projek['status'] == 1) : ?>
                                    <div class="text-center">
                                        <button onclick="done()" type="button" class="btn btn-success me-3"
                                            id="done">Konfirmasi Project Sudah Selesai</button>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button onclick="add()" type="button" class="btn btn-primary btn-sm m-2"><i
                                                    class="fa fa-plus me-2"></i>Tambah File Foto</button>

                                            <div class="row" id="images_view">

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 class="mt-2 mb-3">RAB PROJECT</h5>
                                            <div class="table-responsive">
                                                <table id="myTable" class="table table-sm table-bordered "
                                                    style="width: 100%;">
                                                    <thead class="table-secondary">
                                                        <tr style="height: 50px; ">
                                                            <th style="text-align: center; vertical-align: middle;">#
                                                            </th>
                                                            <th style="text-align: center; vertical-align: middle;">
                                                                URAIAN PEKERJAAN</th>
                                                            <th style="text-align: center; vertical-align: middle;">
                                                                SPESIFIKASI BAHAN</th>
                                                            <th style="text-align: center; vertical-align: middle;">
                                                                VOLUME</th>
                                                            <th style="text-align: center; vertical-align: middle;">
                                                                SATUAN</th>
                                                            <th style="text-align: center; vertical-align: middle;">
                                                                HARGA SATUAN</th>
                                                            <th style="text-align: center; vertical-align: middle;">
                                                                TOTAL HARGA</th>
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
                                                            <td style="border-left: none;"></td>
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
                                                                <span>Rp. <?= number_format($total) ?></span>
                                                                <?php $sub_total += $total; ?>
                                                            </td>

                                                        </tr>

                                                        <?php endforeach ?>
                                                        <tr>
                                                            <td style="border-right: none;" class="table-secondary">
                                                            </td>
                                                            <td style="border: none;" class="table-secondary"></td>
                                                            <td style=" border: none; " class="table-secondary"></td>
                                                            <td style=" border: none;" class="table-secondary"></td>
                                                            <td style="border: none;" class="table-secondary"></td>
                                                            <td style="border: none;  padding-top:10px;"
                                                                class="table-secondary">
                                                                <h6>SUB TOTAL</h6>
                                                            </td>
                                                            <td style="border: none; padding-top:10px;"
                                                                class="table-secondary">
                                                                <h6>Rp. <?= number_format($sub_total) ?></h6>
                                                            </td>

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

                    <input type="hidden" name="id_uraian">
                    <div class="row mb-3">
                        <label for="file" class="col-sm-2 col-form-label">File</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id_projek" value="<?= $projek['id_projek'] ?>">
                            <input type="file" name="file" class="form-control" id="file">
                            <div class="form-group mt-2" id="process" style="display:none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped active" role="progressbar"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary me-3" id="save">Upload</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="save">Close</button>
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
    f_images();
});

function f_images() {
    id = $('[name="id_projek"]').val();

    $('#images_view').empty();
    $.ajax({
        url: "<?php echo site_url('admin/project/list/') ?>" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
            // console.log(data);

            $('#images_view').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function add() {

    $('#form')[0].reset();
    $('#modaldata').modal('show');
    $('.modal-title').text('Upload Foto');
}

$('#form').submit(function(e) {
    e.preventDefault();
    var form = $('#form')[0];
    var data = new FormData(form);
    if ($('[name="file"]').val() == '') {
        toastr.error('img cannot be empty')
        return false;
    }
    $('#save').html(
        "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>").attr(
        'disabled', true);
    $.ajax({
        url: '<?php echo site_url('admin/project/upload/') ?>',
        type: "POST",
        //contentType: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        data: data,
        dataType: "JSON",
        beforeSend: function() {
            $('#save').attr('disabled', 'disabled');
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
                    $('#form')[0].reset();
                    $('#save').text('Upload'); //change button text
                    $('#save').attr('disabled', false); //set button enable
                    f_images();
                }, 7000);
            } else {
                setTimeout(function() {
                    $('#process').css('display', 'none');
                    $('.progress-bar').css('width', '0%');
                    $('#save').text('Upload'); //change button text
                    $('#save').attr('disabled', false); //set button enable

                    toastr.error(data.mess)
                }, 2000);
            }

        },
        error: function(jqXHR, textStatus, errorThrown) {
            setTimeout(function() {
                $('#save').text('Upload'); //change button text
                $('#save').attr('disabled', false); //set button enable
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
        $('#modaldata').modal('hide');
        toastr.success('Berhasil di Uploads!.');
    }
}

function done() {
    if (confirm('Konfirmasi Data ?')) {
        id = $('[name="id_projek"]').val();
        $.ajax({
            url: "<?php echo site_url('admin/project/done_project/') ?>" + id,
            type: "POST",
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('error code.....')
            }
        });
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
                url: "<?php echo site_url('admin/project/delete_images/') ?>" + id,
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
                            setTimeout(function() {
                                f_images();
                            }, 2000);
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