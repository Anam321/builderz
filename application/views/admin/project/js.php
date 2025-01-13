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
    ajax: "<?= base_url("admin/project/datatable") ?>",
    processing: true,


});


$('#form').submit(function(e) {
    e.preventDefault();
    var form = $('#form')[0];
    var data = new FormData(form);


    if ($('[name="nama_projek"]').val() == '0') {
        toastr.info('Nama Pojek deskripsi cannot be empty')
        return false;
    }
    if ($('[name="nama_client"]').val() == '0') {
        toastr.info('Client cannot be empty')
        return false;
    }
    if ($('[name="kategori"]').val() == '0') {
        toastr.info('Kategori cannot be empty')
        return false;
    }
    if ($('[name="tgl_mulai"]').val() == '') {
        toastr.info('Tanggal Mulai cannot be empty')
        return false;
    }
    if ($('[name="tgl_akhir"]').val() == '') {
        toastr.info('Tanggal Akhir cannot be empty')
        return false;
    }
    if ($('[name="alamat"]').val() == '') {
        toastr.info('Alamat cannot be empty')
        return false;
    }
    $('#save').html(
        "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading..."
    ).attr('disabled', true);
    $.ajax({
        url: '<?php echo site_url('admin/project/PostData') ?>',
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
                        window.location =
                            '<?php echo base_url('admin/project/') ?>';
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

$('#form_update').submit(function(e) {
    e.preventDefault();
    var form = $('#form_update')[0];
    var data = new FormData(form);

    $('#update').html(
        "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading..."
    ).attr('disabled', true);
    $.ajax({
        url: '<?php echo site_url('admin/project/updateData') ?>',
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
                    $('#update').text('Post Data'); //change button text
                    $('#update').attr('disabled', false); //set button enable
                    Swal.fire({
                        position: "top-midle",
                        icon: "success",
                        title: data.mess,
                        showConfirmButton: false,
                        timer: 1500,

                    }).then((result) => {
                        window.location =
                            '<?php echo base_url('admin/project/') ?>';
                    })

                }, 2000);
            } else {
                setTimeout(function() {
                    $('#update').text('Post Data'); //change button text
                    $('#update').attr('disabled', false); //set button enable
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
                $('#update').text('Post Data'); //change button text
                $('#update').attr('disabled', false); //set button enable
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
                url: "<?php echo site_url('admin/project/delete/') ?>" + id,
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