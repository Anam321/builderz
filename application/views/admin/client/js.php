<script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
<script>
$(document).ready(function() {
    cliendata();
});


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


new DataTable('#myTables', {
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
        "url": "<?php echo site_url('admin/client/dataTables') ?>",
        "type": "POST"
    },
    columnDefs: [{
        targets: [0],
        orderable: false,
    }, ],

});
$(document).ready(function() {
    $('.check').click(function() {
        $('.check').not(this).prop('checked', false);
    });
});

function getData(id) {
    $('.check').click(function() {
        $('.check').not(this).prop('checked', false);
    });
    $.ajax({
        url: "<?php echo site_url('admin/client/get_data_ById/') ?>" + id,
        type: "POST",
        dataType: "JSON",

        success: function(data) {
            // $('#modaldata').modal('hide');
            $('[name="id_projek"]').val(data.id_projek);
            $('[name="nama_client"]').val(data.nama_client);
            $('[name="nama_projek"]').val(data.nama_projek);
            $('[name="nohp"]').val(data.nohp);
            $('[name="email"]').val(data.email);
            $('[name="alamat"]').val(data.alamat);

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}




function projek() {
    // $('#form')[0].reset();

    $('#modaldata').modal('show');
    $('.modal-title').text('Projek');
    reload_table();
}

function cliendata() {

    $('#client').empty();
    $.ajax({
        url: "<?php echo site_url('admin/client/list/') ?>",
        type: "POST",
        dataType: "JSON",
        success: function(data) {
            // console.log(data);

            $('#client').html(data);
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
    $('#kirim').html(
        "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading..."
    ).attr('disabled', true);
    $.ajax({
        url: '<?php echo site_url('admin/client/requestTesti') ?>',
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
                    window.open('' + data.mess + '', '_blank');
                    $('#kirim').text('Dapatakn Testimoni'); //change button text
                    $('#kirim').attr('disabled', false); //set button enable

                }, 2000);

            } else {
                setTimeout(function() {
                    $('#kirim').text('Dapatakn Testimoni'); //change button text
                    $('#kirim').attr('disabled', false); //set button enable
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
                $('#save').text('Dapatakn Testimoni'); //change button text
                $('#save').attr('disabled', false); //set button enable
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
                url: "<?php echo site_url('admin/client/delete_data/') ?>" + id,
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
                            cliendata();

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